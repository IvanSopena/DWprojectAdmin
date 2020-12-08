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

            $sql = "Select emisor,SendDate,Message
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

        $sql="";

        $sql = "Update " . $GLOBALS['sq']->getTableOwner() . ".Administrators set Name = '".$Nombre."',Surname = '".$Apellidos."',Email = '".$Email."',";
        $sql = $sql. " foto = '".$Foto."',Birthday = '".$fecha."',Country = '".$pais."',Job = '".$plan."',City = '".$Apellidos."',Gener= '".$Apellidos."'";
        $sql = $sql. " where id = '". $id ."'";

        $GLOBALS['sq']->DB_Execute($sql);

    }
}