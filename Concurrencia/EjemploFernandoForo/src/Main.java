import java.util.ArrayList;
import java.util.LinkedList;
import java.util.Random;
import java.util.concurrent.Semaphore;

public class Main {

    public static void main(String[] args) throws InterruptedException {

        LinkedList<Integer> buffer = new LinkedList<>();

        //Definici�n de los sem�foros y las condiciones para las respectivas tareas

        boolean condicionProducir = true;
        boolean condicionConsumir = true;

        //Instanciamos los sem�foros, encargados de coordinar la producci�n y la consumici�n
        //Con 20 permisos (tama�o m�ximo del buffer)
        Semaphore producirSem = new Semaphore(20, true);
        Semaphore consumirSem = new Semaphore(0, true);

        Runnable producir = () -> {

            while(condicionProducir){

                //Adquirimos un permiso. Si no quedan, el hilo espera.
                //El consumidor debe consumir para que aumente el n�mero de permisos

                try {
                    producirSem.acquire();
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }

                synchronized(buffer){
                    buffer.add(aleatorio(0, 10));
                    System.out.println(buffer.toString());

                    //Delay a�adido para poder apreciarlo en la consola
                    //Ambas tareas podr�an tener delays distintos, que, gracias
                    //a los sem�foros, aunque alguna de las dos haya acabado antes,
                    //tendr� que esperar a que haya permisos para ejecutar su funci�n

                    try {
                        buffer.wait(1000);
                    } catch (InterruptedException e) {
                        e.printStackTrace();
                    }

                }

                //A�adimos un permiso al sem�foro de consumir
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

                    //Delay a�adido para apreciar el cambio en la consola
                    //Ambas tareas podr�an tener delays distintos, que, gracias
                    //a los sem�foros, aunque alguna de las dos haya acabado antes
                    //tendr� que esperar a que haya permisos para ejecutar su funci�n

                    try {
                        buffer.wait(500);
                    } catch (InterruptedException e) {
                        e.printStackTrace();
                    }
                }

                //A�adimos un permiso al sem�foro de producir
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

    //Genera un n�mero pseudoaleatorio entre un rango espec�ficado
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


        // Este c�digo se est� ejecutando en un hilo (el principal). Con el join,
        // hacemos que dicho hilo espere a que el hilo hilos.get(i) muera para continuar despu�s de �l.
        // Como que se "unen" los hilos al seguir el uno detr�s del otro.
        // El m�todo join() conserva el orden de los hilos que suceden a otro hilo seg�n el orden de llamada.
        // Por tanto, el siguiente hilo a unirse ser� hilos.get(i+1)

        //Dici�ndoles a todos join(), se esperan los unos a los otros como si fueran "un �nico hilo".

        for(int i = 0; i < hilos.size(); i++){
            hilos.get(i).join();
        }

    }

}

