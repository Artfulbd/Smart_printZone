using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Reflection;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Smart_printZone_Client
{
    public partial class mainForm : Form
    {
        private Tools tool = new Tools();
        
        public mainForm()
        {
            InitializeComponent();
            this.lblId.Text = tool.id;
            this.labelDropIndicator.Text = "Can't drop Item.";
            this.labelDropIndicator.BackColor = System.Drawing.Color.Red;
            this.btnMore.Visible = false;

            if (tool.pageCount == -1)
            {
                this.lblMsgBox.Text = "Problem on server";
                this.panelDrop.Enabled = false;
            }
            else if (tool.isActive) 
            {
                this.lblAvailablePage.Text = tool.pageCount.ToString();

                if (tool.pageCount == 0)
                {
                    this.lblMsgBox.Text = "No page left.!";
                    this.panelDrop.Enabled = false;
                    this.btnPrint.Enabled = false;
                }
                else
                {
                    this.labelDropIndicator.Text = "Drag and drop your files here -->";
                    this.labelDropIndicator.BackColor = System.Drawing.Color.Transparent;
                    this.lblNewPageCount.Text = tool.afterPageCount().ToString();

                }
            }
            else
            {
                this.lblMsgBox.Text = "Id blocked";
                this.lblAvailablePage.Text = tool.pageCount.ToString();
                this.panelDrop.Enabled = false;
                this.btnPrint.Enabled = false;
            }
        }

        private void panelDrop_DragEnter(object sender, DragEventArgs e)
        {
            e.Effect = DragDropEffects.All;
        }

        private void panelDrop_DragDrop(object sender, DragEventArgs e)
        {
            try
            {
                string[] droppedfiles = (string[])e.Data.GetData(DataFormats.FileDrop, false);
                if (droppedfiles.Length > 0)
                {
                    foreach (string hold in droppedfiles)
                    {
                        if (listBox1.Items.Count + 1 <= tool.max)
                        {
                            string fileName = getFileName(hold);
                            // generating file list
                            if (fileName.EndsWith(".txt"))
                            { 
                                tool.addFile(hold, fileName);
                                this.listBox1.Items.Add(fileName);

                                // for demo one file means page, so
                                this.lblNewPageCount.Text = tool.afterPageCount().ToString();
                                this.lblMsgBox.Text = "File successfully added.";
                            }
                            else this.lblMsgBox.Text = "This is not txt file.";

                        }
                        else break;                        
                    }
                }

            }
            catch (Exception catchedExcption)
            {
                this.lblMsgBox.Text = "Are you fool or something.";
            }
            finally
            {
                if (this.listBox1.Items.Count == tool.max)
                {
                    this.panelDrop.Enabled = false;
                    this.panelDrop.BackColor = System.Drawing.Color.Red;
                    this.labelDropIndicator.Text = "Reached to max limit 5";
                    this.lblMsgBox.Text = "Reached to maximum file limit.";
                }
            }

        }

        private string getFileName(string path)
        {
            if (Directory.Exists(path)) return "This is not a file";
            else return Path.GetFileName(path);
        }

        private void button1_Click(object sender, EventArgs e)
        {
            System.Windows.Forms.Application.Exit();
        }

        private void panelDrop_MouseLeave(object sender, EventArgs e)
        {
            this.panelDrop.BackColor = System.Drawing.Color.SandyBrown;
        }

        private void panelDrop_MouseEnter(object sender, EventArgs e)
        {
            this.panelDrop.BackColor = Color.Blue;
        }

        private void btnPrint_Click(object sender, EventArgs e)
        {
            if(this.listBox1.Items.Count>0 && tool.transfer())
            {
                this.lbltest.Text = "File successfully sent to printer.";
                this.listBox1.Items.Clear();
                this.btnPrint.Enabled = false;
                tool.flash();
                this.labelDropIndicator.Text = "Not ready to receive file";
                this.panelDrop.Enabled = false;
                this.btnMore.Visible = true;
            }
            else
            {
                lbltest.Text = "Problem on sending.";
            }
        }

        private void btnMore_Click(object sender, EventArgs e)
        {
            this.labelDropIndicator.Text = "Drag and drop your files here -->";
            this.panelDrop.Enabled = true;
            this.btnMore.Visible = false;
            this.btnPrint.Enabled = true;

        }
    }
}
