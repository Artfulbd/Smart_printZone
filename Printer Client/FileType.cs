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
        public string creation_time { get; }
        public bool isFromServer { get; } // false if unable to be download from onlne
        public int index;

        private FileType() { } //default constructor cannot be called
        public FileType(string name, double size, int count, string time, bool isFromServer)
        {
            this.file_name = name;
            this.size = size;
            this.page_count = count;
            this.creation_time = time;
            this.isFromServer = isFromServer;
        }

       
        

        public override bool Equals(Object obj)
        {
            FileType t = (FileType)obj;
            return (this.file_name == t.file_name && this.size == t.size && t.page_count == this.page_count);
        }
        public override int GetHashCode()
        {
            return ToString().GetHashCode();

        }
    }
}
