package Entidades;

public class TestWallet {
	
	public void test1() {
		
		//Instancia de Wallet con contrase�a por defecto y un set al balance de 1000.0
		Wallet carteraLeo = new Wallet();
		carteraLeo.setBalance(1000.0);
		
		//Instancia de Wallet con contrase�a por defecto y un set al balance de 1000.0
		Wallet carteraFernando = new Wallet();
		carteraFernando.setBalance(1000.0);
		
		//Instancia de Wallet con contrase�a y balance por defecto
		Wallet carteraMiguel = new Wallet();
		
		//Contrase�a que establecemos por defecto
		final String PASSWORD_GENERICA = "Nervion";
		
		//Objeto generico que usaremos como monitor en bloques synchronized
		Object monitor = new Object();
		
		//Tranferira el dinero de carteraLeo a carteraMiguel, de uno en uno
		Thread h1 = new Thread(() -> {
							
				for(int i = 0; i < 1000; i++) {
					
					synchronized(monitor) {
						
						carteraLeo.transferTo(carteraMiguel, PASSWORD_GENERICA, 1);
						System.out.println("Leo -> Miguel");
						
					}
					
				}
			
		});
		
		//Transferira el dinero de carteraFernando a carteraMiguel igual que el anterior hilo
		Thread h2 = new Thread(() -> {
			
				for(int i = 0; i < 1000; i++) {
					
					synchronized(monitor) {
						
						carteraFernando.transferTo(carteraMiguel, PASSWORD_GENERICA, 1);
						System.out.println("Fernando -> Miguel");
						
					}
					
				}
				
		});
		
		h1.start();
		h2.start();
		
	}
	
	public void test2() {
			
		//Wallet instanciado con contrase�a por defecto y un set al balance de 1000000.0
		Wallet carteraFran = new Wallet();
		carteraFran.setBalance(1000000.0);
		
		//Wallet instanciado con constrase�a y parametros por defecto
		Wallet carteraElonMusk = new Wallet();
		
		//Contrase�a que establecemos por defecto
		final String PASSWORD_GENERICA = "Nervion";
		
		//Contrase�a que establecemos por defecto
		final String PASSWORD_INCORRECTA = "Sevilla";
		
		//Objeto generico que usaremos como monitor en bloques synchronized
		Object monitor = new Object();

		//Transferira el dinero desde mi cartera a la de Elon Musk de uno en uno
		Thread h1 = new Thread(() -> {
			
			boolean estado;
			
			while(carteraFran.getBalance() != 0) {
				
				synchronized(monitor) {
					
					estado = carteraFran.transferTo(carteraElonMusk, PASSWORD_GENERICA, 1);
					System.out.println("Transferencia Correcta");
					
				}
				
				//Coloco Thread.Sleep fuera del bloque synchronized para no bloquear a h2
				if(!estado) {
					try {
						Thread.sleep(carteraFran.getMillis());
						carteraFran.incrementMillis();
					} catch (InterruptedException e) {
						e.printStackTrace();
					}
				}
				
			}
			
		});
		
		//Transferira el dinero desde mi cartera a la de Elon Musk de uno en uno, pero esta vez con una contrase�a incorrecta
		Thread h2 = new Thread(() -> {
			
			boolean estado;
			
			while(carteraFran.getBalance() != 0) {
				
				synchronized(monitor) {
					
					estado = carteraFran.transferTo(carteraElonMusk, PASSWORD_INCORRECTA, 1);
					System.out.println("Transferencia Incorrecta");
					
				}
				
				
				//Coloco Thread.Sleep fuera del bloque synchronized para no bloquear a h1
				if(!estado) {
					try {
						Thread.sleep(carteraFran.getMillis());
						carteraFran.incrementMillis();
					} catch (InterruptedException e) {
						e.printStackTrace();
					}
				}
				
			}
			
		});
		
		h1.start();
		h2.start();
		
	}
	
	public void test3() {
		
		//Wallet instanciado con contrase�a por defecto y un set al balance de 1000.0
		Wallet c1 = new Wallet();
		c1.setBalance(1000);
		
		//Wallet instanciado con contrase�a por defecto y un set al balance de 1000.0
		Wallet c2 = new Wallet();
		c2.setBalance(1000);
		
		//Wallet instanciado con contrase�a y balance por defecto
		Wallet c3 = new Wallet();
		
		//Wallet instanciado con contrase�a y balance por defecto
		Wallet c4 = new Wallet();
		
		//Contrase�a que establecemos por defecto
		final String PASSWORD_GENERICA = "Nervion";
		
		//Objeto generico que usaremos como monitor en bloques synchronized
		Object monitor = new Object();
		
		//Transferira dinero de c1 a c3 de uno en uno
		Thread h1 = new Thread(() -> {
			
			boolean estado;
			
			for(int i = 0; i < 1000; i++) {
				
				synchronized(monitor) {
					
					estado = c1.transferTo(c3, PASSWORD_GENERICA, 1);
					monitor.notify();
					System.out.println("c1 -> c3");
					
				}
				
				if(!estado) {
					try {
						Thread.sleep(c1.getMillis());
						c1.incrementMillis();
					} catch (InterruptedException e) {
						e.printStackTrace();
					}
				}
				
			}
			
		});
		
		//Transferira dinero de c3 a c4 de uno en uno, mientras c3 no tenga saldo, h2 deberia estar dormido
		Thread h2 = new Thread(() -> {
			
			boolean estado;
			
			for(int i = 0; i < 1000; i++) {
				
				synchronized(monitor) {
					
					if(c3.getBalance() == 0) {
						try {
							monitor.wait();
						} catch (InterruptedException e) {
							e.printStackTrace();
						}
					}
					
					estado = c3.transferTo(c4, PASSWORD_GENERICA, 1);
					System.out.println("c3 -> c4");
					
				}
				
				if(!estado) {
					
					try {
						Thread.sleep(c3.getMillis());
						c3.incrementMillis();
					} catch (InterruptedException e) {
						e.printStackTrace();
					}
					
				}
				
			}
			
		});

		//Transferira dinero de c2 a c4 de uno en uno, al igual que h1
		Thread h3 = new Thread(() -> {
			
			boolean estado;
			
			for(int i = 0; i < 1000; i++) {
				
				synchronized(monitor) {
					
					estado = c2.transferTo(c4, PASSWORD_GENERICA, 1);
					System.out.println("c2 -> c4");
					
				}
				
				if(!estado) {
					
					try {
						Thread.sleep(c2.getMillis());
						c2.incrementMillis();
					} catch (InterruptedException e) {
						e.printStackTrace();
					}
					
				}
				
			}
			
		});
		
		//Este cuarto hilo solo se ejecutara cuando h1, h2, h3 hayan finalizado y mostrara por consola los saldos de las diferentes Wallets
		Thread h4 = new Thread(() -> {
			
			try {
				h1.join();
				h2.join();
				h3.join();
			}catch(InterruptedException e) {
				e.printStackTrace();
			}
			
			System.out.println("C1 -> " + c1.getBalance() + " NervionCoins");
			System.out.println("C2 -> " + c2.getBalance() + " NervionCoins");
			System.out.println("C3 -> " + c3.getBalance() + " NervionCoins");
			System.out.println("C4 -> " + c4.getBalance() + " NervionCoins");
			
		});
		
		h1.start();
		h2.start();
		h3.start();
		h4.start();
		
	}

}