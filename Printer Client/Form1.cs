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
        private User usr;
        private Tools tool;
        private FileWatcher fw;
        private delegate void PopulateFileListItemCallback(FileType file);
        private delegate void RemoveFromFileListItemCallback(FileType file);
        private double totalFileSizeMax;
        public Dashboard()
        {
            InitializeComponent();
            startJob();
            populateGUI();

        }

        void startJob()
        {
            try
            {
                this.tool = new Tools();  // exception can be thrown from here
                this.tool.PageLimitExceedsEvent += Tool_PageLimitExceedsEvent;
                this.tool.TotalFileSizeExceedsEvent += Tool_TotalFileSizeExceedsEvent;
                this.tool.BothFileSizeAndLimitExceedsEvent += Tool_BothFileSizeAndLimitExceedsEvent;
               
                this.usr = new User(tool);
                this.usr.PendingFileInsertionEvent += Usr_PendingFileInsertionEvent;
                this.usr.getCredentials();

                this.fw = new FileWatcher(this.usr, this.tool);
                this.fw.FileInsertionEvent += Fw_FileInsertionEvent;
                this.fw.DuplicateFileInsertionEvent += Fw_DuplicateFileInsertionEvent;
                this.fw.listen();

                

            }
            catch(Exception ex)
            {
                this.label3.Text = "Exception";
                // block all usage
                // diasble everything
                // show unready state
                // show contuct to it
            }
            
        }
        private void populateGUI()
        {
            
        }

        private void Fw_DuplicateFileInsertionEvent(object sender, FileInsertionEventArgs e)
        {
            //temporary entry
            DateTime dateValue = e.time; 
            string formatdTime = dateValue.ToString("yyyy-MM-dd HH:mm:ss");
            FileType file = new FileType(e.name, e.size, e.page_count, formatdTime, false);
            populateFileListItem(file);

            //showing dialogue
            CustomDialogue cd = new CustomDialogue("Unusual stuffs");
            cd.file_name = e.name;
            cd.size = e.size.ToString();
            cd.page_count = e.page_count.ToString();
            cd.msg = "Same file name already exiest on your print queue.";
            cd.ShowDialog();
            if (cd.DialogResult.Equals(DialogResult.OK))
            {
                removeFromFileListItem(file);
            }

        }

        private void Tool_BothFileSizeAndLimitExceedsEvent(object sender, FileType e)
        {
            CustomDialogue cd = new CustomDialogue("Unusual stuffs");
            cd.file_name = e.file_name;
            cd.size = e.size.ToString();
            cd.page_count = e.page_count.ToString();
            cd.msg = "This file exceeds total file size and max file limit.";
            cd.ShowDialog();
            if (cd.DialogResult.Equals(DialogResult.OK))
            {
                //user pressed ok
            }
        }

        private void Tool_TotalFileSizeExceedsEvent(object sender, FileType e)
        {
            CustomDialogue cd = new CustomDialogue("Unusual stuffs");
            cd.file_name = e.file_name;
            cd.size = e.size.ToString();
            cd.page_count = e.page_count.ToString();
            cd.msg = "This file exceeds total file size.";
            cd.ShowDialog();
            if (cd.DialogResult.Equals(DialogResult.OK))
            {
                //user pressed ok
            }
        }

        private void Tool_PageLimitExceedsEvent(object sender, FileType e)
        {
            CustomDialogue cd = new CustomDialogue("Unusual stuffs");
            cd.file_name = e.file_name;
            cd.size = e.size.ToString();
            cd.page_count = e.page_count.ToString();
            cd.msg = "This file exceeds maximum page limit.";
            cd.ShowDialog();
            if (cd.DialogResult.Equals(DialogResult.OK))
            {
                //user pressed ok
            }
        }

        private void Usr_PendingFileInsertionEvent(object sender, FileType file)
        {
            if(this.usr.addFile(file))
            {
                populateFileListItem(file);
            }
        }

        private void Fw_FileInsertionEvent(object sender, FileInsertionEventArgs e)
        {
            SetText("I am fired");
            DateTime dateValue = e.time; // mySQL
            string formatdTime = dateValue.ToString("yyyy-MM-dd HH:mm:ss");
            FileType file = new FileType(e.name, e.size, e.page_count, formatdTime, false);
            if (this.usr.addFile(file) && this.tool.sendFileToServer(file)) 
            {
                populateFileListItem(file);
                SetText("Inserted to FL");
            }
            else
            {
                SetText(e.nameWithPath);
            }

        }

        private void btnAdd_Click(object sender, EventArgs e)
        {
            //label1.Text = Thread.CurrentThread.ManagedThreadId.ToString();
            DateTime dateValue = DateTime.Now;
            string formatedTime = dateValue.ToString("yyyy-MM-dd HH:mm:ss");
            FileType file = new FileType("Schedule_Fall2019", 200, 1, formatedTime, false);
            if (this.usr.addFile(file))
            {
                populateFileListItem(file);

            }
            else
            {
                SetText("Hay re jala");
            }
        }


        private void removeFromFileListItem(FileType file)
        {
            if (this.flowLayoutPanel.InvokeRequired)
            {
                RemoveFromFileListItemCallback d = new RemoveFromFileListItemCallback(removeFromFileListItem);
                this.Invoke(d, new object[] { file });
            }
            else
            {
                // modifi it later on
                // now only removes last item
                int toBeRemoved = this.flowLayoutPanel.Controls.Count - 1;
                if (toBeRemoved > -1)
                    this.flowLayoutPanel.Controls.RemoveAt(toBeRemoved);
            }
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
                fl.index = flowLayoutPanel.Controls.Count;
                fl.file_name = file.file_name;
                fl.page_count = file.page_count.ToString();
                fl.time = file.creation_time;
                fl.size = file.size;
                this.flowLayoutPanel.Controls.Add(fl);
            }
        }

        

        
        private void btnRemove_Click(object sender, EventArgs e)
        {
            //usr.removeFile(listBox1, new FileType("Testing", 0, 0, DateTime.Now));
            /*label1.Text = "activated";
            int toBeRemoved = this.flowLayoutPanel.Controls.Count - 1;
            if(toBeRemoved > -1)
                this.flowLayoutPanel.Controls.RemoveAt(toBeRemoved);*/
            CustomDialogue cd = new CustomDialogue("Error");
            cd.file_name = "Some file name";
            cd.size = "12";
            cd.page_count = "10";
            cd.ShowDialog();
            if (cd.DialogResult.Equals(DialogResult.OK))
            {
                //user pressed ok
                this.label1.Text = "pressed ok";
            }

        }
        delegate void SetTextCallback(string text);

        private void SetText(string text)
        {
            // InvokeRequired required compares the thread ID of the
            // calling thread to the thread ID of the creating thread.
            // If these threads are different, it returns true.
            if (this.label2.InvokeRequired)
            {
                SetTextCallback d = new SetTextCallback(SetText);
                this.Invoke(d, new object[] { text });
            }
            else
            {
                
               this.label2.Text = text;
            }
        }

        private void flowLayoutPanel_DragDrop(object sender, DragEventArgs e)
        {
            try
            {
                string[] droppedfiles = (string[])e.Data.GetData(DataFormats.FileDrop, false);

                if (!droppedfiles.All("".Contains))
                {
                    foreach (string fileName in droppedfiles)
                    {

                        if (Path.GetExtension(fileName) == ".pdf")
                        {
                            FileType file = tool.prepareFile(fileName);
                            if (this.usr.addFile(file) && this.tool.sendFileToServer(file))
                            {
                                populateFileListItem(file);
                                SetText("Inserted to FL");
                            }
                            else
                            {
                                SetText("Exist");
                            }

                        }
                    }
                }
                else
                {
                    label2.Text = "Fired but problem";
                }

            }
            catch (Exception catchedExcption)
            {
                this.label1.Text = "Are you fool or something.";
            }

        }

        

        private void flowLayoutPanel_DragEnter(object sender, DragEventArgs e)
        {
            e.Effect = DragDropEffects.All;
        }

        private void flowLayoutPanel_MouseEnter(object sender, EventArgs e)
        {
            this.flowLayoutPanel.BackColor = Color.LightBlue;
        }

        private void flowLayoutPanel_MouseLeave(object sender, EventArgs e)
        {
            this.flowLayoutPanel.BackColor = Color.AliceBlue;
        }
    }
}
