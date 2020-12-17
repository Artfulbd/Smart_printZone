using iTextSharp.text.pdf;
using System;
using System.Collections.Generic;
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
        public FileInsertionEventArgs(string name)
        {
            this.name = name;
            System.IO.FileInfo fi = new System.IO.FileInfo(name);
            if (fi.Exists)
            {
                this.page_count = new PdfReader(name).NumberOfPages;
                this.time = fi.LastWriteTime;
                this.size = fi.Length / 1024;
            }

        }
    }
}
