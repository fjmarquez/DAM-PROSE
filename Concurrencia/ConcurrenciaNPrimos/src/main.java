import java.util.Arrays;
import java.util.LinkedList;

public class main {

	public static void main(String[] args) {
		//System.out.println("Hola Mundo");
		
		LinkedList<Integer> lista = new LinkedList<>();
		Object monitor = new Object();
		int primoInicial = 8053; 
		
		Thread productor = new Thread(() -> {
			
			int primo = primoInicial;
			
			while(true) {
			
			if(lista.size() >= 10) {
				
				synchronized (monitor){
					
					try {
						monitor.wait();
					} catch (InterruptedException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
					
				}
				
				
				
			}
			
			synchronized (monitor){
			
			lista.add(primo);
			monitor.notify();
			
			}
			
			primo = generarPrimo(primo);
			
			}
			
		});
		
		Thread consumidor = new Thread(() -> {
			
			while(true) {
			
				synchronized (monitor){
					
					if(lista.size() == 0) {
						
						try {
							monitor.wait();
						} catch (InterruptedException e) {
							// TODO Auto-generated catch block
							e.printStackTrace();
						}
						
					}
					
					System.out.println(lista.getFirst());
		            System.out.println(Arrays.asList(lista));
		            lista.removeFirst();
		            monitor.notify();
					
				}
			
			}
			
		});
		
		
		productor.start();
		consumidor.start();
		
		
	}
	
	public static int generarPrimo(int actual) {
		
		boolean flag;
		
		do {
			
			actual += 2;
			flag = esPrimo(actual);
			
		}while(!flag);
		
		return actual;
		
	}
	
	public static boolean esPrimo(int n) {
		
		boolean flag = false;
		
		if( n % 2 != 0) {
			
			flag = true;
			
		}
		
		return flag;
		
	}

}
