<?php

class UserModel
{
    private $Error;
    private $Type;
    private $View;

    public function __construct()
    {
    }

    function getView()
    {
        return $this->View;
    }

    function setView($view)
    {
        $this->View = $view;
    }

    public function search_messages($Id)
    {
        try{

            $sql = ""; 
            if ($GLOBALS['sq']->getIsOpen() === false) {
                $GLOBALS['sq']->connect_DB();
            }

            $sql = "Select id,emisor,SendDate,Message
            from " . $GLOBALS['sq']->getTableOwner() . ".AdminMessages
            where
            Receptor = '".$Id ."' and IsRead = '0'"; 
    
            $result = $GLOBALS['sq']->DbSelect_tablas($sql);
    
            if ($GLOBALS['sq']->fallo_query == false) {
    
                return $result;      
            }
            else{
                $GLOBALS['error']= $GLOBALS['sq']->getClsLastError();
                $GLOBALS['type']="warning";
                $result = "";
                return $result;
            }


        }
        catch(Exception $ex)
        {
            $GLOBALS['error']= $GLOBALS['sq']->getClsLastError();
            $GLOBALS['type']="warning";
            $result = "";
            return $result;
        }
    }

    public function userdata()
    {
        try{

            $sql = ""; 
            if ($GLOBALS['sq']->getIsOpen() === false) {
                $GLOBALS['sq']->connect_DB();
            }

            $sql = "Select name,surname,email,pass,birthday,photo,address,city,gener,country,job
            from " . $GLOBALS['sq']->getTableOwner() . ".Administrators
            where
            Id = '". $_SESSION["user"] ."'"; 
    
            $result = $GLOBALS['sq']->DB_Select($sql);
    
            if ($GLOBALS['sq']->fallo_query == false) {
    
                return $result;      
            }
            else{
                $GLOBALS['error']= $GLOBALS['sq']->getClsLastError();
                $GLOBALS['type']="warning";
                $result = "";
                return $result;
            }


        }
        catch(Exception $ex)
        {
            $GLOBALS['error']= $GLOBALS['sq']->getClsLastError();
            $GLOBALS['type']="warning";
            $result = "";
            return $result;
        }
    }
 
    public function actualizar($Nombre,$Apellidos,$email,$ciudad,$date,$puesto,$pais,$direccion,$genero,$foto){

        try{
            $sql="";

            $sql = "Update " . $GLOBALS['sq']->getTableOwner() . ".Administrators set Name = '".$Nombre."',Surname = '".$Apellidos."',Email = '".$email."',";
            $sql = $sql. " photo = '".$foto."',Birthday = '".$date."',Country = '".$pais."',Job = '".$puesto."',City = '".$ciudad."',Gener= '".$genero."'";
            $sql = $sql. " ,Address= '".$direccion."' where id = '". $_SESSION["user"] ."'";
    
            $GLOBALS['sq']->DB_Execute($sql);
    
            if ($GLOBALS['sq']->fallo_query == true) {
    
                $GLOBALS['error']="Error al actualizar tu perfil. " /* $GLOBALS['sq']->getClsLastError() */; 
                $GLOBALS['type']="error";
                
            } 
            else{
                $GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]);
                $GLOBALS['error']="Tu perfil se ha modificado correctamente."; 
                $GLOBALS['type']="success";  
            }
        }catch(Exception $ex){
            $GLOBALS['error']= $ex->getMessage();
            $GLOBALS['type']="error";
        }

       
    }

    public function actualizar_password($password){
        try{
            $sql="";

            $sql = "Update " . $GLOBALS['sq']->getTableOwner() . ".Administrators set Pass = '".$password."' ";
            $sql = $sql. " where id = '". $_SESSION["user"] ."'";
    
            $GLOBALS['sq']->DB_Execute($sql);
    
            if ($GLOBALS['sq']->fallo_query == true) {
    
                $GLOBALS['error']="Error al actualizar tu contraseña. " /* $GLOBALS['sq']->getClsLastError() */; 
                $GLOBALS['type']="error";
                
            } 
            else{
                $GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]);
                $GLOBALS['error']="Tu contraseña se ha actualizado correctamente."; 
                $GLOBALS['type']="success";  
            }
        }catch(Exception $ex){
            $GLOBALS['error']= $ex->getMessage();
            $GLOBALS['type']="error";
        } 
    }

    public function show_notifications($id){
        try{

            $sql = ""; 
            if ($GLOBALS['sq']->getIsOpen() === false) {
                $GLOBALS['sq']->connect_DB();
            }

            $sql = "Select id,emisor,SendDate,Message
            from " . $GLOBALS['sq']->getTableOwner() . ".AdminMessages
            where
            id = '".$id ."'"; 
    
            $result = $GLOBALS['sq']->Db_Select($sql);
    
            if ($GLOBALS['sq']->fallo_query == false) {
    
                return $result;      
            }
            else{
                $GLOBALS['error']= "Imposible abrir las notificaciones.";
                $GLOBALS['type']="warning";
                $result = "";
                return $result;
            }


        }
        catch(Exception $ex)
        {
            $GLOBALS['error']= $GLOBALS['sq']->getClsLastError();
            $GLOBALS['type']="warning";
            $result = "";
            return $result;
        }
    }

    public function read_notifications($id)
    {
        try{
            $sql="";

            $sql = "Update " . $GLOBALS['sq']->getTableOwner() . ".AdminMessages set IsRead = '1'";
            $sql = $sql. " where Id = '". $id ."'";
    
            $GLOBALS['sq']->DB_Execute($sql);
    
            if ($GLOBALS['sq']->fallo_query == true) {
    
                $GLOBALS['error']= "Error en la actualización, por favor vuelva a intentarlo ";
                $GLOBALS['type']="warning";
                
                return;
            } 
           
        }
        catch(Exception $ex)
        {
            $GLOBALS['error']= $ex->getmessage();
            $GLOBALS['type']="warning";
            return;
        }
    }

   
       
}