package Entidades;

public class Wallet {
	
	private double balance;
	private String password;
	private int millisWrongPassword;
	
	public Wallet() {
		this.balance = 0;
		this.password = "Nervion";
	}
	
	public Wallet(String password) {
		this.balance = 0;
		this.password = password;
	}
	
	public double getBalance() {
		return this.balance;
	}
	
	public void setBalance(double balance) {
		this.balance = balance;
	}
	
	public int getMillis() {
		return this.millisWrongPassword;
	}
	
	//Este metodo incrementa el valor de la variable millisWrongPassword al doble de su valor actual
	public void incrementMillis() {
		this.millisWrongPassword = this.millisWrongPassword * 2;
	}
	
	public boolean transferTo(Wallet walletDestino, String password, double number) {
		
		boolean response = false;
		
		if(number > 0) {
			if(this.password == password) {
				this.millisWrongPassword = 10;
				this.balance = this.balance - number;
				walletDestino.balance = walletDestino.balance + number;
				response = true;
			}
		}
		
		return response;
	}

}
