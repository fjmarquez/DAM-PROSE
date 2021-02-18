package E3;

import java.util.Random;

public class Numeros extends Thread{
	
	private static Object monitor = new Object();
	private static int rInt;
	private static boolean esAcierto = false;
	
	//Getter estatico del objeto monitor
	public static Object getMonitor() {
		return monitor;
	}
	
	//Getter estatico del entero generado de forma aleatoria
	public static int getRInt() {
		return rInt;
	}
	
	//Getter estatico del booleano que indicara si hemos acertado o no el numero
	public static boolean getEsAcierto() {
		return esAcierto;
	}
	
	//Setter estatico del booleano que indicara si hemos acertado o no el numero
	public static void setEsAcierto(boolean respuesta) {
		esAcierto = respuesta;
	}
	
	
	public void run() {
		
		//Bloque synchronized
		synchronized(monitor) {
			
			//Usaremos Random para generar un entero aleatorio dentro de los limites que deseemos
			Random r = new Random();
			
			//Mientras la variable esAcierto tenga como valor false se ejecutara el bloque
			while(!esAcierto) {
				
				//Generamos el entero entre el 1 y el 10
				rInt = r.nextInt(10) + 1;
				//Mostramos por pantalla el numero generado
				System.out.println("Numero generado aleatoriamente: " + rInt);
				
				try {
					//Aplicamos un 'delay' al hilo de 1.5s para que el usuario tenga un intervalo de respuesta logico
					Thread.sleep(1500);
				} catch (InterruptedException e) {
					e.printStackTrace();
				}
				
			}
			
			try {
				//Cuando esAcierto sea true y finalicemos el bucle while, dormiremos el hilo
				monitor.wait();
			} catch (InterruptedException e) {
				e.printStackTrace();
			}
				
		}
		
	}

}
