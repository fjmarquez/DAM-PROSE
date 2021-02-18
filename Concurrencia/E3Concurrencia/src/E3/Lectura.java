package E3;

import java.util.Scanner;

public class Lectura extends Thread{
	
	//Object monitor = Numeros.getMonitor();
	Scanner in = new Scanner(System.in);
	
	public void run() {
		
		//synchronized(monitor) {
			
			int nUsuario = Integer.parseInt(in.nextLine());
			
			if(Numeros.getRInt() == nUsuario) {
				Numeros.setEsAcierto(true);
				System.out.println("¡ACERTASTE!");
				
			}
			
			//monitor.notify();
			
			
			
		//}
		
	}

}
