
public class Consumidor implements Runnable{

    @Override
    public void run() {

        while (true) {

            synchronized (Main.lista) {

                if (Main.lista.size() == 0) { //Si la lista no tiene datos el consumidor se duerme

                    try {
                        Main.lista.wait();
                    } catch (InterruptedException e) {
                        e.printStackTrace();
                    }

                }

            }

            System.out.println(Main.lista.getFirst()); //Imprimmos el numero

            synchronized (Main.lista) {

                Main.lista.removeFirst(); //Borramos el elementos y notificamos al productor para que genere otro
                Main.lista.notify();


            }

        }

    }
}