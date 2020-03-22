using Newtonsoft.Json.Linq;
using RestSharp;
using System;
using System.Collections.Generic;
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
        private int pgCount;
        private bool status;

        public Tools()
        {
            //this.Id = Environment.UserName;
            //this.Id = WindowsIdentity.GetCurrent().Name;
            this.Id = "1722231042";
            getInfo();
            /*
            if (pgCount == -1)Console.WriteLine("Problem on server");
            else if (this.status)Console.WriteLine("Active ID and pg:" + pgCount);
            else Console.WriteLine("Deactive ID and pg:" + pgCount);*/
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
