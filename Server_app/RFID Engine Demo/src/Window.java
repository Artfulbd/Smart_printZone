import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JLabel;

import java.awt.Font;
import java.util.ArrayList;
import java.awt.Color;

public class Window {

	ArduinoAdaptor ad;
	private Tools tool;
	JFrame frmRfidEngine;
	private JLabel lblName, lblNewLabel, lblStatus, lblId, lblListening, label_1;
	private final String BASE = "Listening";

	/**
	 * Launch the application.
	 */

	public static void main(String[] args) {
		Window window = new Window();
		try {

			window.frmRfidEngine.setVisible(true);

		} catch (Exception e) {
			e.printStackTrace();
			return;
		}
		window.start();

	}
	
	void start() {
		ad = new ArduinoAdaptor();
		Tools.hold = "";
		int wait = 0;
		String temp = "";
		int i = 0;
		disableAll();
		lblListening.setText("Getting ready");
		/*
		if(true) {
			Tools.hold = "511ED5";*/
	    if(ad.isReadable()) {
			ad.run();
			while(Tools.hold.equals("")) {//hold
				if(i % 4 == 0)temp = BASE;
				lblListening.setText(temp);
				temp += ".";
				i++;
				try {Thread.sleep(500);} catch (InterruptedException e) {}
				
			}
			ad.close();
			ad.interrupt();
			
			tool = new Tools();
			
			if(getAndSetData(tool)) {
				activeAll();
				wait = 3000;
			}
			else {// false punch
				lblListening.setText("False punch..!");
				wait = 3000;
			}
			try {Thread.sleep(wait);} catch (InterruptedException e) {}
			start();
			
		}
		else{
			lblListening.setText("Problem on adaptor.!!");
		}
	}
	
	private boolean getAndSetData(Tools tool) {
		ArrayList<Pair> fileList = new ArrayList<>();
		if(tool.isvalid(Tools.hold)) {
			lblId.setText(tool.getId());
			lblName.setText(tool.getName());
			
			fileList = tool.getFiles();
			if(fileList.size() == 0) {
				lblStatus.setText("Nothing to print.");
			}
			else {
				lblStatus.setText("Printing.. collect it from tray");
				tool.printThis(fileList);
			}
			return true;
		}
		return false;
	}
	private void disableAll(){
		lblName.setVisible(false);
		lblNewLabel.setVisible(false);
		lblStatus.setVisible(false);
		lblId.setVisible(false);
		label_1.setVisible(false);
		lblListening.setVisible(true);
	}
	
	private void activeAll() {
		lblName.setVisible(true);
		lblNewLabel.setVisible(true);
		lblStatus.setVisible(true);
		lblId.setVisible(true);
		label_1.setVisible(true);
		lblListening.setVisible(false);		
	}

	/**
	 * Create the application.
	 */
	public Window() {
		initialize();
		
	}

	/**
	 * Initialize the contents of the frame.
	 */
	private void initialize() {
		frmRfidEngine = new JFrame();
		frmRfidEngine.getContentPane().setBackground(Color.WHITE);
		frmRfidEngine.setTitle("RFID Engine");
		frmRfidEngine.setBounds(100, 100, 1202, 677);
		frmRfidEngine.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frmRfidEngine.getContentPane().setLayout(null);
		
		lblNewLabel = new JLabel("Now puched:");
		lblNewLabel.setFont(new Font("Verdana", Font.BOLD, 40));
		lblNewLabel.setBounds(262, 75, 293, 50);
		frmRfidEngine.getContentPane().add(lblNewLabel);
		
		lblName = new JLabel("Md. Ariful Haque");
		lblName.setForeground(new Color(244, 164, 96));
		lblName.setFont(new Font("Rockwell", Font.BOLD, 30));
		lblName.setBounds(562, 76, 293, 32);
		frmRfidEngine.getContentPane().add(lblName);
		
		lblStatus = new JLabel("Printing.. collect it from tray");
		lblStatus.setForeground(new Color(255, 0, 0));
		lblStatus.setFont(new Font("Rockwell Condensed", Font.BOLD, 56));
		lblStatus.setBounds(301, 268, 859, 62);
		frmRfidEngine.getContentPane().add(lblStatus);
		
		lblId = new JLabel("1722231042");
		lblId.setForeground(new Color(244, 164, 96));
		lblId.setFont(new Font("Verdana", Font.BOLD, 25));
		lblId.setBounds(562, 107, 190, 32);
		frmRfidEngine.getContentPane().add(lblId);
		
		lblListening = new JLabel("Problem on adaptor");
		lblListening.setForeground(new Color(255, 69, 0));
		lblListening.setFont(new Font("Verdana", Font.BOLD, 50));
		lblListening.setBounds(312, 210, 661, 62);
		frmRfidEngine.getContentPane().add(lblListening);
		
		label_1 = new JLabel("Status:");
		label_1.setForeground(new Color(0, 0, 139));
		label_1.setFont(new Font("Verdana", Font.BOLD, 50));
		label_1.setBounds(73, 268, 202, 62);
		frmRfidEngine.getContentPane().add(label_1);
	}
}
