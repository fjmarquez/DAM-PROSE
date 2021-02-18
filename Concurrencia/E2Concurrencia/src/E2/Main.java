package E2;

public class Main {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		
		Hola hola = new Hola();
		Adios adios = new Adios();
		Thread hiloHola = new Thread(hola);
		Thread hiloAdios = new Thread(adios);
		
		hiloHola.start();
		hiloAdios.start();
		
	}

}
