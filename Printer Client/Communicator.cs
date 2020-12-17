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

        private void makeReq()
        {

        }

        /*public IRestResponse getRespons()
        {
            IRestResponse res;
            
            return res;
        }*/

        public bool removeFile(string file_name)
        {
            return true;
        }

    }
}
