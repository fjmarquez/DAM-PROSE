package E2;

public class Adios extends Thread{
	
	public void run() {
		
		//Obtenemos el monitor que creamos en la clase Hola
		Object monitor = new Hola().getMonitor();
		
		//Bloque synchronized usando el objeto monitor
		synchronized(monitor) {
			
			//Iteramos hasta 50 veces
			for(int i = 0; i < 50; i++) {
				 
				//Mostramos por consola la palabra adios
				System.out.println("Adios");
				//Notificamos al otro hilo
				monitor.notify();
				
				try {
					//Dormimos el hilo
					monitor.wait();
					
				}catch(Exception e) {
					
				}
				
			}
			
		}

	}

}
