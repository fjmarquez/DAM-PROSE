package E4;

import java.util.Random;

public class SumaArray {
	
	//Esta funcion suma un array siguiendo el criterio especificado
	public static void sumaArray() {
		
		while(true) {
			
			int suma = 0;
			//Generamos un array aleatorio
			int[] numeros = generarArray();
			
			//int[] numeros = {1,1,4,4,3,2,5,5,2,1};
			//int[] numeros = {1,2,3,4,1};
			//int[] numeros = {2,2,3,2,3};
			
			//Iteramos el array segun su longitud
			for(int i = 0; i < numeros.length; i++) {
				
				//Volvemos a iterar el array segun su longitud
				for(int x = 0; x < numeros.length; x++) {
					
					int num1 = numeros[i];
					int num2 = numeros[x];
					
					//Si los indices son diferentes y los valores iguales pasara a sumarse el valor
					if(i != x && num1 == num2) {
						
						suma += numeros[i];
						
					}
					
				}
				
			}
			
			System.out.println("Resultado: " + suma);
			
		}
		
	}
	
	//Este metodo genera un array aleatorio de n posiciones (lo limito a 10 para no tener una excepcion de memoria)
	public static int[] generarArray() {
		
		Random r = new Random();
		int longitudArray = 1;
		
		//Obligo a que indice sea par, asi cuando mas adelante sume la mitad en un hilo y la otra mitad en otro no tendre problemas
		while(longitudArray % 2 != 0) {
			//Obtengo un indice entre 1 y 10
			longitudArray =  r.nextInt(10)+1;
		}
		
		//Instancio un array de enteros con la longitud obtenida anteriormente
		int[] numeros = new int[longitudArray];
		
		System.out.println("Valores del array:");
		
		//Itero el array y voy rellenandolo con numeros random del 1 al 5
		for (int i = 0; i < numeros.length; i++) {
			
			numeros[i] = r.nextInt(5)+1;
			
			//Muestro los valores por consola
			System.out.println(numeros[i]);
		
		}
		
		return numeros;
		
	}
	
}
