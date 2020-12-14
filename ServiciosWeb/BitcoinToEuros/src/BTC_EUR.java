import java.io.IOException;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.nio.charset.Charset;
import java.util.Properties;
import java.util.Scanner;

import org.apache.commons.io.IOUtils;
import org.json.JSONException;
import org.json.JSONObject;

import com.google.gson.Gson;

public class BTC_EUR {

	public static void main(String[] args) throws JSONException, IOException {
		Scanner scan = new Scanner( System.in );
		Gson gson = new Gson();
		
		try {
			URL url = new URL("https://api.binance.com/api/v3/ticker/price?symbol=BTCEUR");
			JSONObject json = new JSONObject(IOUtils.toString(url, Charset.forName("UTF-8")));
			double priceBTC = json.getDouble("price");
			
			System.out.println("Un BTC equivale a " + priceBTC + " €\n");
			
			System.out.println("¿Cuantos BTC quieres convertir a Euros?");
			
			double btc = scan.nextDouble();
			double result = btc*priceBTC;
			
			System.out.println("\n" + btc + " BTC equivalen a " + result +" €");
			
		} catch (MalformedURLException e) {
			
			e.printStackTrace();
		}

	}

}
