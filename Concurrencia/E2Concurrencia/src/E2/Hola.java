package E2;

public class Hola extends Thread{
	
	private static Object monitor = new Object();
	
	public static Object getMonitor() {
		return monitor;
	}
	
	public void run() {
		
		synchronized(monitor) {
			
			for(int i = 0; i < 50; i++) {
				
				System.out.println("Hola");
				monitor.notify();
				
				try {
					
					monitor.wait();
					
				}catch(Exception e) {
					System.out.println(e);
				}
				
			}
			
			
			
		}
		
	}

}
