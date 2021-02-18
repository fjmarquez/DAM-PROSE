package E4;


public class SumaArrayHilo2 extends Thread {
	//Obtenemos el mismo objeto monitor que usamos en SumaArrayHilo1
	Object monitor = SumaArrayHilo1.getMonitor();

	public void run() {
		//Bloque sinchronized
		synchronized(monitor) {
			while(true) {			
				//Iteramos la segunda mitad del array
				for(int i = (SumaArrayHilo1.getNumeros().length/2); i < SumaArrayHilo1.getNumeros().length; i++) {
					//Iteramos el array al completo para cotejar con los valores de la segunda mitad del array
					for(int x = 0; x < SumaArrayHilo1.getNumeros().length; x++) {
						
						int num1 = SumaArrayHilo1.getNumeros()[i];
						int num2 = SumaArrayHilo1.getNumeros()[x];
						//Si los indices son diferentes y los numeros son iguales, se procedera a sumar
						if(i != x && num1 == num2) {
							
							SumaArrayHilo1.sumarSuma(SumaArrayHilo1.getNumeros()[i]);
							
						}
						
					}
					
				}
				//Notificamos al otro hilo
				monitor.notify();
				//Mostramos el resultado actual y final para este array
				System.out.println("Resultado actual en hilo2: " + SumaArrayHilo1.getSuma());
				
				try {
					//Dormimos el hilo
					monitor.wait();
				} catch (InterruptedException e) {
					e.printStackTrace();
				}
				
			}
			
		}
		
	}
	
}
