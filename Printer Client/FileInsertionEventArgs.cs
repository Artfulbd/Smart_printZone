using iTextSharp.text.pdf;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Printer_Client
{
    class FileInsertionEventArgs : EventArgs
    {
        public string name { get; }
        public int page_count { get; }
        public DateTime time { get; }
        public double size { get; }
        public bool isValid { get; }
        public string nameWithPath {get;}
        public FileInsertionEventArgs(string name)
        {
            
            System.IO.FileInfo fi = new System.IO.FileInfo(name);
            if (fi.Exists)
            {
                this.nameWithPath = name;
                this.name = Path.GetFileNameWithoutExtension(name);
                this.page_count = new PdfReader(name).NumberOfPages;
                this.time = fi.LastWriteTime;
                this.size = fi.Length / 1024;
                this.isValid = true;
            }
            else
            {
                this.isValid = false;
            }

        }

    }
}
