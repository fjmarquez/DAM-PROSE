import java.util.Random;

public class Runnable extends Thread{
	
	public void run() {
		
		//Declaro un random para generar los numeros aleatorios 
		Random r = new Random();
		
		//Itero 10 veces
		for(int i = 0; i < 10; i++) {
			//Genero un numero entero aleatorio entre el 1 y el 5
			int ri = r.nextInt(5) + 1;
			
			//Muestro por consola el numero generado
			System.out.println(ri);
			
		}
		
	}

}
