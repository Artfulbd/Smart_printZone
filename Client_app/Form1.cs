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
            lblId.Text = tool.id;
            labelDropIndicator.Text = "Can't drop Item.";
            labelDropIndicator.BackColor = System.Drawing.Color.Red;

           
            if (tool.pageCount == -1)
            {
                lblMsgBox.Text = "Problem on server";
                this.panelDrop.Enabled = false;
            }
            else if (tool.isActive) 
            {
                lblAvailablePage.Text = tool.pageCount.ToString();

                if (tool.pageCount == 0)
                {
                    lblMsgBox.Text = "No page left.!";
                    this.panelDrop.Enabled = false;
                }
                else
                {
                    labelDropIndicator.Text = "Drag and drop your files here -->";
                    labelDropIndicator.BackColor = System.Drawing.Color.Transparent;
                    lblNewPageCount.Text = tool.afterPageCount().ToString();

                }
            }
            else
            {
                lblMsgBox.Text = "Id blocked";
                lblAvailablePage.Text = tool.pageCount.ToString();
                this.panelDrop.Enabled = false;
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
                                listBox1.Items.Add(fileName);

                                // for demo one file means page, so
                                lblNewPageCount.Text = tool.afterPageCount().ToString();
                                lblMsgBox.Text = "File successfully added.";
                            }
                            else lblMsgBox.Text = "This is not txt file.";

                        }
                        else break;                        
                    }
                }

            }
            catch (Exception catchedExcption)
            {
                lblMsgBox.Text = "Are you fool or something.";
            }
            finally
            {
                if (listBox1.Items.Count == tool.max)
                {
                    this.panelDrop.Enabled = false;
                    this.panelDrop.BackColor = System.Drawing.Color.Red;
                    this.labelDropIndicator.Text = "Reached to max limit 5";
                    lblMsgBox.Text = "Reached to maximum file limit.";
                }
            }

        }

        private string getFileName(string path)
        {
            if (Directory.Exists(path)) return "This is not a file";
            //else return Path.GetExtension(path);
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
            if(tool.transfer())
            {
                lbltest.Text = "File successfully sent to printer.";
                listBox1.Items.Clear();
                btnPrint.Enabled = false;
            }
        }
    }
}
