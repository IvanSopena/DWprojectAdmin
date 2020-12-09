<?php

class ProfileController extends Controlador
{


	public function __construct()
	{
    }
    
    public function profile()
    {
		$model = $this->modelo('UserModel');
        session_start();
        $GLOBALS['sq']-> refrescar_credenciales($_SESSION["user"]);
		$data = $model->userdata();
        $this->vista('profile', $data);
    }

    public function save(){
        $model = $this->modelo('UserModel');
        session_start();

        $Nombre = $_POST["name"];
        $Apellidos = $_POST["surname"];
        $email = $_POST["email"];
        $ciudad = $_POST["city"];
        $date = $_POST["date"];
        $puesto = $_POST["job"];
        $pais = $_POST["country"];
        $direccion = $_POST["address"];
        $genero = $_POST["customRadio1"];
        $foto = $_POST["thefile"];
        
        if($foto===""){
            $foto=$_COOKIE["Foto"];
        }

        $model->actualizar($Nombre,$Apellidos,$email,$ciudad,$date,$puesto,$pais,$direccion,$genero,$foto);
        $GLOBALS['sq']-> refrescar_credenciales($_SESSION["user"]);
        $data = $model->userdata();
        $this->vista('profile', $data);

    }

    public function save_password()
    {
        $model = $this->modelo('UserModel');
        session_start();
        $password = $_POST["pass"];
        $GLOBALS['sq']-> refrescar_credenciales($_SESSION["user"]);
        $password = $GLOBALS['security']-> crypt($password,strtoupper($GLOBALS['sq']->getUserName()));  

        $model->actualizar_password($password);

        $data = $model->userdata();
        $this->vista('profile', $data);
    }
}