using RestSharp;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Printer_Client
{

    class User
    {
        public event EventHandler<FileType> PendingFileInsertionEvent;
        public string id { get; private set; }
        public string name { get; private set; }
        
        public  int printed_page_count { get; private set; }
        public  int page_left { get; private set; }
        private HashSet<FileType> file_list;        // doesn't take duplicate items
        private Tools _tool;
        private bool isActivated = false;
        private double nowTotalSize;
        private int nowTotalPage;

        public User(Tools tool)
        {
            file_list = new HashSet<FileType>();
            _tool = tool;
            id = tool.getId();
        }
        public bool isActive() { return isActivated; }

        public int nowHasTotalPage()
        {
            return this.nowTotalPage;
        }
        public bool addFile(FileType file)
        {
            // isViolating raises---> all three violation event
            if(!_tool.isViolating(file, nowTotalPage, file_list.Count, nowTotalSize) && !file_list.Contains(file))
            {
                if(file_list.Add(file))
                {
                    nowTotalSize += file.size;
                    nowTotalPage += file.page_count;
                    return true;
                }
            }
            return false;
        }
        

        public void getCredentials()
        {
            if(_tool.hasSuccessfullFetch())
            {
                isActivated = true;
                dynamic res = Newtonsoft.Json.Linq.JObject.Parse(_tool.getCredentialRespons().Content.ToString());
                name = res.name;
                printed_page_count = res.pgPrinted;
                page_left = res.pgLeft;

                int pending = res.filePending;
                for (int i = 0; i < pending; i++)
                {
                    FileType file = new FileType((string)res.files[i].file_name, (double)res.files[i].size, (int)res.files[i].pg_count, (string)res.files[i].time, true);
                    PendingFileInsertionEvent?.Invoke(this, file);
                }
            }
        }
         

        public void refreshEverything()
        {
            
        }
        
        
    }
}
