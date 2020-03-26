
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.sql.*;
import java.util.ArrayList;

import javax.print.Doc;
import javax.print.DocFlavor;
import javax.print.DocPrintJob;
import javax.print.PrintException;
import javax.print.PrintService;
import javax.print.PrintServiceLookup;
import javax.print.SimpleDoc;
import javax.print.attribute.HashPrintRequestAttributeSet;
import javax.print.attribute.PrintRequestAttributeSet;



public class Tools {
	static String hold = "";
	private String errorMsg = "";

	private String id = "";
	private String name = "";

	private final static String DIF_DIR = "D:\\ServerFolder\\";

	//for DB
	private Statement stmt ;
	private Connection conn;
	private String dbName = "smartprintzone";
	Tools(){
		errorMsg = "";
		try {
			conn = DriverManager.getConnection(
					"jdbc:mysql://localhost:3306/"+dbName+"?allowPublicKeyRetrieval=true&useSSL=false&serverTimezone=UTC",
					"root", "");
			stmt = conn.createStatement();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			//e.printStackTrace();
			errorMsg = e.toString();
		}

	}



	public static void main(String[] args) {
		// TODO Auto-generated method stub
		Window window = new Window();
		try {
			window.frmRfidEngine.setVisible(true);

		} catch (Exception e) {
			e.printStackTrace();
			return;
		}
		window.start();

	}

	String getId() {
		return id;
	}
	String getErrorMsg() {
		return errorMsg;
	}
	String getName() {
		return name;
	}

	public boolean isvalid(String rfid){
		errorMsg = "";
		String qry = "SELECT nsuId, studentName FROM `student` WHERE rfidNo = \""+rfid+"\"";
		try {
			ResultSet rset = stmt.executeQuery(qry);
			if(rset.next()){
				this.id = Integer.toString(rset.getInt("nsuId"));
				this.name = rset.getNString("studentName");
				return true;
			}
			return false;	
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			//e.printStackTrace();
			errorMsg = e.toString();
			return false;
		}

	}
	public ArrayList<Pair> getFiles() {
		ArrayList<Pair> fileList = new ArrayList<Pair>();
		errorMsg = "";
		String qry = "SELECT fileName, page FROM `printdata` WHERE nsuId = "+id;
		try {
			ResultSet rset = stmt.executeQuery(qry);
			while(rset.next()){
				fileList.add(new Pair(rset.getNString("fileName"),rset.getInt("page")));
				System.out.println(rset.getNString("fileName"));
			}	
		} catch (SQLException e) {
			errorMsg = e.toString();
		}
		return fileList;		
	}

	public void printThis(ArrayList<Pair> fileList) {
		ArrayList<String> printedFiles = new ArrayList<String>();
		int pageCount = 0;
		errorMsg = "";
		PrintService[] services = PrintServiceLookup.lookupPrintServices(null, null);
		DocFlavor flavor = DocFlavor.INPUT_STREAM.AUTOSENSE;
		PrintRequestAttributeSet aset = new HashPrintRequestAttributeSet();
		DocPrintJob job;

		for(Pair file : fileList) {
			File fileDir = new File(DIF_DIR + file.getFileName());
			FileInputStream textStream = null;
			try {
				textStream = new FileInputStream(fileDir);
			} catch (FileNotFoundException e1) {
				// TODO Auto-generated catch block
				errorMsg = e1.toString();
				System.out.println(errorMsg);
				continue;
			}
			Doc mydoc = new SimpleDoc(textStream, flavor, null);
			job = services[5].createPrintJob();
			try {
				job.print(mydoc, aset);
				printedFiles.add(file.getFileName());
			} catch (PrintException e) {
				// TODO Auto-generated catch block
				errorMsg = e.toString();
				System.out.println(errorMsg);
				continue;
			}
			pageCount += file.getPageCount();
		}
	    deleteThis(printedFiles);
		discardPage(pageCount);
	}
	
	private void deleteThis(ArrayList<String> fileList) {
		errorMsg = "";
		String qry = "DELETE FROM `printdata` WHERE fileName in (";
		int i = 0, sz = fileList.size();
		while(i<sz) {
			try { new File(DIF_DIR+fileList.get(i)).delete(); }catch(Exception EX) {}
			qry += "\""+fileList.get(i)+"\"";
			i++;
			if(sz == i)qry +=");";
			else qry += " , ";
		}
		try { 
			stmt.executeUpdate(qry);
		} catch (SQLException e) {
			errorMsg = e.toString();
		}
	}

	private void discardPage(int page) {
		errorMsg = "";
		String qry = "UPDATE `trace` SET `pgCount`= `pgCount` - "+page+" WHERE id = "+id;
		boolean done = false;
		int i = 0;
		while(!done && i<10) {
			try {
				int countUpdated = stmt.executeUpdate(qry);
				if(countUpdated > 0){
					done = true;
					return;
				}	
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				errorMsg = e.toString();
			}
			i++;
		}	
		if(i > 9)errorMsg = "Not discarded";
		
	}

}
class Pair{
	String fileName;
	int pageCount;
	Pair(String filename, int pageCount){
		this.fileName = filename;
		this.pageCount = pageCount;
	}
	String getFileName() {
		return fileName;
	}
	int getPageCount() {
		return pageCount;
	}
}
