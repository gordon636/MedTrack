<?php 

class GoogleAuth{

	protected $client;
	private $db;

	public function __construct($db = null, Google_Client $googleClient = null){
		$this->client = $googleClient;
		$this->db = $db;
		if ($this->client){
			$this->client->setClientId('226299871961-3nral0tmpsdjoeh11t0msv95n06etpq6.apps.googleusercontent.com');
			$this->client->setClientSecret('hVZzzFgnEU6SLHZ5JkESFh2O');
			$this->client->setRedirectUri('http://localhost/index.php');
			$this->client->setScopes('email');
		}
	}

	public function isLoggedIn(){
		return isset($_SESSION['access_token']);
	}

	public function getAuthUrl(){
		return $this->client->createAuthUrl();
	}

	public function checkRedirectCode($plus){
		if(isset($_GET['code'])){
			$this->client->authenticate($_GET['code']);
			$this->setToken($this->client->getAccessToken());
			$me = $plus->people->get('me');
			$id = $me['id'];
			$name = $me['displayName'];
			$email = $me['emails'][0]['value'];
			return True;
		}
		return False;
	}

	public function setToken($token){
		$_SESSION['access_token'] = $token;
		$this->client->setAccessToken($token);
	}

	public function logout(){
		unset($_SESSION['access_token']);
	}
}