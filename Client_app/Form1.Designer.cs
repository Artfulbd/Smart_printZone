namespace Smart_printZone_Client
{
    partial class mainForm
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
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(mainForm));
            this.labelDropIndicator = new System.Windows.Forms.Label();
            this.listBox1 = new System.Windows.Forms.ListBox();
            this.lblId = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.lblAvailablePage = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.lblNewPageCount = new System.Windows.Forms.Label();
            this.label5 = new System.Windows.Forms.Label();
            this.lblMsgBox = new System.Windows.Forms.Label();
            this.btnPrint = new System.Windows.Forms.Button();
            this.panelDrop = new System.Windows.Forms.Panel();
            this.label2 = new System.Windows.Forms.Label();
            this.lbltest = new System.Windows.Forms.Label();
            this.panelDrop.SuspendLayout();
            this.SuspendLayout();
            // 
            // labelDropIndicator
            // 
            this.labelDropIndicator.AutoSize = true;
            this.labelDropIndicator.BackColor = System.Drawing.Color.Transparent;
            this.labelDropIndicator.Font = new System.Drawing.Font("MV Boli", 12F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.labelDropIndicator.Location = new System.Drawing.Point(648, 592);
            this.labelDropIndicator.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.labelDropIndicator.Name = "labelDropIndicator";
            this.labelDropIndicator.Size = new System.Drawing.Size(267, 21);
            this.labelDropIndicator.TabIndex = 0;
            this.labelDropIndicator.Text = "Drag and drop your files here -->";
            this.labelDropIndicator.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // listBox1
            // 
            this.listBox1.BackColor = System.Drawing.SystemColors.Info;
            this.listBox1.Font = new System.Drawing.Font("Rockwell", 19.8F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.listBox1.FormattingEnabled = true;
            this.listBox1.ItemHeight = 30;
            this.listBox1.Location = new System.Drawing.Point(541, 50);
            this.listBox1.Margin = new System.Windows.Forms.Padding(2, 2, 2, 2);
            this.listBox1.Name = "listBox1";
            this.listBox1.Size = new System.Drawing.Size(506, 304);
            this.listBox1.TabIndex = 1;
            // 
            // lblId
            // 
            this.lblId.AutoSize = true;
            this.lblId.Font = new System.Drawing.Font("Microsoft Sans Serif", 16.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lblId.Location = new System.Drawing.Point(678, 4);
            this.lblId.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.lblId.Name = "lblId";
            this.lblId.Size = new System.Drawing.Size(86, 26);
            this.lblId.TabIndex = 2;
            this.lblId.Text = "UserID";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Microsoft YaHei UI", 16.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(11, 4);
            this.label1.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(150, 30);
            this.label1.TabIndex = 3;
            this.label1.Text = "Page count :";
            // 
            // lblAvailablePage
            // 
            this.lblAvailablePage.AutoSize = true;
            this.lblAvailablePage.BackColor = System.Drawing.Color.Transparent;
            this.lblAvailablePage.Font = new System.Drawing.Font("Microsoft YaHei UI", 16.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lblAvailablePage.ForeColor = System.Drawing.Color.Orange;
            this.lblAvailablePage.Location = new System.Drawing.Point(155, 4);
            this.lblAvailablePage.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.lblAvailablePage.Name = "lblAvailablePage";
            this.lblAvailablePage.Size = new System.Drawing.Size(27, 30);
            this.lblAvailablePage.TabIndex = 4;
            this.lblAvailablePage.Text = "0";
            this.lblAvailablePage.TextAlign = System.Drawing.ContentAlignment.TopCenter;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Microsoft YaHei UI", 16.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label3.Location = new System.Drawing.Point(9, 37);
            this.label3.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(307, 30);
            this.label3.TabIndex = 5;
            this.label3.Text = "Page count after printing :";
            // 
            // lblNewPageCount
            // 
            this.lblNewPageCount.AutoSize = true;
            this.lblNewPageCount.BackColor = System.Drawing.Color.Transparent;
            this.lblNewPageCount.Font = new System.Drawing.Font("Microsoft YaHei UI", 16.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lblNewPageCount.ForeColor = System.Drawing.Color.Orange;
            this.lblNewPageCount.Location = new System.Drawing.Point(309, 37);
            this.lblNewPageCount.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.lblNewPageCount.Name = "lblNewPageCount";
            this.lblNewPageCount.Size = new System.Drawing.Size(27, 30);
            this.lblNewPageCount.TabIndex = 6;
            this.lblNewPageCount.Text = "0";
            this.lblNewPageCount.TextAlign = System.Drawing.ContentAlignment.TopCenter;
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Font = new System.Drawing.Font("Microsoft YaHei UI", 16.2F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label5.Location = new System.Drawing.Point(624, 1);
            this.label5.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(50, 30);
            this.label5.TabIndex = 7;
            this.label5.Text = "ID :";
            // 
            // lblMsgBox
            // 
            this.lblMsgBox.AutoSize = true;
            this.lblMsgBox.BackColor = System.Drawing.Color.WhiteSmoke;
            this.lblMsgBox.Font = new System.Drawing.Font("Lucida Sans Typewriter", 26.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lblMsgBox.ForeColor = System.Drawing.Color.Red;
            this.lblMsgBox.Location = new System.Drawing.Point(46, 541);
            this.lblMsgBox.Name = "lblMsgBox";
            this.lblMsgBox.Size = new System.Drawing.Size(164, 39);
            this.lblMsgBox.TabIndex = 8;
            this.lblMsgBox.Text = "Welcome";
            // 
            // btnPrint
            // 
            this.btnPrint.BackColor = System.Drawing.Color.Transparent;
            this.btnPrint.Image = global::Smart_printZone_Client.Properties.Resources.printer;
            this.btnPrint.Location = new System.Drawing.Point(747, 382);
            this.btnPrint.Name = "btnPrint";
            this.btnPrint.Size = new System.Drawing.Size(92, 41);
            this.btnPrint.TabIndex = 10;
            this.btnPrint.UseVisualStyleBackColor = false;
            this.btnPrint.Click += new System.EventHandler(this.btnPrint_Click);
            // 
            // panelDrop
            // 
            this.panelDrop.AllowDrop = true;
            this.panelDrop.Anchor = ((System.Windows.Forms.AnchorStyles)((((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) 
            | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.panelDrop.BackColor = System.Drawing.Color.SandyBrown;
            this.panelDrop.BackgroundImage = ((System.Drawing.Image)(resources.GetObject("panelDrop.BackgroundImage")));
            this.panelDrop.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Center;
            this.panelDrop.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.panelDrop.Controls.Add(this.label2);
            this.panelDrop.Location = new System.Drawing.Point(925, 500);
            this.panelDrop.Margin = new System.Windows.Forms.Padding(2, 2, 2, 2);
            this.panelDrop.Name = "panelDrop";
            this.panelDrop.Size = new System.Drawing.Size(116, 113);
            this.panelDrop.TabIndex = 0;
            this.panelDrop.DragDrop += new System.Windows.Forms.DragEventHandler(this.panelDrop_DragDrop);
            this.panelDrop.DragEnter += new System.Windows.Forms.DragEventHandler(this.panelDrop_DragEnter);
            this.panelDrop.MouseEnter += new System.EventHandler(this.panelDrop_MouseEnter);
            this.panelDrop.MouseLeave += new System.EventHandler(this.panelDrop_MouseLeave);
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.BackColor = System.Drawing.Color.Transparent;
            this.label2.Location = new System.Drawing.Point(18, 89);
            this.label2.Margin = new System.Windows.Forms.Padding(2, 0, 2, 0);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(48, 13);
            this.label2.TabIndex = 1;
            this.label2.Text = "drop box";
            // 
            // lbltest
            // 
            this.lbltest.AutoSize = true;
            this.lbltest.Font = new System.Drawing.Font("Microsoft YaHei UI", 15.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbltest.Location = new System.Drawing.Point(67, 233);
            this.lbltest.Name = "lbltest";
            this.lbltest.Size = new System.Drawing.Size(149, 28);
            this.lbltest.TabIndex = 11;
            this.lbltest.Text = "Test purpose";
            // 
            // mainForm
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.AutoValidate = System.Windows.Forms.AutoValidate.EnableAllowFocusChange;
            this.BackColor = System.Drawing.Color.White;
            this.ClientSize = new System.Drawing.Size(1052, 621);
            this.Controls.Add(this.lbltest);
            this.Controls.Add(this.btnPrint);
            this.Controls.Add(this.lblMsgBox);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.lblNewPageCount);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.lblAvailablePage);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.lblId);
            this.Controls.Add(this.listBox1);
            this.Controls.Add(this.labelDropIndicator);
            this.Controls.Add(this.panelDrop);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.Icon = ((System.Drawing.Icon)(resources.GetObject("$this.Icon")));
            this.Margin = new System.Windows.Forms.Padding(2, 2, 2, 2);
            this.MaximizeBox = false;
            this.Name = "mainForm";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Smart Priner";
            this.panelDrop.ResumeLayout(false);
            this.panelDrop.PerformLayout();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Panel panelDrop;
        private System.Windows.Forms.Label labelDropIndicator;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.ListBox listBox1;
        private System.Windows.Forms.Label lblId;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label lblAvailablePage;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label lblNewPageCount;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label lblMsgBox;
        private System.Windows.Forms.Button btnPrint;
        private System.Windows.Forms.Label lbltest;
    }
}

