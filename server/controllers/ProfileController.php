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
        

        $model->actualizar($Nombre,$Apellidos,$email,$ciudad,$date,$puesto,$pais,$direccion,$genero,$foto);

        $data = $model->userdata();
        $this->vista('profile', $data);

    }
}