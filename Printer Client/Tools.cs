﻿using Newtonsoft.Json.Linq;
using RestSharp;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Printer_Client
{
    class Tools
    {
        public event EventHandler<FileType> PageLimitExceedsEvent;
        public event EventHandler<FileType> TotalFileSizeExceedsEvent;
        public event EventHandler<FileType> BothFileSizeAndLimitExceedsEvent;
        private string id;
        private string machine_name;
        private string temp_dir;
        private string hidden_dir;
        private string server_dir;
        private double max_size_total;
        private int max_file_count;
        private static Communicator com;
        private bool success;

        public Tools()
        {
            //id = System.Security.Principal.WindowsIdentity.GetCurrent().Name;
            id = "1722231042"; // for now
            machine_name = Environment.MachineName;
            com = new Communicator();
            com.initialRequest(machine_name, id, "nothing");
            populateSelf();
        }

        public double totalFileSizeMax() { return max_size_total; }
        public int fileCountMax() { return max_file_count; }

        public FileType prepareFile(string fullPath)
        {
            DateTime dateValue = DateTime.Now;
            string formatedTime = dateValue.ToString("yyyy-MM-dd HH:mm:ss");
            int page_count = new iTextSharp.text.pdf.PdfReader(fullPath).NumberOfPages;
            double size = new System.IO.FileInfo(fullPath).Length / 1024;
            FileType file = new FileType(Path.GetFileNameWithoutExtension(fullPath), size, page_count, formatedTime, false);
            string new_dir = this.server_dir + "/" + id + "_" + file.file_name + ".pdf";
            try
            {
                File.Copy(fullPath, new_dir, true);
            }
            catch (Exception e) { }
            return file;
        }
        public string getHiddenDir()
        {
            return hidden_dir;
        }

        public string getTempDir()
        {
            return temp_dir;
        }
        public bool sendFileToServer(FileType file)
        {
            string old_dir = this.hidden_dir + "/" + file.file_name + ".pdf";
            string new_dir = this.server_dir + "/" + id + "_" + file.file_name + ".pdf";
            try
            {
                File.Copy(old_dir, new_dir, true);
                File.Delete(old_dir);
            }
            catch(Exception e){}
            return File.Exists(new_dir);
        }
        public bool isViolating(FileType file, int nowTotalHas, double nowTotalSize)
        {
            bool sizeViolation = false;
            bool limitViolation = false;
            if (nowTotalHas + 1 > this.max_file_count)
            {
                // violated page limit
                limitViolation =  true;
            }
            if(nowTotalSize + file.size > this.max_size_total)
            {
                //violated max file size limit
                sizeViolation = true;
            }


            if(limitViolation && sizeViolation)
            {
                BothFileSizeAndLimitExceedsEvent?.Invoke(this, file);
            }
            else if(limitViolation)
            {
                PageLimitExceedsEvent?.Invoke(this, file);
            }
            else if(sizeViolation)
            {
                TotalFileSizeExceedsEvent?.Invoke(this, file);
            }
            
            return limitViolation || sizeViolation;
        }

        public string getId()
        {
            return id;
        }
        private void populateSelf()
        {
            IRestResponse response = com.getInitialRespons();

            if ((int)response.StatusCode == 200 && response.Content.Contains("status"))
            {
                dynamic res = JObject.Parse(response.Content.ToString());
                if (res.status == "1" && res.active == "1")
                {
                    try
                    {
                        this.success = true;
                        this.temp_dir = res.temp;
                        this.hidden_dir = res.hidden;
                        this.server_dir = res.server;
                        this.max_size_total = res.maxSizeTotal;
                        this.max_file_count = res.maxFileCount;
                    }catch(Exception ex)
                    {
                        throw new Exception("API respons not appropriate.");
                    }
                }
                else
                {
                    success = false;
                }
            }
            else
            {
                success = false;
            }
        }

        //
        // Summary:
        //     returns true if fetching was successfull and ID is active, Must check before Creating User class
        public bool hasSuccessfullFetch()
        {
            return success;
        }

        public IRestResponse getCredentialRespons()
        {
            return com.getInitialRespons();
        }
    }
}