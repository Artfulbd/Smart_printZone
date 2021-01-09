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
        private string login_url = "http://localhost/pZone/commingin.php";  // initial data popukation
        private string take_file_url = "http://localhost/pZone/takeFiles.php";    // file sent to server request
        private string rem_url = "http://localhost/pZone/removefile.php";    // file remove request
        private string id, machineName;
        private IRestResponse res;

        public Communicator(string id, string machineName) {
            this.id = id;
            this.machineName = machineName;
        }

        public void initialRequest(string key)
        {
            string payLoad = "{\"id\":\"" + this.id + "\",\"machine\":\"" + this.machineName + "\",\"key\":\"" + key + "\"}";
            this.res = makeReq(this.login_url, payLoad);
        }
        public IRestResponse getInitialRespons()
        {
            return this.res; 
        }
        public void checkAgain(){ 
            //initialRequest(); 
        }
        
        public IRestResponse makeTakeFileRequest(string key, FileType file)
        {
            string payLoad = "{\"id\":\"" + this.id + "\",\"pc_name\":\"" + this.machineName + "\",\"key\":\"" + key + "\",\"file_count\":\"1\",\"files\":[{\"file_name\": \"" +file.file_name + "\",\"time\":\"" + file.creation_time + "\",\"pg_count\":\"" + file.page_count + "\",\"size\":\"" + file.size + "\"}]}";
            return makeReq(this.take_file_url, payLoad);
        }
        
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

        

        public bool removeFile(string file_name)
        {
            //use del_url here
            return true;
        }

        
    }
}
