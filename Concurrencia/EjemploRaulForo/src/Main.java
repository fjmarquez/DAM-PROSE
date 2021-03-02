import java.util.LinkedList;

public class Main {
	private static final int NUM_EJE_MAX = 10000;
	private static final int PRIMO_INICIAL = 8053; 

	public static void main(String[] args) {

		LinkedList list = new LinkedList<>();
		Object monitor = new Object();

		Thread productor = new Thread(() -> {
			int primo=PRIMO_INICIAL;
			for(int i =0; i<=NUM_EJE_MAX;i++) {

				//Generar numero primo
				//synchronized (monitor) { //Si todo el bloque lo ponemos
				//dentro de un único bloque synchronized
				//hasta que no se haga todo, no se va a poder producir un
				//cambio de hilo. 

				//Los bloques synchronized son varios,
				//y deberían ser los siguientes:

				synchronized (monitor) { //Bloque 1:
					//Comprobar el tamaño del buffer y dormirse
					//deben ir juntos con un synchronized
					// porque  entre que se comprueba
					//y se duerme en la siguiente línea, 
					//el consumidor puede vaciar el buffer
					//y dormirse. En ese caso se quedarían los dos
					//hilos dormidos

					if (list.size() >= 10) { //TODO Cambiar el if por un while dentro de try
						//Es una buena practica, ya que en hilos puede ocurrir que otras clases despierten
						//el hilo, y por tanto, en ese caso, se debería volver a dormir si size>=10
						try {

							monitor.wait();

						} catch (InterruptedException e) {
							e.printStackTrace();
						}
					}
				}

				synchronized (monitor) {//Bloque 2:
					//Añadir en el buffer comun y despertar al consumidor
					//tambien debe hacerse de forma conjunta y
					//syncronizada. 
					//Ya que en caso contrario, podría ocurrir que
					//el consumidor comprobase que no hay elementos (if (list.size() == 0){
					//y antes de dormirse, el productor añadiese el elemento (list.add(primo)), 
					//lanzase el notify, sin efecto, ya que el consumidor aun no esta dormido
					//y a continuación se durmiese el consumidor (monitor.wait();) 
					//creyendo que no hay más elementos
					//cuando realmente hay un elemento insertado, esperando a ser consumido.
					list.add(primo);
					monitor.notify();
				}
				//La generación del producto, no produce problemas de sincronía
				primo=nextPrime(primo);
			}

		});

		Thread consumidor = new Thread(() -> {

			//synchronized (monitor){ ///Si todo el bloque lo ponemos
			//dentro de un único bloque synchronized
			//hasta que no se haga todo, no se va a poder producir un
			//cambio de hilo. 

			//Los bloques synchronized son varios,
			//y deberían ser los siguientes:
			for(int i =0; i<=NUM_EJE_MAX;i++) {
				synchronized(monitor) {//Bloque 3:
					//Comprobar el tamaño del buffer y dormirse
					//deben ir juntos con un synchronized
					// porque  entre que se comprueba
					//y se duerme en la siguiente línea, 
					//el productor puede llenar el buffer
					//y dormirse. En ese caso se quedarían los dos
					//hilos dormidos.
					if (list.size() == 0){//TODO Cambiar el if por un while dentro de try
						//Es una buena practica, ya que en hilos puede ocurrir que otras clases despierten
						//el hilo, y por tanto, en ese caso, se debería volver a dormir si size==0
						try {
							monitor.wait();
						} catch (InterruptedException e) {
							e.printStackTrace();
						}
					}
				}

				System.out.println(list.getFirst());
				//System.out.println(Arrays.asList(list)); 
				//La impresion completa de la array la he comentado porque no es necesaria
				//Pero en caso de utilizarse, tambien debería estar sincronizada.
				//ya que pasaría que, al intentar imprimilar, se estaría cambiando
				//simultaneamente, lo que puede lanzar la excepción java.util.ConcurrentModificationException

				synchronized (monitor) {//Bloque 4:
					//Borrar un elemento del buffer comun 
					//y despertar al productor
					//tambien debe hacerse de forma conjunta y
					//syncronizada. 
					//Ya que en caso contrario, podría ocurrir que
					//el productor comprobase que el buffer esta completo (if (list.size() >= 10) {
					//y antes de dormirse, el consumidor quitase un elemento (list.removeFirst();), 
					//lanzase el notify, sin efecto, ya que el productor aun no esta dormido
					//y a continuación se durmiese el productor (monitor.wait();) 
					//creyendo que el buffer está completo
					//cuando realmente hay espacio para un elemento, y por tanto se puede seguir produciendo.
					list.removeFirst();
					monitor.notify();
				}
			}

		});

		productor.start();
		consumidor.start();

	}

	private static int nextPrime(int prime) {
		boolean flag;
		do {
			prime=prime+2;//A partir del 3, todos los primos son impares
			flag=isPrime(prime);
		}
		while(!flag);
		return prime;
	}

	private static boolean isPrime(int number) {
		boolean flag = true;
		double sqrt=Math.sqrt(number);
		for (int i = 2; i <= sqrt && flag; i++) {
			if (number % i == 0)
				flag=false;

		}
		return flag;
	}
}