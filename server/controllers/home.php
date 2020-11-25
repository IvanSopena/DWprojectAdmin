
<?php

class Home extends Controlador
{


	public function __construct()
	{
	}

	public function index()
	{
		session_start();
		if (isset($_SESSION["user"])) 
		{
			$GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]);
			$this->vista('dashboard', '');
		}
		else{
			$this->vista('login', '');
		}

		$GLOBALS['sq']->DbClose();	
	}
	
	public function login()
	{
		$model = $this->modelo('LoginModel');
		$user = $_POST["mail_user"];
		$pass = $_POST["pass"];

		$model->login($user, $pass) === false;
		
		$this->vista($model->getView(), '');
		
		$GLOBALS['sq']->DbClose();	
	}
}