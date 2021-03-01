package retrofitPokemon;

import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Path;

public interface pokemonInterface {
	
	@GET("/api/v2/pokemon/{name}")
	Call<pokemon> getPokemon(@Path("name") String name);

}
