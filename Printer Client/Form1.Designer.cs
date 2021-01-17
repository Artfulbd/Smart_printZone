
namespace Printer_Client
{
    partial class Dashboard
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.lblName = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.btnAdd = new System.Windows.Forms.Button();
            this.btnRemove = new System.Windows.Forms.Button();
            this.flowLayoutPanel = new System.Windows.Forms.FlowLayoutPanel();
            this.btnRefresh = new System.Windows.Forms.Button();
            this.laber22 = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.panel1 = new System.Windows.Forms.Panel();
            this.label5 = new System.Windows.Forms.Label();
            this.lblPageLeft = new System.Windows.Forms.Label();
            this.lblTotalPrinted = new System.Windows.Forms.Label();
            this.lblOnQueue = new System.Windows.Forms.Label();
            this.lblWarning = new System.Windows.Forms.Label();
            this.panel1.SuspendLayout();
            this.SuspendLayout();
            // 
            // lblName
            // 
            this.lblName.AutoSize = true;
            this.lblName.Font = new System.Drawing.Font("Microsoft Sans Serif", 21.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lblName.ForeColor = System.Drawing.Color.DarkOrange;
            this.lblName.Location = new System.Drawing.Point(11, 9);
            this.lblName.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.lblName.Name = "lblName";
            this.lblName.Size = new System.Drawing.Size(231, 33);
            this.lblName.TabIndex = 0;
            this.lblName.Text = "Md. Ariful Haque";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Microsoft Sans Serif", 30F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.Location = new System.Drawing.Point(25, 423);
            this.label2.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(126, 46);
            this.label2.TabIndex = 1;
            this.label2.Text = "label2";
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Microsoft Sans Serif", 30F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label3.Location = new System.Drawing.Point(148, 423);
            this.label3.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(126, 46);
            this.label3.TabIndex = 2;
            this.label3.Text = "label3";
            // 
            // btnAdd
            // 
            this.btnAdd.Location = new System.Drawing.Point(33, 487);
            this.btnAdd.Margin = new System.Windows.Forms.Padding(2, 2, 2, 2);
            this.btnAdd.Name = "btnAdd";
            this.btnAdd.Size = new System.Drawing.Size(118, 33);
            this.btnAdd.TabIndex = 4;
            this.btnAdd.Text = "Add";
            this.btnAdd.UseVisualStyleBackColor = true;
            this.btnAdd.Click += new System.EventHandler(this.btnAdd_Click);
            // 
            // btnRemove
            // 
            this.btnRemove.Location = new System.Drawing.Point(156, 487);
            this.btnRemove.Margin = new System.Windows.Forms.Padding(2, 2, 2, 2);
            this.btnRemove.Name = "btnRemove";
            this.btnRemove.Size = new System.Drawing.Size(118, 33);
            this.btnRemove.TabIndex = 5;
            this.btnRemove.Text = "Remove";
            this.btnRemove.UseVisualStyleBackColor = true;
            this.btnRemove.Click += new System.EventHandler(this.btnRemove_Click);
            // 
            // flowLayoutPanel
            // 
            this.flowLayoutPanel.AllowDrop = true;
            this.flowLayoutPanel.Anchor = ((System.Windows.Forms.AnchorStyles)(((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.flowLayoutPanel.AutoScroll = true;
            this.flowLayoutPanel.BackColor = System.Drawing.Color.AliceBlue;
            this.flowLayoutPanel.BorderStyle = System.Windows.Forms.BorderStyle.Fixed3D;
            this.flowLayoutPanel.Location = new System.Drawing.Point(293, 48);
            this.flowLayoutPanel.Margin = new System.Windows.Forms.Padding(2, 2, 2, 2);
            this.flowLayoutPanel.Name = "flowLayoutPanel";
            this.flowLayoutPanel.Size = new System.Drawing.Size(832, 492);
            this.flowLayoutPanel.TabIndex = 6;
            this.flowLayoutPanel.DragDrop += new System.Windows.Forms.DragEventHandler(this.flowLayoutPanel_DragDrop);
            this.flowLayoutPanel.DragEnter += new System.Windows.Forms.DragEventHandler(this.flowLayoutPanel_DragEnter);
            this.flowLayoutPanel.MouseEnter += new System.EventHandler(this.flowLayoutPanel_MouseEnter);
            this.flowLayoutPanel.MouseLeave += new System.EventHandler(this.flowLayoutPanel_MouseLeave);
            // 
            // btnRefresh
            // 
            this.btnRefresh.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(0)))), ((int)(((byte)(192)))), ((int)(((byte)(192)))));
            this.btnRefresh.Font = new System.Drawing.Font("Microsoft Sans Serif", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btnRefresh.Location = new System.Drawing.Point(103, 235);
            this.btnRefresh.Margin = new System.Windows.Forms.Padding(2, 2, 2, 2);
            this.btnRefresh.Name = "btnRefresh";
            this.btnRefresh.Size = new System.Drawing.Size(90, 40);
            this.btnRefresh.TabIndex = 7;
            this.btnRefresh.Text = "Refresh";
            this.btnRefresh.UseVisualStyleBackColor = false;
            this.btnRefresh.Click += new System.EventHandler(this.btnRefresh_Click);
            // 
            // laber22
            // 
            this.laber22.AutoSize = true;
            this.laber22.Font = new System.Drawing.Font("Microsoft Sans Serif", 20.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.laber22.ForeColor = System.Drawing.SystemColors.ActiveCaptionText;
            this.laber22.Location = new System.Drawing.Point(2, 84);
            this.laber22.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.laber22.Name = "laber22";
            this.laber22.Size = new System.Drawing.Size(180, 31);
            this.laber22.TabIndex = 8;
            this.laber22.Text = "Total printed :";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Microsoft Sans Serif", 20.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.ForeColor = System.Drawing.SystemColors.ActiveCaptionText;
            this.label1.Location = new System.Drawing.Point(37, 53);
            this.label1.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(145, 31);
            this.label1.TabIndex = 9;
            this.label1.Text = "Page Left :";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Font = new System.Drawing.Font("Microsoft Sans Serif", 20.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label4.ForeColor = System.Drawing.SystemColors.ActiveCaptionText;
            this.label4.Location = new System.Drawing.Point(35, 115);
            this.label4.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(147, 31);
            this.label4.TabIndex = 10;
            this.label4.Text = "On queue :";
            // 
            // panel1
            // 
            this.panel1.BackColor = System.Drawing.Color.LavenderBlush;
            this.panel1.Controls.Add(this.lblOnQueue);
            this.panel1.Controls.Add(this.lblTotalPrinted);
            this.panel1.Controls.Add(this.lblPageLeft);
            this.panel1.Controls.Add(this.label5);
            this.panel1.Controls.Add(this.laber22);
            this.panel1.Controls.Add(this.label4);
            this.panel1.Controls.Add(this.label1);
            this.panel1.Location = new System.Drawing.Point(17, 48);
            this.panel1.Name = "panel1";
            this.panel1.Size = new System.Drawing.Size(257, 156);
            this.panel1.TabIndex = 11;
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Font = new System.Drawing.Font("Montserrat", 20.25F, System.Drawing.FontStyle.Underline, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label5.ForeColor = System.Drawing.SystemColors.ActiveCaptionText;
            this.label5.Location = new System.Drawing.Point(10, 0);
            this.label5.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(236, 33);
            this.label5.TabIndex = 11;
            this.label5.Text = "Page estimation";
            // 
            // lblPageLeft
            // 
            this.lblPageLeft.AutoSize = true;
            this.lblPageLeft.Font = new System.Drawing.Font("Microsoft Sans Serif", 20.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lblPageLeft.ForeColor = System.Drawing.SystemColors.ActiveCaptionText;
            this.lblPageLeft.Location = new System.Drawing.Point(176, 53);
            this.lblPageLeft.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.lblPageLeft.Name = "lblPageLeft";
            this.lblPageLeft.Size = new System.Drawing.Size(0, 31);
            this.lblPageLeft.TabIndex = 12;
            // 
            // lblTotalPrinted
            // 
            this.lblTotalPrinted.AutoSize = true;
            this.lblTotalPrinted.Font = new System.Drawing.Font("Microsoft Sans Serif", 20.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lblTotalPrinted.ForeColor = System.Drawing.SystemColors.ActiveCaptionText;
            this.lblTotalPrinted.Location = new System.Drawing.Point(176, 84);
            this.lblTotalPrinted.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.lblTotalPrinted.Name = "lblTotalPrinted";
            this.lblTotalPrinted.Size = new System.Drawing.Size(0, 31);
            this.lblTotalPrinted.TabIndex = 13;
            // 
            // lblOnQueue
            // 
            this.lblOnQueue.AutoSize = true;
            this.lblOnQueue.Font = new System.Drawing.Font("Microsoft Sans Serif", 20.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lblOnQueue.ForeColor = System.Drawing.SystemColors.ActiveCaptionText;
            this.lblOnQueue.Location = new System.Drawing.Point(176, 115);
            this.lblOnQueue.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.lblOnQueue.Name = "lblOnQueue";
            this.lblOnQueue.Size = new System.Drawing.Size(0, 31);
            this.lblOnQueue.TabIndex = 14;
            // 
            // lblWarning
            // 
            this.lblWarning.Font = new System.Drawing.Font("Microsoft Sans Serif", 30F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lblWarning.ForeColor = System.Drawing.Color.Blue;
            this.lblWarning.Location = new System.Drawing.Point(25, 542);
            this.lblWarning.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.lblWarning.Name = "lblWarning";
            this.lblWarning.Size = new System.Drawing.Size(1100, 46);
            this.lblWarning.TabIndex = 12;
            this.lblWarning.Text = "tst";
            this.lblWarning.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // Dashboard
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.Navy;
            this.ClientSize = new System.Drawing.Size(1136, 608);
            this.Controls.Add(this.lblWarning);
            this.Controls.Add(this.panel1);
            this.Controls.Add(this.btnRefresh);
            this.Controls.Add(this.flowLayoutPanel);
            this.Controls.Add(this.btnRemove);
            this.Controls.Add(this.btnAdd);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.lblName);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.Margin = new System.Windows.Forms.Padding(2, 2, 2, 2);
            this.MaximizeBox = false;
            this.MinimumSize = new System.Drawing.Size(1152, 647);
            this.Name = "Dashboard";
            this.SizeGripStyle = System.Windows.Forms.SizeGripStyle.Show;
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Printer Client";
            this.panel1.ResumeLayout(false);
            this.panel1.PerformLayout();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label lblName;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Button btnAdd;
        private System.Windows.Forms.Button btnRemove;
        private System.Windows.Forms.FlowLayoutPanel flowLayoutPanel;
        private System.Windows.Forms.Button btnRefresh;
        private System.Windows.Forms.Label laber22;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Panel panel1;
        private System.Windows.Forms.Label lblOnQueue;
        private System.Windows.Forms.Label lblTotalPrinted;
        private System.Windows.Forms.Label lblPageLeft;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label lblWarning;
    }
}

