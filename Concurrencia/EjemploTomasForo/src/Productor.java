public class Productor implements Runnable {

    private static int indiceActual = 8053;

    @Override
    public void run() {

        while(true) {

        synchronized (Main.lista) { //Sincronizamos sobre la lista que lo comparten los dos hilos

            if (Main.lista.size() >= 10) { //Si hay 10 elementos en la lista se duerme el productor
                try {
                    Main.lista.wait(); //Dormimos el hilo
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }

            }

        }
           synchronized (Main.lista) {

                Main.lista.add(generarPrimo()); //Añadimos primo a la lista
                Main.lista.notify();

           }
        }

    }

    private int generarPrimo() {

        while(!esPrimo(indiceActual)) { //Si no es primo se va incrementando hasta encontrar uno
            indiceActual++;
        }

        int aux = indiceActual; //Si pasamos el indiceActual directamente cuando queramos generar otro nunca
        indiceActual++;         //Entraria en el bucle de arriba y siempre devolveria el mismo primo
        return aux;

    }


    private boolean esPrimo(int indice) {

        boolean esPrimo = true; //Asumimos que es primo

        for (int i = 2; i < indice / 2 && esPrimo; i++) { //Solamente necesitamos divir desde el 2 hasta la mitad del numero que se comprueba que es primo

            if (indice % i == 0) {
                esPrimo = false;
            }

        }
        return esPrimo;
    }
}