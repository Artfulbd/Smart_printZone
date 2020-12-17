using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Printer_Client
{

    class User
    {

        public string id { get; }
        public string machine_name { get;  }
        public static string temp_dir { get; }
        public static string hidden_dir { get; }
        public static string server_dir { get; }

        public string name { get; private set; }
        public double max_size_total { get; private set; }
        public int max_file_count { get; private set; }
        public int printed_page_count { get; private set; }
        public int page_left { get; private set; }
        private HashSet<FileType> file_list;  // doesn't take duplicate items
        private Communicator com;

        private bool isActivated = false;

        public User()
        {
            file_list = new HashSet<FileType>();
            this.id = System.Security.Principal.WindowsIdentity.GetCurrent().Name;
            this.machine_name = Environment.MachineName;
            com = new Communicator();

            //check com object and make isActivated field true
            getCredentials();


        }

        public bool isActive() { return this.isActivated; }

        public void addFile(FileType file)
        {
            file_list.Add(file);
            //add it to List box also
        }

        public void removeFile(FileType file)
        {
            bool is_deleted = com.removeFile(file.file_name);
            if (is_deleted)
            {
                file_list.Remove(file);
                //delete from list box
                //show file successfully deleted dialog
            }
        }


        private void getCredentials()
        {
            com.getRespons(); //will return IRestResponse
            //get everythig from it
        }
         

        public void refreshEverything()
        {
            getCredentials();
        }
        
        
    }
}
