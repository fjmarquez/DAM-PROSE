package E2;

public class Hola extends Thread{
	
	//Declaramos un objeto generico que usaremos como monitor en los bloques synchronized
	private static Object monitor = new Object();
	
	//Getter estatico del objeto monitor
	public static Object getMonitor() {
		return monitor;
	}
	
	public void run() {
		
		//Bloque synchronized
		synchronized(monitor) {
			
			//Iteramos hasta 50 veces
			for(int i = 0; i < 50; i++) {
				
				//Mostramos por consola la palabra hola
				System.out.println("Hola");
				//Notificamos al otro hilo
				monitor.notify();
				
				try {
					//Dormimos el hilo
					monitor.wait();
					
				}catch(Exception e) {
					System.out.println(e);
				}
				
			}
			
		}
		
	}

}
