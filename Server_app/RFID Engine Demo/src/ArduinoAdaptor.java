
import java.util.HashMap;
import java.util.Map;
import java.util.Map.Entry;

import com.fazecast.jSerialComm.SerialPort;
import com.fazecast.jSerialComm.SerialPortDataListener;
import com.fazecast.jSerialComm.SerialPortEvent;


public class ArduinoAdaptor extends Thread{
	private  SerialPort[] ports;
	private SerialPort serialPort;
	private String errorMsg, data = "";

	ArduinoAdaptor(){
		ports = SerialPort.getCommPorts();	
	}
	public boolean isReadable() {
		if(ports.length == 0) {
			errorMsg = "Unable to connected with arduino.";
			return false;
		}
		serialPort = ports[0];
		if(!serialPort.isOpen())if(serialPort.openPort())return true;
		errorMsg = "Serial port not found";
		return false;
	}
	public String getErrorMsg() {
		return errorMsg;
	}
	public void close() {
		serialPort.closePort();
	}

	//@Override
	public void run() {
		/*
		serialPort.setComPortParameters(9600, 8, 1, SerialPort.NO_PARITY);
		serialPort.setComPortTimeouts(SerialPort.TIMEOUT_READ_BLOCKING, 0, 0);
		try {Thread.sleep(1000);} catch (InterruptedException e) {}
		serialPort.writeBytes( "s".getBytes(), 1); // sending scanning signal
		startReading();*/
		Tools.id = "E6F8CF7";
	}
	private void startReading() { // support of test1
		serialPort.addDataListener(new SerialPortDataListener() {
			@Override
			public int getListeningEvents() { return SerialPort.LISTENING_EVENT_DATA_RECEIVED; }
			@Override
			public void serialEvent(SerialPortEvent event)
			{
				String[] rawData = new String(event.getReceivedData()).split("\n",25); 
				for(int i = 0; i<rawData.length; i++)rawData[i] = rawData[i].trim();
				data = getId(rawData);
				if(!data.equals("") && data.length() > 5) {    // got id huhu 
					Tools.id = data;
					//System.out.println("ID: "+Master.getId());
					serialPort.writeBytes("o".getBytes(), 1);  // sending stop signal
					return;
				}
				try {Thread.sleep(500);} catch (InterruptedException e) {}
			}
		});
		

	}
	
	private String getId(String[] names){
		String name = names[2];
		int count = 0;
		for(int i = 0; i < names.length; i++){
			if(name.equalsIgnoreCase(names[i]))count++;
			if(count>5 && !name.equals("Nothing to give"))return name.toUpperCase();
		}
		return "Error";
	}
	
	private String getIdIfBuffer(String[] arr) 
    { 
		int n = arr.length,  max_count = 0;
        String res = ""; 
        System.out.println("Got iD called");
        Map<String, Integer> mp = new HashMap<>();
        for (int i = 0; i < n; i++){ 
            if (mp.containsKey(arr[i]))mp.put(arr[i], mp.get(arr[i]) + 1); 
            else mp.put(arr[i], 1); 
        }  
        
        for(Entry<String, Integer> val : mp.entrySet()) 
        { 
            if (max_count < val.getValue()){ 
                res = val.getKey(); 
                max_count = val.getValue(); 
            } 
        } 
        System.out.println(res+"  res length: "+res.length());
       return res.toUpperCase();
    } 
	

}
