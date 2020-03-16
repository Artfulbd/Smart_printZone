using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ConsoleTester
{
    class Program
    {
        static void Main(string[] args)
        {
            //\\61V5TDL-SERVER\ServerFolder
            //\\10.100.6.56\ServerFolder
            
            string serverName = "10.100.6.56";
            string srcFolder = @"D:\Workspace\ConsoleTester\filesToShare";
            string destFolder = @"\\"+serverName+@"\ServerFolder";
            int dirLength = srcFolder.Length + 1;
            bool isDone = false;


            try
            {
                //if only specific file type is needed, here docx
                //string[] fileList = Directory.GetFiles(srcFolder,"*.docx");
                string[] fileList = Directory.GetFiles(srcFolder);

                foreach(string singleFile in fileList)
                {
                    string fileName = singleFile.Substring(dirLength);
                    Console.WriteLine(fileName);

                    //overwrite file, if already exist
                    File.Copy(Path.Combine(srcFolder, fileName), Path.Combine(destFolder, fileName), true);

                    //doesn't overwrite if file already exist
                    //File.Copy(Path.Combine(srcFolder, fileName), Path.Combine(destFolder, fileName));

                    File.Delete(singleFile);
                }


                isDone = true;
            }
            catch(DirectoryNotFoundException drNotFound)
            {
                Console.WriteLine("Error.!! Dir not found, "+ drNotFound.Message);
            }
            if (isDone)
            {
                Console.WriteLine("File successfully copied");
            }

            Console.ReadLine();

        }
    }
}
