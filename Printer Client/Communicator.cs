using RestSharp;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Printer_Client
{
    class Communicator
    {
        private string login_ur = "http://localhost/pZone/commingin.php";  // initial data popukation
        private string req_ur = "http://localhost/pZone/takeFiles.php";    // file sent to server request
        private string rem_ur = "http://localhost/pZone/removefile.php";    // file remove request
        private IRestResponse res;

        //public Communicator() {


        //}

        public void initialRequest(string machineName, string id, string key)
        {
            string payLoad = "{\"id\":\"" + id + "\",\"machine\":\"" + machineName + "\",\"key\":\"" + key + "\"}";
            this.res = makeReq(this.login_ur, payLoad);
        }
        public IRestResponse getInitialRespons()
        {
            return this.res; 
        }
        public void checkAgain(){ 
            //initialRequest(); 
        }

        // makes request and store initial respons 
        private IRestResponse makeReq(string url, string payLoad)
        {
            var client = new RestClient(url);
            client.Timeout = -1;
            var request = new RestRequest(Method.POST);
            request.AddHeader("Content-Type", "application/json");
            request.AddParameter("application/json,application/json", payLoad, ParameterType.RequestBody);
            return client.Execute(request);
        }

        // gets initial respons to populate User's data
        public IRestResponse getRespons()
        {         
            return this.res;
        }

        public bool removeFile(string file_name)
        {
            //use del_url here
            return true;
        }

        
    }
}
