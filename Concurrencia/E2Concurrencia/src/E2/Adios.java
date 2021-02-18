package E2;

public class Adios extends Thread{
	
	public void run() {
		
		Object monitor = new Hola().getMonitor();
		
		synchronized(monitor) {
			
			for(int i = 0; i < 50; i++) {
				 
				System.out.println("Adios");
				monitor.notify();
				
				try {
					
					monitor.wait();
					
				}catch(Exception e) {
					
				}
				
			}
			
			
			
		}

	}

}
