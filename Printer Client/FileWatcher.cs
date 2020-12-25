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
        public bool isListening { get; }
        static FileSystemWatcher watcher;
        public static event EventHandler<FileInsertionEventArgs> FileInsertionEvent;
        public FileWatcher(string temp_dir, string hidden_dir)
        {
            this.temp_dir = temp_dir;
            this.hidden_dir = hidden_dir;
            if (Directory.Exists(temp_dir) && Directory.Exists(hidden_dir))
            {
                listen();
                this.isListening = true;
            }
            else this.isListening = false;            
        }
        private void makeFile(string text)
        {
            string fileName = hidden_dir+ text+".txt";

            try
            {
                // Check if file already exists. If yes, delete it.     
                if (File.Exists(fileName))
                {
                    File.Delete(fileName);
                }

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
        private void listen()
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

        }
        public void OnCreated(object source, FileSystemEventArgs e)
        {
            // Specify what is done when a file is changed, created, or deleted.
            string old = e.FullPath;
            string new_dir = this.hidden_dir + e.Name;
            Thread.Sleep(500);
            File.Copy(old, new_dir, true);
            File.Delete(old);
            fireEvent(new_dir);
            makeFile(Thread.CurrentThread.ManagedThreadId.ToString());
        }
        //protected virtual void fireEvent(string file_name)
        //{
        //    FileInsertionEvent?.Invoke(this, new FileInsertionEventArgs(file_name));
        //}
        private void fireEvent(string file_name)
        {
            FileInsertionEvent?.Invoke(this, new FileInsertionEventArgs(file_name));
        }
    }
}
