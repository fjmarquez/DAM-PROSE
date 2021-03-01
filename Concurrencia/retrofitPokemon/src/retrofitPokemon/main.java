package retrofitPokemon;

import java.util.Scanner;

import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class main implements ICallBack{
	
	private static final String SERVER_URL = "https://pokeapi.co";
    private Double alturaAlta = 0.0;
    private String pokemonMasAlto;
    private int cont = 0;
    private pokemonInterface pokemonInterface;
    private pokemonCallback pokemonCallBack;

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		
		new main().ejecutar();

	}
	
	public  void ejecutar(){

        Retrofit retrofit;
        pokemonCallBack = new pokemonCallback(this);

        retrofit = new Retrofit.Builder()
                .baseUrl(SERVER_URL)
                .addConverterFactory(GsonConverterFactory.create())
                .build();

        pokemonInterface = retrofit.create(pokemonInterface.class);
        pedirPokemon();
    }

	@Override
	public void onPokemonGot(String name, double height) {
		// TODO Auto-generated method stub
		cont++;
        System.out.println(name+" mide "+height/10+" metros");

        if(height > alturaAlta){
            alturaAlta = height;
            pokemonMasAlto = name;
        }
        //cont == 2 porque es el numero de pokemon que queremos comparar
        if(cont == 2){
            System.out.println("El pokemon mas alto es "+pokemonMasAlto+ " y mide "+alturaAlta/10+" metros");
        }else{
            pedirPokemon();
        }
		
	}

	@Override
	public void onPokemonNotFound() {
		// TODO Auto-generated method stub
		System.out.println("El nombre del Pokemon introducido no existe");
        pedirPokemon();
		
	}
	
	private void pedirPokemon(){

        Scanner sc = new Scanner(System.in);

        System.out.println("Introduzca el nombre del pokemon que desea comparar");
        String nombrePokemon = sc.next();
        pokemonInterface.getPokemon(nombrePokemon).enqueue(pokemonCallBack);
    }

}
