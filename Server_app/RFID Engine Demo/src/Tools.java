
import java.sql.*;
import java.util.ArrayList;



public class Tools {
	static String hold = "";
	private String errorMsg = "";
	

	private String id = "";
	private String name = "";
	
	private final static String getFileURL = "http://localhost/pZone/giveFile.php";
	
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
			if(rset.next()){
				fileList.add(new Pair(rset.getNString("fileName"),rset.getInt("page")));
			}	
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			//e.printStackTrace();
			errorMsg = e.toString();
		}
		return fileList;		
	}

	public static void printThis(ArrayList<String> fileList) {

	}

	boolean printThisOne() {
		return true;
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
