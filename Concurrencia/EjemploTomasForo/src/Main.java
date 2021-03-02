import java.util.LinkedList;

public class Main {

    static LinkedList<Integer> lista = new LinkedList<Integer>();

    public static void main(String[] args) {


        Thread productor = new Thread(new Productor());
        Thread consumidor = new Thread(new Consumidor());

        productor.start();
        consumidor.start();


    }

}