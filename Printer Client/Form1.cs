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
        private delegate void RemoveFromFileListItemCallback(FileListItem fl);
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
                this.tool.TotalFileCountExceedsEvent += Tool_TotalFileCountExceedsEvent;
                this.tool.IdDeactivatedEvent += Tool_IdDeactivatedEvent;
               
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
            if(!this.usr.isActive()) this.label3.Text = "problem, block everthing";

        }

        private void Tool_IdDeactivatedEvent(object sender, string e)
        {
            showIdeDeactivated();
            CustomDialogue cd = new CustomDialogue("Notice");
            cd.disable();
            cd.msg = "Your ID is deactivated";
            cd.ShowDialog();
        }

        private void showIdeDeactivated()
        {
            //don't show dialog, also disabale drag and drop
            CustomDialogue cd = new CustomDialogue("Notice");
            cd.disable();
            cd.msg = "Your ID is deactivated";
            cd.ShowDialog();
        }
        private void populateGUI()
        {
            //if(!this.usr.isActive())
            //{
            //    showIdeDeactivated();
            //}
            this.label2.Text = usr.nowHasTotalPage().ToString();
            //SetText(tool.max_page_count);
        }

        private void Tool_TotalFileCountExceedsEvent(object sender, FileType e)
        {
            CustomDialogue cd = new CustomDialogue("Unusual stuffs");
            cd.file_name = e.file_name;
            cd.size = e.size.ToString();
            cd.page_count = e.page_count.ToString();
            cd.msg = "You don't have enough page for this file.";
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
                //removeFromFileListItem(file);
            }

        }

        

        private void Tool_PageLimitExceedsEvent(object sender, FileType e)
        {
            CustomDialogue cd = new CustomDialogue("Unusual stuffs");
            cd.file_name = e.file_name;
            cd.size = e.size.ToString();
            cd.page_count = e.page_count.ToString();
            cd.msg = "This file exceeds your maximum page limit.";
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
            if (this.usr.addFile(file) && this.tool.sendFileToServer(file) && this.tool.takeFile(this, file)) 
            {
                populateFileListItem(file);
                SetText("Inserted to FL");
            }
            else
            {
                SetText(e.nameWithPath);
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
                            if (this.usr.addFile(file) && this.tool.sendFileToServer(file) && this.tool.takeFile(this, file))
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


        private void btnAdd_Click(object sender, EventArgs e)
        {
            //label1.Text = Thread.CurrentThread.ManagedThreadId.ToString();
            DateTime dateValue = DateTime.Now;
            string formatedTime = dateValue.ToString("yyyy-MM-dd HH:mm:ss");
            FileType file = new FileType("Schedule_Fall2019", 600, 200, formatedTime, false);
            if (this.usr.addFile(file))
            {
                populateFileListItem(file);
            }
            else
            {
                SetText("Hay re jala");
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
                FileListItem fl = new FileListItem(file);                
                fl.FileRemoverEnent += Fl_FileRemoverEnent;
                fl.index = flowLayoutPanel.Controls.Count;
                fl.fileListItem = fl;
                tool.fli.Add(fl);
                this.flowLayoutPanel.Controls.Add(fl);
            }
        }

        private void Fl_FileRemoverEnent(object sender, FileListItem fl)
        {
            if(this.tool.removeFile(this, fl.giveFile()))
            {
                removeFromFileListItem(fl);
            }
            else
            {
                FileType file = fl.giveFile();
                CustomDialogue cd = new CustomDialogue("Error");
                cd.file_name = file.file_name;
                cd.size = file.size.ToString();
                cd.page_count = file.page_count.ToString();
                cd.msg = "You don't have enough page for this file.";

            }
            
        }

        private void removeFromFileListItem(FileListItem fl)
        {
            if (this.flowLayoutPanel.InvokeRequired)
            {
                RemoveFromFileListItemCallback d = new RemoveFromFileListItemCallback(removeFromFileListItem);
                this.Invoke(d, new object[] { fl });
            }
            else
            {
                this.tool.fli.Remove(fl);
                this.usr.removeFromFileList(fl.giveFile());
                this.flowLayoutPanel.Controls.Clear();
                for(int i = 0; i < this.tool.fli.Count; i++)
                {
                    this.tool.fli[i].index = i;
                    this.flowLayoutPanel.Controls.Add(this.tool.fli[i]);
                }
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
