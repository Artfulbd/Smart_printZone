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

    }
}
