using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace PrintControllerDemo
{
    public partial class Ser : Form
    {
        private Communicator com;
        private Controller control_obg;
        public Ser()
        {
            InitializeComponent();
            com = new Communicator();
            control_obg = new Controller(com);
        }

        private void button1_Click(object sender, EventArgs e)
        {
            this.lblStatus.Text = control_obg.freeSlotCount().ToString();
            if(control_obg.freeSlotCount() > 0)
            {
                control_obg.punch(this.txtBoxId.Text.ToString());
                //this.lblStatus.Text = "#"+this.txtBoxId.Text.ToString()+"#";
            }
        }
    }
}
