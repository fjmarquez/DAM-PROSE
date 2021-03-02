import java.util.ArrayList;
import java.util.LinkedList;
import java.util.Random;
import java.util.concurrent.Semaphore;

public class Main {

    public static void main(String[] args) throws InterruptedException {

        LinkedList<Integer> buffer = new LinkedList<>();

        //Definición de los semáforos y las condiciones para las respectivas tareas

        boolean condicionProducir = true;
        boolean condicionConsumir = true;

        //Instanciamos los semáforos, encargados de coordinar la producción y la consumición
        //Con 20 permisos (tamaño máximo del buffer)
        Semaphore producirSem = new Semaphore(20, true);
        Semaphore consumirSem = new Semaphore(0, true);

        Runnable producir = () -> {

            while(condicionProducir){

                //Adquirimos un permiso. Si no quedan, el hilo espera.
                //El consumidor debe consumir para que aumente el número de permisos

                try {
                    producirSem.acquire();
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }

                synchronized(buffer){
                    buffer.add(aleatorio(0, 10));
                    System.out.println(buffer.toString());

                    //Delay añadido para poder apreciarlo en la consola
                    //Ambas tareas podrían tener delays distintos, que, gracias
                    //a los semáforos, aunque alguna de las dos haya acabado antes,
                    //tendrá que esperar a que haya permisos para ejecutar su función

                    try {
                        buffer.wait(1000);
                    } catch (InterruptedException e) {
                        e.printStackTrace();
                    }

                }

                //Añadimos un permiso al semáforo de consumir
                consumirSem.release();

            }

        };

        Runnable consumir = () -> {

            while(condicionConsumir){

                try {
                    consumirSem.acquire();
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }

                synchronized(buffer){
                    buffer.remove(0);
                    System.out.println(buffer.toString());

                    //Delay añadido para apreciar el cambio en la consola
                    //Ambas tareas podrían tener delays distintos, que, gracias
                    //a los semáforos, aunque alguna de las dos haya acabado antes
                    //tendrá que esperar a que haya permisos para ejecutar su función

                    try {
                        buffer.wait(500);
                    } catch (InterruptedException e) {
                        e.printStackTrace();
                    }
                }

                //Añadimos un permiso al semáforo de producir
                producirSem.release();

            }

        };

        //

        try {
            manejarHilos(producir, consumir);
        } catch(InterruptedException e){
            e.printStackTrace();
        }


    }

    //Genera un número pseudoaleatorio entre un rango específicado
    public static int aleatorio(int min, int max){
        Random r = new Random();
        return r.nextInt(max-min) + min;
    }


    //Corre paralelamente una cantidad variable de tareas
    public static void manejarHilos(Runnable... tareas) throws InterruptedException {

        ArrayList<Thread> hilos = new ArrayList<>();

        //Creamos un array de hilos
        for(int i = 0; i < tareas.length; i++){
            hilos.add(new Thread(tareas[i]));
        }

        //Comenzamos uno por uno todos los hilos
        for(int i = 0; i < hilos.size(); i++){
            hilos.get(i).start();
        }


        // Este código se está ejecutando en un hilo (el principal). Con el join,
        // hacemos que dicho hilo espere a que el hilo hilos.get(i) muera para continuar después de él.
        // Como que se "unen" los hilos al seguir el uno detrás del otro.
        // El método join() conserva el orden de los hilos que suceden a otro hilo según el orden de llamada.
        // Por tanto, el siguiente hilo a unirse será hilos.get(i+1)

        //Diciéndoles a todos join(), se esperan los unos a los otros como si fueran "un único hilo".

        for(int i = 0; i < hilos.size(); i++){
            hilos.get(i).join();
        }

    }

}

