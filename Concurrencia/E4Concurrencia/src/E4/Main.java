package E4;

public class Main {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		
		SumaArrayHilo1 sumaArrayHilo1 = new SumaArrayHilo1();
		SumaArrayHilo2 sumaArrayHilo2 = new SumaArrayHilo2();
		
		Thread hiloSuma1 = new Thread(sumaArrayHilo1);
		Thread hiloSuma2 = new Thread(sumaArrayHilo2);
		
		//SumaArray.sumaArray();
		// 12 y 12
		
		hiloSuma1.start();
		hiloSuma2.start();
		
		
		
	}

}
