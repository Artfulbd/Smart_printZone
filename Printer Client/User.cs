using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Printer_Client
{
//    - name: string
//- machin_name: string 
//- max_size_total: double
//- printed_page_count: int
//- page_left: int
//- file_list: FileType
//- com: Communicator
    class User
    {

        public string id { get; }
        public string machine_name { get;  }

        private string name;
        private double max_size_total;
        private int printed_page_count;
        private int page_left;
        private HashSet<FileType> file_list;  // doesn't take duplicate items
        private Communicator com;

        public User()
        {
            file_list = new HashSet<FileType>();
            this.id = System.Security.Principal.WindowsIdentity.GetCurrent().Name;
            this.machine_name = Environment.MachineName;
            com = new Communicator();
           
        }

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
            //com.getRespons() //will return IRestResponse
            file_list.Remove(new FileType("adsad", 3, 3));
        }
         

        public void refreshEverything()
        {

        }

    }
}
