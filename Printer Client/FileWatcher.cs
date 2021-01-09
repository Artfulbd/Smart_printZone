using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace Printer_Client
{
    class FileWatcher
    {
        private string temp_dir;
        private string hidden_dir;
        private string type = "*.pdf";
        public bool isListening { get; private set; }
        private bool isActive;
        static FileSystemWatcher watcher;
        public event EventHandler<FileInsertionEventArgs> FileInsertionEvent;
        public event EventHandler<FileInsertionEventArgs> DuplicateFileInsertionEvent;
        public FileWatcher(User usr, Tools tool)
        {
            this.temp_dir = tool.getTempDir();
            this.hidden_dir = tool.getHiddenDir();
            isActive = usr.isActive();
        }
        public static void makeFile(string dir, string text)

        {
            string fileName = dir+"testing.txt";

            try
            {
                

                // Create a new file     
                using (FileStream fs = File.Create(fileName))
                {
                    // Add some text to file    
                    Byte[] title = new UTF8Encoding(true).GetBytes(text);
                    fs.Write(title, 0, title.Length);
                    byte[] author = new UTF8Encoding(true).GetBytes("Chreated");
                    fs.Write(author, 0, author.Length);
                }

                // Open the stream and read it back.    
                using (StreamReader sr = File.OpenText(fileName))
                {
                    string s = "";
                    while ((s = sr.ReadLine()) != null)
                    {
                        Console.WriteLine(s);
                    }
                }
            }
            catch (Exception Ex)
            {
                Console.WriteLine(Ex.ToString());
            }
        }
        
        private void cleanDirectory()
        {
            if (Directory.Exists(this.temp_dir))
            {
                System.IO.DirectoryInfo di = new DirectoryInfo(this.temp_dir);
                foreach (FileInfo file in di.GetFiles())
                {
                    file.Delete();
                }
            }
            else Directory.CreateDirectory(this.temp_dir);

            if (Directory.Exists(this.hidden_dir))
            {
                System.IO.DirectoryInfo di = new DirectoryInfo(this.hidden_dir);
                foreach (FileInfo file in di.GetFiles())
                {
                    file.Delete();
                }
            }
            else Directory.CreateDirectory(this.hidden_dir);

        }
        public void listen()
        {
            if (this.isActive)
            {
                cleanDirectory();
                watcher = new FileSystemWatcher(this.temp_dir);
                // Watch for changes in LastAccess and LastWrite times, and
                // the renaming of files.
                watcher.NotifyFilter = NotifyFilters.LastAccess
                                        | NotifyFilters.LastWrite
                                        | NotifyFilters.FileName
                                        | NotifyFilters.DirectoryName;

                // Only watch pdf files on our case.
                watcher.Filter = "*.pdf";

                // Add event handlers.
                watcher.Created += OnCreated;

                // Begin watching.
                watcher.EnableRaisingEvents = true;
                this.isListening = true;
            }
            else this.isListening = false;
            

        }
        private void OnCreated(object source, FileSystemEventArgs e)
        {
            // Specify what is done when a file is changed, created, or deleted.
            
            fireEvent(e);
            //makeFile(Thread.CurrentThread.ManagedThreadId.ToString());
        }
        //protected virtual void fireEvent(string file_name)
        //{
        //    FileInsertionEvent?.Invoke(this, new FileInsertionEventArgs(file_name));
        //}
        private void fireEvent(FileSystemEventArgs e)
        {
            string old = e.FullPath;
            string new_dir = this.hidden_dir +"/"+ e.Name;
            try
            {
                Thread.Sleep(500);
                File.Copy(old, new_dir, false);
                File.Delete(old);
                Thread.Sleep(500);
                FileInsertionEvent?.Invoke(this, new FileInsertionEventArgs(new_dir));
            }
            catch(Exception ex)
            {
                DuplicateFileInsertionEvent?.Invoke(this, new FileInsertionEventArgs(new_dir));
            }
            
            
        }
    }
}
