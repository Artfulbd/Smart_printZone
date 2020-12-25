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
        
        private string temp_dir = @"C:\Users\Artful\Desktop\NSU PDF";
        private string hidden_dir = @"C:\Users\Artful\Desktop\NewDir\";
        private User usr;
        delegate void PopulateFileListItemCallback(FileType file);
        public Dashboard()
        {
            InitializeComponent();
            Directory.CreateDirectory(temp_dir);
            usr = new User();
            FileWatcher fw = new FileWatcher(temp_dir, hidden_dir);
            FileWatcher.FileInsertionEvent += Fw_FileInsertionEvent;
            // listBox1.Items.Add("sdfsdf");
            //populateFileListItem();

        }

        private void Fw_FileInsertionEvent(object sender, FileInsertionEventArgs e)
        {
            // check file page count matches credentials
            // add to user
            // send to server
            // add to UI
            populateFileListItem(new FileType(e.name, e.size, e.page_count, e.time));
            //usr.addFile(listBox1, new FileType(e.name,e.size,e.page_count,e.time));



        }

        private void populateFileListItem(FileType file)
        {
            if (this.flowLayoutPanel.InvokeRequired)
            {
                PopulateFileListItemCallback d = new PopulateFileListItemCallback(populateFileListItem);
                this.Invoke(d, new object[] { file });
            }
            else
            {
                FileListItem fl = new FileListItem();
                //fl.makeFlaxible();
                fl.index = flowLayoutPanel.Controls.Count;
                fl.file_name = file.file_name;
                fl.page_count = file.page_count.ToString();
                fl.time = file.creation_time.ToString();
                fl.size = file.size.ToString()+"KB";
                this.flowLayoutPanel.Controls.Add(fl);
            }
        }

        

        private void btnAdd_Click(object sender, EventArgs e)
        {
            label1.Text = Thread.CurrentThread.ManagedThreadId.ToString();
            populateFileListItem(new FileType("Some name", 25, 1, DateTime.Now));
            //usr.addFile(listBox1, new FileType("Testing", 0, 0, DateTime.Now));
        }


        private void btnRemove_Click(object sender, EventArgs e)
        {
            //usr.removeFile(listBox1, new FileType("Testing", 0, 0, DateTime.Now));
            label1.Text = "activated";
            int toBeRemoved = this.flowLayoutPanel.Controls.Count - 1;
            if(toBeRemoved > -1)
                this.flowLayoutPanel.Controls.RemoveAt(toBeRemoved);
        }
        delegate void SetTextCallback(string text);

        private void SetText(string text)
        {
            // InvokeRequired required compares the thread ID of the
            // calling thread to the thread ID of the creating thread.
            // If these threads are different, it returns true.
            if (this.listBox1.InvokeRequired)
            {
                SetTextCallback d = new SetTextCallback(SetText);
                this.Invoke(d, new object[] { text });
            }
            else
            {
                this.listBox1.Items.Add(text);
                //this.label2.Text = text;
            }
        }

    }
}
