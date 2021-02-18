package E3;

import java.util.Scanner;

public class Lectura extends Thread{
	
	//Usamos el util Scanner para leer el numero introducido por el usuario
	Scanner in = new Scanner(System.in);
	
	public void run() {
			
		//Se ejecutara mientras el numero no sea acertado por el usuario
		while(!Numeros.getEsAcierto()) {
			
			//Obtemos y parseamos el valor introducido por el usuario
			int nUsuario = Integer.parseInt(in.nextLine());
			
			//Comprobamos si el numero introducido se corresponde con el numero que actualmente mostramos por consola
			if(Numeros.getRInt() == nUsuario) {
				
				//Damos valor true a la variable booleana esAcierto
				Numeros.setEsAcierto(true);
				
				//Informamos al usuario por consola que ha acertado el numero
				System.out.println("¡ACERTASTE!");
			
			}
		
		}
		
	}

}
