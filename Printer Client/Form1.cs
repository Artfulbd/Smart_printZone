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
        private delegate void SetWarningCallBack(string text);
        private delegate void SetdisableRefreshButton(string text);
        private delegate void PopulateFileListItemCallback(FileType file);
        private delegate void RemoveFromFileListItemCallback(FileListItem fl);

        public Dashboard()
        {
            InitializeComponent();
            initializeEstimation();
            startJob();
            if (tool.hasSuccessfullFetch()) populateGUI();
            else this.lblWarning.Text = "Problem on loading, contuct to IT";

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

                if(this.tool.isActive())
                {
                    this.fw = new FileWatcher(this.usr, this.tool);
                    this.fw.FileListeningEvent += Fw_FileListeningEvent;
                    this.fw.FileInsertionEvent += Fw_FileInsertionEvent;
                    this.fw.DuplicateFileInsertionEvent += Fw_DuplicateFileInsertionEvent;
                    this.fw.listen();
                    this.flowLayoutPanel.AllowDrop = true;
                }
                else
                {   // un-subscrbe event
                    this.tool.PageLimitExceedsEvent -= Tool_PageLimitExceedsEvent;
                    this.tool.TotalFileSizeExceedsEvent -= Tool_TotalFileSizeExceedsEvent;
                    this.tool.TotalFileCountExceedsEvent -= Tool_TotalFileCountExceedsEvent;
                    this.tool.IdDeactivatedEvent -= Tool_IdDeactivatedEvent;
                    this.usr.PendingFileInsertionEvent -= Usr_PendingFileInsertionEvent;
                }




            }
            catch(Exception ex)
            {
                //this.label3.Text = "nothing"+ex.ToString();
                
                this.flowLayoutPanel.AllowDrop = false;
                /*
                 * exception may occur on --> this.usr.getCredentials();
                 * if api respons doesn't fetched successfully.
                 * 
                */
            }
            //this.label3.Text = "nothing" ;

        }

        private void populateGUI()
        {
            this.Text = "Printer Client :" + usr.id;
            this.btnRefresh.Enabled = true;
            if (this.tool.isActive())
            {
                //id enebled
                this.lblName.Text = usr.name;
                this.lblWarning.Text = "";
                loadEstimation();

            }
            else
            {
                // show ID is disabled
                this.lblWarning.Text = "ID blocked..!";
                this.flowLayoutPanel.AllowDrop = false;
            }
            //SetText(tool.max_page_count);
        }

        private void refresh()
        {
            /*
            this.fw.FileListeningEvent -= Fw_FileListeningEvent;
            this.fw.FileInsertionEvent -= Fw_FileInsertionEvent;
            this.fw.DuplicateFileInsertionEvent -= Fw_DuplicateFileInsertionEvent;
            this.tool.PageLimitExceedsEvent -= Tool_PageLimitExceedsEvent;
            this.tool.TotalFileSizeExceedsEvent -= Tool_TotalFileSizeExceedsEvent;
            this.tool.TotalFileCountExceedsEvent -= Tool_TotalFileCountExceedsEvent;
            this.tool.IdDeactivatedEvent -= Tool_IdDeactivatedEvent;
            this.usr.PendingFileInsertionEvent -= Usr_PendingFileInsertionEvent;*/
            // cleaning list
            if (this.flowLayoutPanel.Controls.Count != 0)
            {
                this.flowLayoutPanel.Controls.Clear();
            }
            initializeEstimation();
            startJob();

            if (tool.hasSuccessfullFetch())
            {
                populateGUI();
            }
            else
            {
                this.lblWarning.Text = "Problem on loading, contuct to IT";
            }
            this.btnRefresh.Enabled = true;
            
        }
        private void btnRefresh_Click(object sender, EventArgs e)
        {
            refresh();
        }

        private void loadEstimation()
        {
            this.lblPageLeft.Text = usr.page_left.ToString();
            this.lblOnQueue.Text = usr.nowHasTotalPage().ToString();
            this.lblTotalPrinted.Text = usr.printed_page_count.ToString();
        }
        private void initializeEstimation()
        {
            this.lblPageLeft.Text = "";
            this.lblOnQueue.Text = "";
            this.lblTotalPrinted.Text = "";
        }

        private void Fw_FileListeningEvent(object sender, string e)
        {
            disableRefreshButton(e);
        }

        private void disableRefreshButton(string text)
        {
            // InvokeRequired required compares the thread ID of the
            // calling thread to the thread ID of the creating thread.
            // If these threads are different, it returns true.
            if (this.btnRefresh.InvokeRequired)
            {
                SetdisableRefreshButton d = new SetdisableRefreshButton(disableRefreshButton);
                this.Invoke(d, new object[] { text });
            }
            else
            {
                this.btnRefresh.Enabled = false;
            }
        }

        private void Tool_IdDeactivatedEvent(object sender, string e)
        {
            CustomDialogue cd = new CustomDialogue("Notice");
            cd.disable();
            cd.msg = "Your ID is deactivated";
            cd.ShowDialog();
            refresh();
        }
        

        private void Tool_TotalFileCountExceedsEvent(object sender, FileType e)
        {
            CustomDialogue cd = new CustomDialogue("Unusual stuffs");
            cd.file_name = e.file_name;
            cd.size = e.size.ToString();
            cd.page_count = e.page_count.ToString();
            cd.msg = "You don't have enough page for this file.";
            cd.ShowDialog();
        }

        private void Tool_TotalFileSizeExceedsEvent(object sender, FileType e)
        {
            CustomDialogue cd = new CustomDialogue("Unusual stuffs");
            cd.file_name = e.file_name;
            cd.size = e.size.ToString();
            cd.page_count = e.page_count.ToString();
            cd.msg = "This file exceeds total file size.";
            cd.ShowDialog();
        }


        private void Fw_DuplicateFileInsertionEvent(object sender, FileInsertionEventArgs e)
        {
            //showing dialogue
            CustomDialogue cd = new CustomDialogue("Unusual stuffs");
            cd.file_name = e.name;
            cd.size = e.size.ToString();
            cd.page_count = e.page_count.ToString();
            cd.msg = "Same file name already exiest on your print queue.";
            cd.ShowDialog();
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
                //this.btnRefresh.Enabled = true;
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
            DateTime dateValue = e.time; // mySQL
            string formatdTime = dateValue.ToString("yyyy-MM-dd HH:mm:ss");
            FileType file = new FileType(e.name, e.size, e.page_count, formatdTime, false);
            if (this.usr.addFile(file) && this.tool.sendFileToServer(file) && this.tool.takeFile(this, file)) 
            {
                populateFileListItem(file);
                setWarning("File successfully added.");
            }
            else
            {
                setWarning("Problem on uploading, refresh and try again.");
            }
            if (!this.tool.isActive()) refresh();

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
                            bool is_added = this.usr.addFile(file);
                            if(!is_added)
                            {
                                CustomDialogue cd = new CustomDialogue("Unusual stuffs");
                                cd.file_name = file.file_name;
                                cd.size = file.size.ToString();
                                cd.page_count = file.page_count.ToString();
                                cd.msg = "Same file name already exiest on your print queue.";
                                cd.ShowDialog();
                            }
                            else if ( is_added && this.tool.sendFileToServer(file) && this.tool.takeFile(this, file))
                            {
                                populateFileListItem(file);
                                this.lblWarning.Text = "File successfully added.";
                            }

                            if (!this.tool.isActive()) refresh();
                        }
                        else
                        {
                            this.lblWarning.Text = "Only PDF file can be dropped here.";
                        }
                    }
                }
                else
                {
                    //label2.Text = "Fired but problem";
                }

            }
            catch (Exception catchedExcption)
            {
                this.lblWarning.Text = "Only PDF file can be dropped here.";
            }

        }

        private void setWarning(string text)
        {
            if (this.label2.InvokeRequired)
            {
                SetWarningCallBack d = new SetWarningCallBack(setWarning);
                this.Invoke(d, new object[] { text });
            }
            else
            {
                this.lblWarning.Text = text;
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
                this.tool.fli.Add(fl);
                this.flowLayoutPanel.Controls.Add(fl);
                // to show update on new page count and other
                this.loadEstimation();
            }
        }

        private void Fl_FileRemoverEnent(object sender, FileListItem fl)
        {
            if(this.tool.removeFile(this, fl.giveFile()))
            {
                this.btnRefresh.Enabled = false;
                removeFromFileListItem(fl);
                this.loadEstimation();
                this.btnRefresh.Enabled = true;
                if (!this.tool.isActive()) refresh();
                this.lblWarning.Text = "File removed.";
            }
            else
            {
                FileType file = fl.giveFile();
                CustomDialogue cd = new CustomDialogue("Error");
                cd.file_name = file.file_name;
                cd.size = file.size.ToString();
                cd.page_count = file.page_count.ToString();
                cd.msg = "Can't remove, refresh and try again.";
                cd.ShowDialog();
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











        private void btnAdd_Click(object sender, EventArgs e)
        {
            DateTime dateValue = DateTime.Now;
            string formatedTime = dateValue.ToString("yyyy-MM-dd HH:mm:ss");
            FileType file = new FileType("Schedule_Fall2019", 600, 200, formatedTime, false);
            if (this.usr.addFile(file))
            {
                populateFileListItem(file);
            }
            else
            {
                //SetText("Hay re jala");
            }
        }

        private void btnRemove_Click(object sender, EventArgs e)
        {
            CustomDialogue cd = new CustomDialogue("Error");
            cd.file_name = "Some file name";
            cd.size = "12";
            cd.page_count = "10";
            cd.ShowDialog();
            if (cd.DialogResult.Equals(DialogResult.OK))
            {
                //user pressed ok
                this.lblName.Text = "pressed ok";
            }

        }
        /*delegate void SetTextCallback(string text);

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
        }*/

        

        private void flowLayoutPanel_DragEnter(object sender, DragEventArgs e)
        {
            e.Effect = DragDropEffects.All;
        }

        private void flowLayoutPanel_MouseEnter(object sender, EventArgs e)
        {
            
            if (this.tool.isActive() && this.tool.hasSuccessfullFetch())
            {
                this.flowLayoutPanel.BackColor = Color.LightBlue;
            }
        }

        private void flowLayoutPanel_MouseLeave(object sender, EventArgs e)
        {
            this.flowLayoutPanel.BackColor = Color.AliceBlue;
        }

    }
}
