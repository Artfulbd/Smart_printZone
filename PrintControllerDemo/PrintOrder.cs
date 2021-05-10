using Newtonsoft.Json.Linq;
using RestSharp;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace PrintControllerDemo
{
    class FileType
    {
        public string file_name { get; }
        public int pg_count { get; }
        private FileType() { }
        public FileType(string file_name, int page_count)
        {
            this.file_name = file_name;
            this.pg_count = page_count;
        }

    }
    class PrintOrder
    {
        private string id;
        private int abort_code;
        private string printer_id;
        private int printer_status;
        private string printer_name;
        private int time_one_pg;
        private string port;
        private string driver_name;
        private int wait_time;                // in second
        private int doc_count;
        private int pad_time;
        private int interval_time;
        private List<FileType> file_list;
        private Communicator com;

        /* abort_code must be zero to run the thread*/
        private Thread Thrd;
        public PrintOrder(string user_id)
        {
            this.id = user_id;
            this.abort_code = 1;
            this.com = new Communicator();
            this.file_list = new List<FileType>();
            Thrd = new Thread(this.Run);
            Thrd.IsBackground = true;
            Thrd.Start(); // start the thread

            
        }
        // Entry point of thread.
        private bool needAbort()
        {
            return abort_code == 1;
        }

        private string getCurrentTime() { return DateTime.Now.ToString("HH:mm:ss"); }

        void Run()
        {
           if(punchAndPopulate() && !needAbort())
            {
                // do print job
                // printer may free before wait time, so update wait time in every N second
                int interval_time_mill = interval_time * 1000;  // millisecond
                while (!needAbort() && wait_time != 0)
                {
                    Thread.Sleep(interval_time_mill);
                    updateQueueWaitTime();
                }
                if (needAbort()) Thread.CurrentThread.Abort();
                
                // wait time zero, now preparing printer and notify to server
                notifyPrintStarting();
                int i = 0, finish_flag = 0, doc_remaining = file_list.Count(), delete_time;

                // printer_status hard coded for simulation
                printer_status = 2;
                while (doc_remaining != 0 && !needAbort())
                {
                    // print document
                    if(printDoc(file_list[i]))
                    {
                        delete_time =  file_list[i].pg_count * time_one_pg;
                        if (--doc_remaining == 0)
                        {
                            Thread.Sleep(pad_time);
                            finish_flag = 1;
                            delete_time += pad_time;
                        }
                        // print succes request
                        notifyPrintSuccess(file_list[i], delete_time, finish_flag);
                        i++;
                    }
                    else
                    {
                        
                        Console.WriteLine("Problem detected..!");
                        // detect problem and populate printer_status
                        // notify server printer status update

                        notifyPrinterProblem(printer_status);
                        while (!needAbort() && printer_status != 1)
                        {
                            Thread.Sleep(interval_time_mill);
                            // check printer is ready again
                            checkPrinterStatus();
                            Console.WriteLine("Checking current status");
                        }
                    }
                    
                }
            }
            Console.WriteLine(Thrd.Name + "Done, I am terminating.");
            if (needAbort()) Thread.CurrentThread.Abort();
        }

        private bool printDoc(FileType file)
        {
            if (printer_status == 2) return false;

            Console.WriteLine("I am printing", file.file_name);
            int sleep_time = ((int)(file.pg_count * time_one_pg) + 5) * 1000;
            Thread.Sleep(sleep_time);
            Console.WriteLine("Printing done.");
            return true;
        }

        private void notifyPrintSuccess(FileType file, int delete_time, int finish_flag)
        {
            Console.WriteLine("Notify print success..!!");
            IRestResponse response = this.com.printSuccess(id, finish_flag, file, delete_time, "nai");
            if ((int)response.StatusCode == 200 && response.Content.Contains("abort_code"))
            {
                dynamic res = JObject.Parse(response.Content.ToString());
                try
                {
                    abort_code = (int)res.abort_code;
                    Console.WriteLine("Received abort code.!: "+abort_code);

                }
                catch (Exception ex)
                {
                    // means problem on API
                    abort_code = 1;
                    Console.WriteLine("Exception on notifying, "+ ex.Message.ToString());
                }
            }
        }

        private void checkPrinterStatus()
        {
            Console.WriteLine("Checking printer status..!!");
            IRestResponse response = this.com.printerStatus(id, "nai");
            if ((int)response.StatusCode == 200 && response.Content.Contains("abort_code"))
            {
                dynamic res = JObject.Parse(response.Content.ToString());
                try
                {
                    abort_code = (int)res.abort_code;
                    if (abort_code != 1)
                    {
                        printer_status = (int)res.printer_status;
                    }
                    Console.WriteLine("Received abort code.!: " + abort_code);

                }
                catch (Exception ex)
                {
                    // means problem on API
                    abort_code = 1;
                    Console.WriteLine("Exception on checking printer status, "+ ex.Message.ToString());
                }
            }
        }

        private void notifyPrinterProblem(int printer_status)
        {
            Console.WriteLine("Notify printer problem..!!");
            IRestResponse response = this.com.printerProblem(id, printer_status, "nai");
            if ((int)response.StatusCode == 200 && response.Content.Contains("abort_code"))
            {
                dynamic res = JObject.Parse(response.Content.ToString());
                try
                {
                    abort_code = (int)res.abort_code;
                    Console.WriteLine("Received abort code.!: " + abort_code);

                }
                catch (Exception ex)
                {
                    // means problem on API
                    abort_code = 1;
                    Console.WriteLine("Exception on notifying printer problem "+ ex.Message.ToString());
                }
            }

        }

        private void notifyPrintStarting()
        {
            Console.WriteLine("Notify print starting..!!");
            IRestResponse response = this.com.printStarting(this.id, "nai");
            if ((int)response.StatusCode == 200 && response.Content.Contains("abort_code"))
            {
                dynamic res = JObject.Parse(response.Content.ToString());
                try
                {
                    abort_code = (int)res.abort_code;
                    Console.WriteLine("Received abort code.!: " + abort_code);

                }
                catch (Exception ex)
                {
                    // means problem on API
                    abort_code = 1;
                    Console.WriteLine("Exception on Print starting, "+ ex.Message.ToString());
                }
            }
        }

        private void updateQueueWaitTime()
        {
            Console.WriteLine("Updating queue wait time.!");
            IRestResponse response = this.com.queueWaitTime(this.id, "nai");
            if ((int)response.StatusCode == 200 && response.Content.Contains("abort_code"))
            {
                dynamic res = JObject.Parse(response.Content.ToString());
                try
                {
                    abort_code = (int)res.abort_code;
                    if (abort_code == 0)
                    {
                        wait_time = (int)res.wait_time;
                    }
                }
                catch (Exception ex)
                {
                    // means problem on API
                    abort_code = 1;
                }
            }
        }

        private bool punchAndPopulate()
        {
            IRestResponse response = this.com.punch("1", id, getCurrentTime(), "nai");
            if ((int)response.StatusCode == 200 && response.Content.Contains("abort_code"))
            {
                dynamic res = JObject.Parse(response.Content.ToString());
                try
                {
                    abort_code = (int)res.abort_code;
                    if (abort_code == 0)
                    {
                        printer_id = (string)res.printer_id;
                        Console.WriteLine(printer_id);
                        printer_name = (string)res.printer_name;
                        Console.WriteLine(printer_name);
                        time_one_pg = (int)res.time_one_page;
                        Console.WriteLine(time_one_pg);
                        port = (string)res.port;
                        Console.WriteLine(port);
                        driver_name = (string)res.driver_name;
                        Console.WriteLine(driver_name);
                        wait_time = (int)res.wait_time;
                        Console.WriteLine(wait_time);
                        doc_count = (int)res.doc_count;
                        Console.WriteLine(doc_count);
                        for (int i = 0; i < doc_count; i++)
                        {
                            file_list.Add(new FileType((string)res.files[i].file_name, (int)res.files[i].pg_count));
                            Console.WriteLine(res.files[i].file_name);
                        }
                        pad_time = (int)res.pad_time;
                        interval_time = 5;
                        printer_status = 1;
                    }


                }
                catch (Exception ex)
                {
                    // means problem on API
                    Console.WriteLine(ex.Message.ToString());
                    return false;
                    
                }
            }
            return true;
        }

        // DELETE before production
        private string sentReq(string name, int num)
        {
            var client = new RestClient("http://localhost/testing/add.php");
            client.Timeout = -1;
            var request = new RestRequest(Method.POST);
            request.AddHeader("Content-Type", "application/json");
            request.AddParameter("application/json", "{\"name\":\"" + name + "\", \"num\":\"" + num + "\"}", ParameterType.RequestBody);
            IRestResponse response = client.Execute(request);
            return response.Content;
        }

    }
}
