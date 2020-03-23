using Newtonsoft.Json.Linq;
using RestSharp;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Security.Principal;
using System.Text;
using System.Threading.Tasks;

namespace Smart_printZone_Client
{
    class Tools
    {
        private string Id;
        private string pgCountUrl = "http://localhost/pZone/pageLimit.php";
        private string fileSentUrl = "http://localhost/pZone/fileSent.php";
        //private string tempStorageDir = @"I:\C#\Work Space\Smart_printZone_Client\store";
        //this returns crrent dir--> System.IO.Path.GetDirectoryName(Assembly.GetEntryAssembly().Location);
        private string tempStorageDir = @"..\..\store";
        // ip can be used here
        private string destDir = @"\\DESKTOP-D7LD2F5\ServerFolder";
        private string appKey = "apadoto nai";
        private int pgCount;
        private bool status;
        private List<String> fileList = new List<string>();
        private int MAX_ALLOWED_FILE = 5;

        public Tools()
        {
            //this.Id = Environment.UserName;
            //this.Id = WindowsIdentity.GetCurrent().Name;
            this.Id = "1722231042";
            getInfo();
            
            // need a directory to store temp files
            if(Directory.Exists(tempStorageDir))
            {
                DirectoryInfo di = new DirectoryInfo(tempStorageDir);
                foreach (FileInfo file in di.EnumerateFiles())
                {
                    file.Delete();
                }
                foreach (DirectoryInfo dir in di.EnumerateDirectories())
                {
                    dir.Delete(true);
                }
            }
            else Directory.CreateDirectory(tempStorageDir);


            /*
            if (pgCount == -1)Console.WriteLine("Problem on server");
            else if (this.status)Console.WriteLine("Active ID and pg:" + pgCount);
            else Console.WriteLine("Deactive ID and pg:" + pgCount);*/
        }

        // for demo one file means page, so
        public int afterPageCount()
        {
            return this.pageCount - this.getFileList().Count;
        }

        public bool transfer()
        {
            // first transfer then send request to server
            return doTransferFile() && doFileReceiveRequest();
        }

        private bool doFileReceiveRequest()
        {
            //generating payload
            string payLoad = "{\"id\" : \"" + this.Id + "\", \"pg\" : \"" + this.getFileList().Count + "\", \"appKey\" : \"" + this.appKey + "\",\"files\" : [";
            for (int i = 0; i < fileList.Count; i++)
            {
                payLoad += "\"" + fileList[i] + "\"";
                if (i + 1 == fileList.Count)
                {
                    payLoad += "]}";
                    break;
                }
                payLoad += ",";
            }

            var client = new RestClient(fileSentUrl);
            client.Timeout = -1;
            var request = new RestRequest(Method.POST);
            request.AddHeader("Content-Type", "application/json");
            request.AddHeader("Content-Type", "application/json");
            request.AddParameter("application/json,application/json", payLoad, ParameterType.RequestBody);
            IRestResponse response = client.Execute(request);
            if (response.Content.Contains("status"))
            {
                dynamic res = JObject.Parse(response.Content.ToString());
                if (res.status == "ok")
                {
                    return true;
                }
            }
            return false;
        }

        private bool doTransferFile()
        {
            string fileName;
            bool isDone = false;
            int length = 0;
            try
            {
                string[] fileList = Directory.GetFiles(this.tempStorageDir);
                foreach (string singleFile in fileList)
                {
                    fileName = singleFile.Substring(this.tempStorageDir.Length + 1);

                    //overwrite file, if already exist
                    File.Copy(Path.Combine(this.tempStorageDir, fileName), Path.Combine(destDir, fileName), true);
                    File.Delete(singleFile);
                    length++;
                }
                isDone = true;
            }
            catch (DirectoryNotFoundException drNotFound)
            {
                return false;
            }
            if (isDone && length == fileList.Count) return true;
            return false;
        }
        public void addFile(string file, string fileName)
        {
            fileName = this.Id + "_" + fileName;
            string dest = tempStorageDir+ @"\"+fileName;
      
            // To copy file to temporary location:
            File.Copy(file, dest);
            this.fileList.Add(fileName);
        }

        public int max
        {
            get { return MAX_ALLOWED_FILE; }
        }

        public List<string> getFileList()
        {
            return this.fileList;
        }       

        public string id
        {
            get { return this.Id; }
        }

        public int pageCount
        {
            get { return this.pgCount; }
        }
        public bool isActive
        {
            get { return this.status; }
        }


       

       

        // if pg = -1 and false means problem on srver or invalid request
        // id pg > -1 then valid and true means account is active false means blocked
        private void getInfo()
        {
            string machineName = "ABCD";
            var client = new RestClient(this.pgCountUrl);
            client.Timeout = -1;
            var request = new RestRequest(Method.POST);
            request.AddHeader("Content-Type", "application/json");
            request.AddParameter("application/json", "{\r\n  \"id\" : \"" + this.Id+ "\" ,\r\n  \"machineName\" :\"" + machineName + "\"\r\n}", ParameterType.RequestBody);
            IRestResponse response = client.Execute(request);
            if (response.Content.Contains("status"))
            {
                dynamic res = JObject.Parse(response.Content.ToString());
                this.pgCount = res.pgCount;
                if (res.accountStatus == 1)
                {   // account is active
                    this.status = true;
                }
                else this.status = false;
            }
            else
            {
                this.pgCount = -1;
                this.status = false;
            }
            
        }


    }
}
