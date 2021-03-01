package retrofitPokemon;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class pokemonCallback implements Callback<pokemon>{
	
	private ICallBack callback;
	
	public pokemonCallback(ICallBack callback) {
		this.callback = callback;
	}

	@Override
	public void onFailure(Call<pokemon> arg0, Throwable arg1) {
		// TODO Auto-generated method stub
		System.out.println("Algo ha ido mal");
	}

	@Override
	public void onResponse(Call<pokemon> call, Response<pokemon> response) {
		// TODO Auto-generated method stub
		if(!response.isSuccessful()){
			callback.onPokemonNotFound();
        }else {
            pokemon pokemon = response.body();
            callback.onPokemonGot(pokemon.getName(), pokemon.getHeight());
        }
		
	}

}
