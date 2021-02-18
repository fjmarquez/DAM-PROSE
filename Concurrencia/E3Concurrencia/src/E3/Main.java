package E3;

public class Main {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		
		Numeros numeros = new Numeros();
		Thread hiloNumeros = new Thread(numeros);
		
		Lectura lectura = new Lectura();
		Thread hiloLectura = new Thread(lectura);
		
		hiloLectura.start();
		hiloNumeros.start();
		
		
		

	}

}
