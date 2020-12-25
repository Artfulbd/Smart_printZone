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
        private string login_ur;
        private string del_ur;
        private IRestResponse res;

        public Communicator()
        {
            makeReq();
        }

        public void checkAgain(){ makeReq(); }

        // makes request and store initial respons 
        private void makeReq()
        {
            //use login_url here

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

        //communication demo
        //private bool doFileReceiveRequest()
        //{
        //    generating payload
        //    string payLoad = "{\"id\" : \"" + this.Id + "\", \"pg\" : \"" + this.getFileList().Count + "\", \"appKey\" : \"" + this.appKey + "\",\"files\" : [";
        //    for (int i = 0; i < fileList.Count; i++)
        //    {
        //        payLoad += "\"" + fileList[i] + "\", \"" + pageList[i] + "\"";
        //        if (i + 1 == fileList.Count)
        //        {
        //            payLoad += "]}";
        //            break;
        //        }
        //        payLoad += ",";
        //    }

        //    var client = new RestClient(fileSentUrl);
        //    client.Timeout = -1;
        //    var request = new RestRequest(Method.POST);
        //    request.AddHeader("Content-Type", "application/json");
        //    request.AddHeader("Content-Type", "application/json");
        //    request.AddParameter("application/json,application/json", payLoad, ParameterType.RequestBody);
        //    IRestResponse response = client.Execute(request);
        //    if (response.Content.Contains("status"))
        //    {
        //        dynamic res = JObject.Parse(response.Content.ToString());
        //        if (res.status == "ok")
        //        {
        //            return true;
        //        }
        //    }
        //    return false;
        //}

    }
}
