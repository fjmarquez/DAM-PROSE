package retrofitPokemon;

public interface ICallBack {
	
	void onPokemonGot(String name, double height);

    void onPokemonNotFound();

}
