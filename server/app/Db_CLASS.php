<?php

/*
 * @author Ivan Sopeña
 * 
 * Esta clase es la que va a contener la 
 * conexion con la base de datos asi como
 * las consultas y demas acciones que se realicen con ella.
 */



class Db_CLASS {

    //Definimos las variables que va a necesitar la clase.
    public $ClsLastError;
    public $IsOpen;
    public $DbLastSQL;
    private $Connect_DB;
    public $TableOwner;
    private $OpenTrans;
    public $resultado;
    public $fallo_query;
    public $mAppUserName = "";
    public $mRealUserName = "";
    public $mAppUserId = "";
    public $mAppUserPwd = "";
    public $mAppRol = 0;
    public $foto = "";
    public $errors = "";
 

    //Creamos el constructor de la clase
    public function __construct()
	{
	}

    ///-----------------------------------------------------Creamos los getters y Setters de las variables------------------------------------------


    function getClsLastError() {
        return $this->ClsLastError;
    }

    function getIsOpen() {
        return $this->IsOpen;
    }

    function getDbLastSQL() {
        return $this->DbLastSQL;
    }

    function getTableOwner() {
        return $this->TableOwner;
    }

    function getOpenTrans() {
        return $this->OpenTrans;
    }

    function setClsLastError($ClsLastError) {
        $this->ClsLastError = $ClsLastError;
    }

    function setIsOpen($IsOpen) {
        $this->IsOpen = $IsOpen;
    }

    function setDbLastSQL($DbLastSQL) {
        $this->DbLastSQL = $DbLastSQL;
    }

    function setTableOwner($TableOwner) {
        $this->TableOwner = $TableOwner;
    }

    function setOpenTrans($OpenTrans) {
        $this->OpenTrans = $OpenTrans;
    }

    function getUserName() {
        return $this->UserName;
    }

    function getMRealUserName() {
        return $this->mRealUserName;
    }

    function getMAppUserId() {
        return $this->mAppUserId;
    }

    function getMAppUserPwd() {
        return $this->mAppUserPwd;
    }

    function getMAppRol() {
        return $this->mAppRol;
    }

    function getErrors() {
        return $this->errors;
    }

    function setErrors($errores) {
        $this->errors = $errores;
    }

    function setMAppUserName($mAppUserName) {
        $this->mAppUserName = $mAppUserName;
    }

    function setMRealUserName($mRealUserName) {
        $this->mRealUserName = $mRealUserName;
    }

    function setMAppUserId($mAppUserId) {
        $this->mAppUserId = $mAppUserId;
    }

    function setMAppUserPwd($mAppUserPwd) {
        $this->mAppUserPwd = $mAppUserPwd;
    }

    function setMAppRol($mAppRol) {
        $this->mAppRol = $mAppRol;
    }
    
    function getfoto() {
        return $this->foto;
    }

    function setfoto($photo) {
        $this->foto = $photo;
    }
    
    


    ///-----------------------------------------------------Creamos los atributos que va a conetener nuestra clase------------------------------------------

    public function connect_DB() {

        try {

            $DB_pass = $GLOBALS['security']-> decrypt(DB_Password,DB_User);  

            $this->Connect_DB = new PDO('mysql:host=' . DB_Server . '; dbname=' . DB_Schema, DB_User, $DB_pass );

            $this->Connect_DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->setIsOpen(true);
            
            $this->setTableOwner(DB_Schema);
            
            return $this->Connect_DB;
            
        } catch (Exception $ex) {
            $this->ClsLastError = "Error al realizar la conexion: " . $ex->getMessage();
            $this->setIsOpen(false);
        }
    }

    public function DbClose() {

        $this->Connect_DB = null;

        return;
    }


    public function refrescar_credenciales($id)
    {
        $sentencia = "";

      
        $sentencia = "select  Name,Surname,Email,Pass, CONCAT(Name,' ', Surname) as Usuario , Id,Photo from " . $this->getTableOwner() . ".Administrators where id= '" . $id . "'";

        $result = $this->DB_Select($sentencia);

        if ($this->fallo_query == true) {

            $this->setClsLastError("Fallo al buscar el usuario de la aplicación." . $this->DbLastSQL);
            $this->setErrors(true);
            return;
        } else {


            $this->setMAppUserName($result['Email']);
            $this->setMAppUserPwd($result['Pass']);
            $this->setMRealUserName($result['Usuario']);
            $this->setMAppUserId($result['Id']);
            $this->setfoto($result['Photo']); 
        }
            
    }

    public function AppOpen($AppUser, $AppPassword) {
        /**
         * Funcion que se encarga de verificar si el usuario esta dado de alta en la base de datos
         * y si la contraseña que ha introducido es la correcta. 
         */
        $sentencia = "";

       

        $sentencia = "select  Name,Surname,Email,Pass, CONCAT(Name,' ', Surname) as Usuario , Id,Photo from " . $this->getTableOwner() . ".Administrators where upper (Email)= '" . strtoupper($AppUser) . "'";

        $result = $this->DB_Select($sentencia);

        if ($this->fallo_query == true) {

            $this->setClsLastError("Fallo al buscar el usuario de la aplicación." . $this->DbLastSQL);
            $this->setErrors(true);
            return;
        } else {


            $this->setMAppUserName($result['Email']);
            $this->setMAppUserPwd($result['Pass']);
            $this->setMRealUserName($result['Usuario']);
            $this->setMAppUserId($result['Id']);
            $this->setfoto($result['Photo']); 
            
            setcookie("Foto", $result['Photo'], 0, "/"); 
            setcookie("Id", $result['Id'], 0, "/");
            
            $AppPwd = $GLOBALS['security']->decrypt($result['Pass'], strtoupper($AppUser)); 
            
         	
            
            if ($this->getMAppUserPwd() == "") {
                $this->setClsLastError("El usuario introducido no esta dado de alta en el sistema.");
                $this->setErrors(true);
                return;
            }


            if ($AppPassword != $AppPwd) {
                $this->setClsLastError("Contraseña del usuario de la aplicación incorrecta.");
                $this->setErrors(true);
                return;
            } else {


                $this->setErrors(false);
                return;
            }
        }
    }

    public function DB_Execute($SQL) {

        try {

            $query = $this->Connect_DB->prepare($SQL);
            $query->execute();

            
            $this->fallo_query = false;
            return;
            
            
        } catch (Exception $ex) {
            $this->setClsLastError($ex);
            $this->setDbLastSQL($SQL);
            $this->fallo_query = true;
            return;
        }
    }

    public function DB_Select($SQL) {

        try {

            $query = $this->Connect_DB->prepare($SQL);

            $query->execute(); //

            $resultado_sentencia = $query->fetch(PDO::FETCH_ASSOC);

           
            $this->fallo_query = false;

            return $resultado_sentencia;
            
        } catch (Exception $ex) {
            $this->setClsLastError($ex);
            $this->setDbLastSQL($SQL);
            $this->fallo_query = true;
            return;
        }
    }
    
    public function DbSelect_tablas($SQL){
       try {
           
            $stmt = $this->Connect_DB->query($SQL);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
            $this->fallo_query = false;
            
            return $stmt;
           
       } catch (Exception $ex) {
            $this->setClsLastError($ex);
            $this->setDbLastSQL($SQL);
            $this->fallo_query = true;
            return;
        }
        
       
    }
    

}
