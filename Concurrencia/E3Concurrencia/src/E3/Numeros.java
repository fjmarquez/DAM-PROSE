package E3;

import java.util.Random;

public class Numeros extends Thread{
	
	private static Object monitor = new Object();
	private static int rInt;
	private static boolean esAcierto = false;
	
	public static Object getMonitor() {
		return monitor;
	}
	
	public static int getRInt() {
		return rInt;
	}
	
	public static boolean getEsAcierto() {
		return esAcierto;
	}
	
	public static void setEsAcierto(boolean respuesta) {
		esAcierto = respuesta;
	}
	
	
	public void run() {
		
		synchronized(monitor) {
			
			Random r = new Random();
			
			while(!esAcierto) {
				
				rInt = r.nextInt(10) + 1;
				System.out.println("Numero generado aleatoriamente: " + rInt);
				//monitor.notify();
				
				try {
					Thread.sleep(1500);
					//monitor.wait();
				} catch (InterruptedException e) {
					e.printStackTrace();
				}
				
			}
			
			try {
				monitor.wait();
			} catch (InterruptedException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
				
		}
		
	}

}
