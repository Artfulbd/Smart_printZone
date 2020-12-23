using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Printer_Client
{
    class FileType
    {
        public string file_name { get; }
        public double size { get; } //in mega byte
        public int page_count { get; } 
        public DateTime creation_time { get; }
        private bool isNow;  // is created now
        public bool isReady; // false if unable to be download from onlne
       
        private FileType() { } //default constructor cannot be called
        public FileType(string name, double size, int count, DateTime time)
        {
            this.file_name = name;
            this.size = size;
            this.page_count = count;
            this.creation_time = time;
            this.isNow = false;
        }
        public FileType(string name, double size, int count)
        {
            this.file_name = name;
            this.size = size;
            this.page_count = count;
            this.creation_time = DateTime.Now;
            this.isNow = true;
        }

        public bool isCreatedNow() { return this.isNow;  }

        //generate payload string for removing this file from server
        public string getDelPayload()
        {
            string payload = "initial";
            return payload;
        }
    }
}
