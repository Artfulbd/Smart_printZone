using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Printer_Client
{
    public partial class Dashboard : Form
    {
        User usr = new User();
        private string temp_dir = @"C:\Users\Artful\Desktop\NSU PDF";
        private string hidden_dir = @"C:\Users\Artful\Desktop\NewDir\";
        
        public Dashboard()
        {
            InitializeComponent();
            Directory.CreateDirectory(temp_dir);
            FileWatcher fw = new FileWatcher(temp_dir, hidden_dir);
            fw.FileInsertionEvent += Fw_FileInsertionEvent;
        }

        private void Fw_FileInsertionEvent(object sender, FileInsertionEventArgs e)
        {
            populate();
        }

        private void populate()
        {
            label1.Text = "Initial";
            
        }
        private void another()
        {
            //fw.listen();
        }

        private void FileInsertedEvent(object sender, FileInsertionEventArgs e)
        {
            
            /* Console.WriteLine("Name:  " + e.name);
             Console.WriteLine("Page count  " + e.page_count);
             Console.WriteLine("Size  " + e.size);
             Console.WriteLine("Time  " + e.time);*/
        }

        
    }
}
