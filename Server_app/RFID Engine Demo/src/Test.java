import java.io.File;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;

public class Test {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		Statement stmt = null ;
		Connection conn;
		try {
			conn = DriverManager.getConnection(
					"jdbc:mysql://localhost:3306/smartprintzone?allowPublicKeyRetrieval=true&useSSL=false&serverTimezone=UTC",
					"root", "");
			stmt = conn.createStatement();
		} catch (SQLException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
			return;
		}
		System.out.println("Starting");
		
		ArrayList<String> fileList = new ArrayList<>();
		String qry = "SELECT fileName, page FROM `printdata` WHERE nsuId = 1722231043";
		try {
			ResultSet rset = stmt.executeQuery(qry);
			while(rset.next()){
				fileList.add(rset.getNString("fileName"));
			}	
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
			
		}
		String DIF_DIR = "D:\\ServerFolder\\";
		qry = "DELETE FROM `printdata` WHERE fileName in (";
		int i = 0, sz = fileList.size();
		while(i<sz) {
			System.out.println(DIF_DIR+fileList.get(i));
			try { new File(DIF_DIR+fileList.get(i)).delete(); }catch(Exception EX) {}
			qry += "\""+fileList.get(i)+"\"";
			i++;
			if(sz == i)qry +=");";
			else qry += " , ";
		}
		System.out.println(qry);
		
		try {
			stmt.executeUpdate(qry);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
			
		}
		
		

	}

}
