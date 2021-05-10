using RestSharp;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PrintControllerDemo
{
    class Communicator
    {
        private string system_status_link = "http://localhost/pZone/server/system_status.php";
        private string punch_link = "http://localhost/pZone/server/punch.php";
        private string queue_wait_time_link = "http://localhost/pZone/server/queue_wait_time.php";
        private string print_starting_link = "http://localhost/pZone/server/print_starting.php";
        private string print_success_link = "http://localhost/pZone/server/print_success.php";
        private string printer_problem_link = "http://localhost/pZone/server/printer_problem.php";
        private string printer_status_link = "http://localhost/pZone/server/printer_status.php";

        public Communicator()
        {
            
        }
        public IRestResponse printerStatus(string id, string key)
        {
            string payLoad = "{\"id\":\"" + id + "\",\"key\":\"" + key + "\"}";
            return makeReq(this.printer_status_link, payLoad);
        }

        public IRestResponse printerProblem(string id, int printer_status,  string key)
        {
            string payLoad = "{\"id\":\"" + id + "\",\"printer_status\" : \""+ printer_status +"\",\"key\":\"" + key + "\"}";
            return makeReq(this.printer_problem_link, payLoad);
        }

        public IRestResponse printSuccess(string id, int finish_flag, FileType file, int delete_time, string key)
        {
            string payLoad = "{\"id\":\""+id+"\",\"finish_flag\":\""+finish_flag+"\",\"file_name\":\""+file.file_name+"\",\"pg_count\":\""+file.pg_count+"\",\"delete_time\":\""+delete_time+"\",\"key\":\""+key+"\"}";
            return makeReq(this.print_success_link, payLoad);
        }

        public IRestResponse printStarting(string id, string key)
        {
            string payLoad = "{\"id\":\"" + id + "\",\"key\":\"" + key + "\"}";
            return makeReq(this.print_starting_link, payLoad);
        }

        public IRestResponse queueWaitTime(string id, string key)
        {
            string payLoad = "{\"id\":\"" + id + "\",\"key\":\"" + key + "\"}";
            return makeReq(this.queue_wait_time_link, payLoad);
        } 
        public IRestResponse punch(string zone_code, string id, string punch_time, string key)
        {
            string payLoad = "{\"id\":\""+id+"\",\"punch_time\":\""+punch_time+"\",\"zone_code\":\""+zone_code+"\",\"key\":\""+key+"\"}"; 
            return makeReq(this.punch_link, payLoad);
        }

        public IRestResponse checkStatus(string zone_code, string key)
        {
            string payLoad = "{\"zone_code\" : \""+ zone_code + "\",\"key\" : \""+key+"\"}";
            return makeReq(this.system_status_link, payLoad);
        }
        /*
        public void initialRequest(string key)
        {
            string payLoad = "{\"id\":\"" + this.id + "\",\"machine\":\"" + this.machineName + "\",\"key\":\"" + key + "\"}";
            this.res = makeReq(this.login_url, payLoad);
        }
        public IRestResponse getInitialRespons()
        {
            return this.res;
        }
        public void checkAgain()
        {
            //initialRequest(); 
        }*/


        // makes request 
        private IRestResponse makeReq(string url, string payLoad)
        {
            var client = new RestClient(url);
            client.Timeout = -1;
            var request = new RestRequest(Method.POST);
            request.AddHeader("Content-Type", "application/json");
            request.AddParameter("application/json,application/json", payLoad, ParameterType.RequestBody);
            return client.Execute(request);
        }
    }
}
