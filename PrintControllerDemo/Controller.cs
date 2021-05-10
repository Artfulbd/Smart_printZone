using Newtonsoft.Json.Linq;
using RestSharp;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PrintControllerDemo
{
    class Controller
    {
        private int free_slot;
        private Communicator com;

        public Controller(Communicator com_obg)
        {
            this.com = com_obg;
            populate();
        }

        public int freeSlotCount(){ return this.free_slot; }

        private void populate()
        {
            IRestResponse response = this.com.checkStatus("1", "nai");
            if ((int)response.StatusCode == 200 && response.Content.Contains("status"))
            {
                dynamic res = JObject.Parse(response.Content.ToString());
                try
                {
                    if (res.status == "1")
                    {
                        this.free_slot = (int)res.free_slot;
                    }
                    else this.free_slot = -1;
                }
                catch (Exception ex)
                {
                    // means problem on API
                    this.free_slot = -500;
                }
            }
        }

        public void punch(string id)
        {
            PrintOrder po = new PrintOrder(id);
            // basically it needs the updated slote count, so  calling populate() again
            populate();
        }

        private string getCurrentTime() { return DateTime.Now.ToString("HH:mm:ss"); }
    }
}
