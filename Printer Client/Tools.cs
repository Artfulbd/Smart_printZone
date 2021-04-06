using Newtonsoft.Json.Linq;
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
        public event EventHandler<FileType> TotalFileCountExceedsEvent;
        public event EventHandler<string> IdDeactivatedEvent;
        private string id;
        private string machine_name;
        private string temp_dir;
        private string hidden_dir;
        private string server_dir;
        private double max_size_total;
        private int max_file_count;
        private int max_page_count;
        private Communicator com;
        private bool success;
        private bool is_active;
        public List<FileListItem> fli;

        public Tools()
        {
            //id = System.Security.Principal.WindowsIdentity.GetCurrent().Name;
            id = "1722231"; // for now
            //id = "1721277";
            machine_name = Environment.MachineName;
            com = new Communicator(id, machine_name);
            fli = new List<FileListItem>();
            com.initialRequest(generateKey());
            populateSelf();
        }

        private string generateKey()
        {
            return "nothing";
        }
        public bool isActive() { return this.is_active; }
        public double totalFileSizeMax() { return max_size_total; }
        public int fileCountMax() { return max_file_count; }

        public FileType prepareFile(string fullPath)
        {
            DateTime dateValue = DateTime.Now;
            string formatedTime = dateValue.ToString("yyyy-MM-dd HH:mm:ss");
            int page_count = new iTextSharp.text.pdf.PdfReader(fullPath).NumberOfPages;
            double size = new System.IO.FileInfo(fullPath).Length / 1024;
            FileType file = new FileType(Path.GetFileNameWithoutExtension(fullPath), size, page_count, formatedTime, false);
            string new_dir = this.hidden_dir + "/" + file.file_name + ".pdf";
            try
            {
                File.Copy(fullPath, new_dir, true);
            }
            catch (Exception e) { }
            return file;
        }
        public string getHiddenDir()
        {
            return this.hidden_dir;
        }

        public string getTempDir()
        {
            return this.temp_dir;
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

        public bool removeFile(Object sender, FileType file)
        {
            IRestResponse response = this.com.makeRemoveFileRequest(generateKey(), file);
            bool success = false;
            if ((int)response.StatusCode == 200 && response.Content.Contains("status"))
            {
                dynamic res = JObject.Parse(response.Content.ToString());

                try
                {
                    if (res.status == "1" && res.deleted == "1" && res.msg == "success")
                    {
                        return true;
                    }
                    else if (res.status == "0" && res.active == "0")
                    {
                        this.success = true;
                        this.is_active = false;
                        this.IdDeactivatedEvent?.Invoke(sender, "Id deactivated");
                        return false;
                    }

                }
                catch (Exception ex)
                {
                    // means problem on API
                    success = false;
                }
            }
            else
            {
                success = false;
            }
            // true if file successfully added to database via API;
            return success;
        }
        

        public bool takeFile(Object sender, FileType file)
        {
            
            IRestResponse response = this.com.makeTakeFileRequest(generateKey(), file);
            bool success = false;
            if ((int)response.StatusCode == 200 && response.Content.Contains("status"))
            {
                dynamic res = JObject.Parse(response.Content.ToString());
                
                    try
                    {
                        if(res.status == "1" && res.msg == "success")
                        {
                            return true;
                        }
                        else if(res.status == "1" && res.active == "0")
                        {
                            this.success = true;
                            string dir = this.server_dir + "/" + id + "_" + file.file_name + ".pdf";
                        
                            if(File.Exists(dir))
                            {
                                File.Delete(dir);
                            }
                            this.is_active = false;
                            this.IdDeactivatedEvent?.Invoke(sender,"Id deactivated");
                            return false;
                    }
                        
                    }
                    catch (Exception ex)
                    {
                        success = false;
                    }
            }
            else
            {
                success = false;
            }
            // true if file successfully added to database via API;
            return success;
        }

        public bool isViolating(FileType file, int nowTotalPage, int nowTotalHas, double nowTotalSize)
        {
            if (this.max_file_count > 0 && nowTotalPage + file.page_count > this.max_page_count)
            {
                // violated page limit
                PageLimitExceedsEvent?.Invoke(this, file);
                return true;
            }
            if (this.max_file_count > 0 && nowTotalHas + 1 > this.max_file_count)
            {
                // violated page limit
                TotalFileCountExceedsEvent?.Invoke(this, file);
                return true;
            }
            if(this.max_size_total > 0 && nowTotalSize + file.size > this.max_size_total)
            {
                //violated max file size limit
                TotalFileSizeExceedsEvent?.Invoke(this, file);
                return true;
            }
            return false;
        }

        public String getId()
        {
            return id;
        }

        public void populateSelf()
        {
            IRestResponse response = com.getInitialRespons();

            if ((int)response.StatusCode == 200 && response.Content.Contains("status"))
            {
                dynamic res = JObject.Parse(response.Content.ToString());

                try
                {
                    if (res.status == "1" && res.active == "1")
                    {
                        this.temp_dir = res.temp;
                        this.hidden_dir = res.hidden;
                        this.server_dir = res.server;
                        this.max_size_total = res.maxSizeTotal;
                        this.max_file_count = res.maxFileCount;
                        this.max_page_count = res.pgLeft;
                        this.is_active = true;

                    }
                    else if (res.status == "1" && res.active == "0")
                    {  //id deactivated
                        this.is_active = false;
                    }
                    this.success = true;
                }
                catch (Exception ex)
                {
                    this.success = false;
                    throw new Exception("API respons not appropriate.");
                    
                }

            }
            else
            {
                this.success = false;
            }
        }

        //
        // Summary:
        //     returns true if fetching was successfull and ID is active, Must check before Creating User class
        public bool hasSuccessfullFetch()
        {
            return this.success;
        }


        public IRestResponse getCredentialRespons()
        {
            return com.getInitialRespons();
        }
    }
}
