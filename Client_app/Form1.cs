using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Smart_printZone_Client
{
    public partial class mainForm : Form
    {
        Tools tool = new Tools();
        public mainForm()
        {
            InitializeComponent();
            lblId.Text = tool.id;


            if (tool.pageCount == -1)
            {
                labelDropIndicator.Text = "Problem on server";
                labelDropIndicator.BackColor = System.Drawing.Color.Red;
                this.panelDrop.Enabled = false;

            }
            else if (tool.isActive) 
            {
                lblAvailablePage.Text = tool.pageCount.ToString();
                if(tool.pageCount == 0)
                {
                    labelDropIndicator.Text = "No page left.!";
                    labelDropIndicator.BackColor = System.Drawing.Color.Red;
                    this.panelDrop.Enabled = false;
                }
            }
            else
            {
                labelDropIndicator.Text = "Id blocked";
                labelDropIndicator.BackColor = System.Drawing.Color.Red;
                lblAvailablePage.Text = tool.pageCount.ToString();
                this.panelDrop.Enabled = false;
                this.panelDrop.BackColor = System.Drawing.Color.Red;
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
                        string fileName = getFileName(hold);
                        listBox1.Items.Add(fileName);
                        //listBox1.Items.Add(hold);
                    }
                }

            }
            catch (Exception catchedExcption)
            {
                listBox1.Items.Add("Are you fool or something");
            }
            finally
            {
                if (listBox1.Items.Count > 4)
                {
                    this.panelDrop.Enabled = false;
                    this.panelDrop.BackColor = System.Drawing.Color.Red;
                    this.labelDropIndicator.Text = "Reached to max limit 5";
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

        
    }
}
