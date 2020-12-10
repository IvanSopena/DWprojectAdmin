<?php

class MenuModel
{
    private $Error;
    private $Type;
    private $View;

    public function __construct()
    {
    }

     /********************************** Menu de Usuarios ********************************/
    public function Obtener_Usuarios()
    {
        try{

            $sql = ""; 
            if ($GLOBALS['sq']->getIsOpen() === false) {
                $GLOBALS['sq']->connect_DB();
            }

            $sql = "Select al1.Id,CONCAT(al1.Nombre,' ', al1.Apellidos) as Usuario,al1.Email,al1.Pais,al1.Nacimiento,al2.DescPlan as Plan,al1.Activo,al1.Foto
            from " . $GLOBALS['sq']->getTableOwner() . ".Users as al1 , " . $GLOBALS['sq']->getTableOwner() . ".MoviesPlan as al2 
            where plan = IdPlan"; 
    
            $result = $GLOBALS['sq']->DbSelect_tablas($sql);
    
            if ($GLOBALS['sq']->fallo_query == false) {
    
                return $result;      
            }
            else{
                $GLOBALS['error']= "Error en la carga de los usuarios";
                $GLOBALS['type']="warning";
                $result = "";
                return $result;
            }


        }
        catch(Exception $ex)
        {
            $GLOBALS['error']= $ex->getmessage();
            $GLOBALS['type']="warning";
            $result = "";
            return $result;
        }
    }

    public function info_user($id)
    {
        try{

            $sql = ""; 
            if ($GLOBALS['sq']->getIsOpen() === false) {
                $GLOBALS['sq']->connect_DB();
            }

            $sql = "Select al1.Id,al1.Nombre, al1.Apellidos,al1.Email,al1.Pais,al1.Nacimiento,al1.Plan,al1.Activo,al1.Foto
            from " . $GLOBALS['sq']->getTableOwner() . ".Users as al1  
            where  al1.id = '".$id."'"; 
    
            $result = $GLOBALS['sq']->Db_Select($sql);
    
            if ($GLOBALS['sq']->fallo_query == false) {
    
                return $result;      
            }
            else{
                $GLOBALS['error']= "Error en la carga de los usuarios";
                $GLOBALS['type']="warning";
                $result = "";
                return $result;
            }


        }
        catch(Exception $ex)
        {
            $GLOBALS['error']= $ex->getmessage();
            $GLOBALS['type']="warning";
            $result = "";
            return $result;
        }
    }

    public function user_update($Nombre,$Apellidos,$email,$date,$plan,$pais,$activo,$id)
    {
        try{
            $sql="";

            $sql = "Update " . $GLOBALS['sq']->getTableOwner() . ".Users set Nombre = '".$Nombre."',Apellidos = '".$Apellidos."',Email = '".$email."',";
            $sql = $sql. " Nacimiento = '".$date."',Pais = '".$pais."',Plan = '".$plan."',activo = '".$activo."'";
            $sql = $sql. " where id = '". $id ."'";
    
            $GLOBALS['sq']->DB_Execute($sql);
    
            if ($GLOBALS['sq']->fallo_query == true) {
    
                $GLOBALS['error']= "Error en la actualizacion del usuario ".$Nombre." ".$Apellidos;
                $GLOBALS['type']="warning";
                
                return;
            } 
            else{
                $GLOBALS['error']= "Perfil actualizado con exito.";
                $GLOBALS['type']="success";
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

    public function del_user($id)
    {
        try{
            $sql="";

            $sql = "Update " . $GLOBALS['sq']->getTableOwner() . ".Users set activo = '2'";
            $sql = $sql. " where id = '". $id ."'";
    
            $GLOBALS['sq']->DB_Execute($sql);
    
            if ($GLOBALS['sq']->fallo_query == true) {
    
                $GLOBALS['error']= "Error al intentar eliminar el usuario seleccionado";
                $GLOBALS['type']="warning";
                
                return;
            } 
            else{
                $GLOBALS['error']= "Usuario eliminado con exito.";
                $GLOBALS['type']="success";
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

    /********************************** Menu de Categorias ********************************/
}