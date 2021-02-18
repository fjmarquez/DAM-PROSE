import java.util.Random;

public class Runnable extends Thread{
	
	public void run() {
		
		Random r = new Random();
		
		for(int i = 0; i < 10; i++) {
			
			int ri = r.nextInt(5) + 1;
			System.out.println(ri);
			
		}
		
	}

}
