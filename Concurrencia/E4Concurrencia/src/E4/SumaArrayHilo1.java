package E4;

public class SumaArrayHilo1 extends Thread{
	
	//Inicilizo el array de numeros
	static int[] numeros = new int[0];
	//Inicializo la suma
	static int suma = 0;
	
	//Declaro el objeto monitor que usare en los bloques sinchronized
	private static Object monitor = new Object();
	
	//Getter estatico del objeto monitor
	public static Object getMonitor() {
		return monitor;
	}
	//Getter estatico del array de numeros
	public static int[] getNumeros() {
		return numeros;
	}
	//Getter estatico de la suma
	public static int getSuma() {
		return suma;
	}
	//Setter estatico para modificar la suma
	public static void sumarSuma(int valor) {
		suma += valor;
	}
	
	public void run() {
		//Bloque sinchronized
		synchronized(monitor) {
			while(true) {
				//Reseteo la suma
				suma = 0;
				//Obtengo el array aleatorio
				numeros = SumaArray.generarArray();		
				//Itero solo la primera mitad del array
				for(int i = 0; i < numeros.length/2; i++) {
					//Itero el array para cotejar los valores con los de la primera mitad
					for(int x = 0; x < numeros.length; x++) {
						
						int num1 = numeros[i];
						int num2 = numeros[x];
						//Si los indices son diferentes y los numeros son iguales, se procede a sumar
						if(i != x && num1 == num2) {
							
							suma += numeros[i];
							
						}
						
					}
					
				}
				
				//Notificamos al otro hilo
				monitor.notify();
				
				//Mostramos el resultado hasta el momento
				System.out.println("Resultado actual en hilo1: " + suma);
				
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
