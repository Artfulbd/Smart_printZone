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
    public partial class FileListItem : UserControl
    {
        private string _file_name;
        private double _size;
        private string _pg_count;
        private string _time;
        private int _index;

        public FileListItem()
        {
            InitializeComponent();

        }


        public void makeFlaxible()
        {
            this.Anchor = ((System.Windows.Forms.AnchorStyles)((((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom)
            | System.Windows.Forms.AnchorStyles.Left)
            | System.Windows.Forms.AnchorStyles.Right)));
        }

        [Category("Custom Props")]
        public int index
        {
            get { return _index; }
            set 
            { 
                _index = value; 
                lblIndex.Text = "[" + (value + 1).ToString() + "]";
                if(value%2 == 0)this.BackColor = System.Drawing.Color.DeepSkyBlue;
                else this.BackColor = System.Drawing.Color.RoyalBlue; 
            }
        }

        [Category("Custom Props")]
        public string file_name
        {
            get { return _file_name; }
            set { _file_name = value; lblFileName.Text = value; }
        }

        [Category("Custom Props")]
        public double size
        {
            get { return _size; }
            set { _size = value; lblSize.Text = value.ToString()+"KB"; }
        }

        [Category("Custom Props")]
        public string page_count
        {
            get { return _pg_count; }
            set { _pg_count = value; lblPageCount.Text = value; }
        }

        [Category("Custom Props")]
        public string time
        {
            get { return _time; }
            set { _time = value; lblTime.Text = value; }
        }

    }
}
