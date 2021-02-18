
public class E1Main {

	public static void main(String[] args) {
		
		Runnable runnable = new Runnable();
		
		Thread hiloNumeros = new Thread(runnable);
		
		//Inicio el hilo
		hiloNumeros.start();
		
	}

}
