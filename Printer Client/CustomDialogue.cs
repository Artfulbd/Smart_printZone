using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Printer_Client
{
    public partial class CustomDialogue : Form
    {
        
        private string _file_name;
        private string _size;
        private string _pg_count;
        private string _msg;

        public CustomDialogue(string name)
        {
            InitializeComponent();
            this.lblTitel.Text = name;
        }


        [Category("Custom Props")]
        public string msg
        {
            get { return _msg; }
            set { _msg = value; lblMsg.Text = value; }
        }

        [Category("Custom Props")]
        public string file_name
        {
            get { return _file_name; }
            set { _file_name = value; lblFileName.Text = value; }
        }

        [Category("Custom Props")]
        public string size
        {
            get { return _size; }
            set { _size = value; lblSize.Text = value; }
        }

        [Category("Custom Props")]
        public string page_count
        {
            get { return _pg_count; }
            set { _pg_count = value; lblPageCount.Text = value; }
        }
    }
}
