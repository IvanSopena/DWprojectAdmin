<?php

class MenuModel
{
    private $Error;
    private $Type;
    private $View;

    public function __construct()
    {
    }

    public function obtener_id($campo,$tabla){
        $sql = "";

        $sql = "Select max(".$campo.") +1 as id from " . $GLOBALS['sq']->getTableOwner() . ".".$tabla;
        $result = $GLOBALS['sq']->DB_Select($sql);

        if ($GLOBALS['sq']->fallo_query == false) {

            return $result;
        } 
    }

    public function rellena_estado($variable){
        $sql = "";
        $sql = "Select IdStatus,StatusDesc from " . $GLOBALS['sq']->getTableOwner() . ".StatusMovie";
        $result = $GLOBALS['sq']->DbSelect_tablas($sql);

        $devolver ="";
        if ($GLOBALS['sq']->fallo_query == false) {

            while ($dato = $result->fetch()){
                if($dato["StatusDesc"] === $variable){
                    //$devolver ="<option value =''>Elige un estado</option>";
                    $devolver = $devolver . "<option value ='".$dato["IdStatus"]."' selected='selected'>".$dato["StatusDesc"]."</option>";
                }else{
                    //$devolver ="<option select '' value =''>Elige un estado</option>";
                    $devolver = $devolver . "<option value ='".$dato["IdStatus"]."'>".$dato["StatusDesc"]."</option>";
                }
            }
            return $devolver;
        } 
    }

    public function rellena_cat($variable){
        $sql = "";
        $sql = "Select IdCat,CatDesc from " . $GLOBALS['sq']->getTableOwner() . ".CategoryMovie";
        $result = $GLOBALS['sq']->DbSelect_tablas($sql);

        $devolver ="";
        if ($GLOBALS['sq']->fallo_query == false) {

            while ($dato = $result->fetch()){
                if($dato["CatDesc"] === $variable){
                    //$devolver ="<option value =''>Elige un estado</option>";
                    $devolver = $devolver . "<option value ='".$dato["IdCat"]."' selected='selected'>".$dato["CatDesc"]."</option>";
                }else{
                    //$devolver ="<option select '' value =''>Elige un estado</option>";
                    $devolver = $devolver . "<option value ='".$dato["IdCat"]."'>".$dato["CatDesc"]."</option>";
                }
            }
            return $devolver;
        } 
    }

    public function rellena_user(){
        $sql = "";
        $sql = "Select al1.Id,CONCAT(al1.Nombre,' ', al1.Apellidos) as Usuario,al1.Email,al1.Pais,al1.Nacimiento,al2.DescPlan as Plan,al1.Activo,al1.Foto
        from " . $GLOBALS['sq']->getTableOwner() . ".Users as al1 , " . $GLOBALS['sq']->getTableOwner() . ".MoviesPlan as al2 
        where plan = IdPlan"; 
        $result = $GLOBALS['sq']->DbSelect_tablas($sql);
        $devolver ="";
        if ($GLOBALS['sq']->fallo_query == false) {

            while ($dato = $result->fetch()){
               
                $devolver = $devolver . "<option value ='".$dato["Id"]."' >".$dato["Usuario"]."</option>";

            }
            return $devolver;
        } 
    }

    public function rellena_peli(){
        $sql = "";
        $sql = "Select al1.IdMovie,al1.Name,al1.Cover,
            al4.StatusDesc,al2.CatDesc,al1.Duration,al1.Age,al1.Active 
            from " . $GLOBALS['sq']->getTableOwner() . ".CategoryMovie as al2,
            " . $GLOBALS['sq']->getTableOwner() . ".Movies as al1,
            " . $GLOBALS['sq']->getTableOwner() . ".StatusMovie as al4

            where
            al1.cat = al2.IdCat  and
            al1.Status = al4.IdStatus";    
            $result = $GLOBALS['sq']->DbSelect_tablas($sql);
        $devolver ="";
        if ($GLOBALS['sq']->fallo_query == false) {

            while ($dato = $result->fetch()){
               
                $devolver = $devolver . "<option value ='".$dato["Cover"]."'>".$dato["Name"]."</option>";

            }
            return $devolver;
        } 
    }



    public function send_user_notify($Nombre,$Peli,$menssage,$emisor)
    {
        $sql = "";
        
        $Id = $this->obtener_id('IdNotify','Notifications');
      
        $sql = "Insert into " . $GLOBALS['sq']->getTableOwner() . ".Notifications (IdNotify,IdOwner,IdUser,Message,Read_Message,Cover) ";
        $sql = $sql. "Values('". $Id['id'] ."','". $emisor ."','". $Nombre ."','". $menssage ."','0','". $Peli ."')";

        $GLOBALS['sq']->DB_Execute($sql);

        if ($GLOBALS['sq']->fallo_query == true) {

            $GLOBALS['error']= "Fallo al generar el nuevo aviso para el usuario. ";
            $GLOBALS['type']="error";
            return;
        } else{
            $GLOBALS['error']= "Aviso generado correctamente. ";
            $GLOBALS['type']="success";
            return;
        }
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

    public function Obtener_Categorias()
    {
        try{

            $sql = ""; 
            if ($GLOBALS['sq']->getIsOpen() === false) {
                $GLOBALS['sq']->connect_DB();
            }

            $sql = "Select al1.IdCat,al1.CatDesc,al1.Icon,al1.Color,
            ROUND(count(al3.IdMovie)) as Total
            from " . $GLOBALS['sq']->getTableOwner() . ".CategoryMovie as al1
            Left Join " . $GLOBALS['sq']->getTableOwner() . ".Movies as al3 ON al1.IdCat = al3.cat
            Group by al1.IdCat";  
    
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

    public function new_category($Id,$nombre,$Ico,$color){

        $sql = "";

      
            $sql = "Insert into " . $GLOBALS['sq']->getTableOwner() . ".CategoryMovie (IdCat,CatDesc,Icon,Color) ";
            $sql = $sql. "Values('". $Id ."','". $nombre ."','". $Ico ."','". $color ."')";

            $GLOBALS['sq']->DB_Execute($sql);

            if ($GLOBALS['sq']->fallo_query == true) {

                $GLOBALS['error']= "Fallo al generar el nuevo usuario de la aplicación. ";
                $GLOBALS['type']="error";
                return;
            } 
            
    }

    public function category_data($id)
    {
        try{
 
            $sql = ""; 
            if ($GLOBALS['sq']->getIsOpen() === false) {
                $GLOBALS['sq']->connect_DB();
            }

            $sql = "Select al1.IdCat,al1.CatDesc,al1.Icon,al1.Color
            from " . $GLOBALS['sq']->getTableOwner() . ".CategoryMovie as al1  
            where  al1.IdCat = '".$id."'"; 
    
            $result = $GLOBALS['sq']->Db_Select($sql);
    
            if ($GLOBALS['sq']->fallo_query == false) {
    
                return $result;      
            }
            else{
                $GLOBALS['error']= "Error en la carga de la información de la categoria seleccionada";
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

    public function Category_update($nombre,$Ico,$color,$id)
    {
        try{
            $sql="";

            $sql = "Update " . $GLOBALS['sq']->getTableOwner() . ".CategoryMovie set CatDesc = '".$nombre."',Icon = '".$Ico."',";
            $sql = $sql. " Color = '".$color."'";
            $sql = $sql. " where IdCat = '". $id ."'";
    
            $GLOBALS['sq']->DB_Execute($sql);
    
            if ($GLOBALS['sq']->fallo_query == true) {
    
                $GLOBALS['error']= "Error en la actualización, por favor vuelva a intentarlo ";
                $GLOBALS['type']="warning";
                
                return;
            } 
            else{
                $GLOBALS['error']= "La actualización se ha realizado con exito.";
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

    public function del_cat($id)
    {
        try{
            $sql="";

            $sql = "Delete from " . $GLOBALS['sq']->getTableOwner() . ".CategoryMovie ";
            $sql = $sql. " where IdCat = '". $id ."'";
    
            $GLOBALS['sq']->DB_Execute($sql);
    
            if ($GLOBALS['sq']->fallo_query == true) {
    
                $GLOBALS['error']= "Error al intentar eliminar el elemento seleccionado";
                $GLOBALS['type']="warning";
                
                return;
            } 
            else{
                $GLOBALS['error']= "Elemento eliminado con exito.";
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

    /********************************** Menu de Estados ********************************/
    public function Obtener_Estados()
    {
        try{

            $sql = ""; 
            if ($GLOBALS['sq']->getIsOpen() === false) {
                $GLOBALS['sq']->connect_DB();
            }

            $sql = "Select al1.IdStatus,al1.StatusDesc,
            ROUND(count(al3.IdMovie)) as Total
            from " . $GLOBALS['sq']->getTableOwner() . ".StatusMovie as al1
            Left Join " . $GLOBALS['sq']->getTableOwner() . ".Movies as al3 ON al1.IdStatus = al3.status
            Group by al1.IdStatus";  
    
            $result = $GLOBALS['sq']->DbSelect_tablas($sql);
    
            if ($GLOBALS['sq']->fallo_query == false) {
    
                return $result;      
            }
            else{
                $GLOBALS['error']= "Error en la cargar la información.";
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

    public function status_data($id)
    {
        try{

            $sql = ""; 
            if ($GLOBALS['sq']->getIsOpen() === false) {
                $GLOBALS['sq']->connect_DB();
            }

            $sql = "Select al1.IdStatus,al1.StatusDesc
            from " . $GLOBALS['sq']->getTableOwner() . ".StatusMovie as al1  
            where  al1.IdStatus = '".$id."'"; 
    
            $result = $GLOBALS['sq']->Db_Select($sql);
    
            if ($GLOBALS['sq']->fallo_query == false) {
    
                return $result;      
            }
            else{
                $GLOBALS['error']= "Error en la carga de la información del estado seleccionada";
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

    public function del_status($id)
    {
        try{
            $sql="";

            $sql = "Delete from " . $GLOBALS['sq']->getTableOwner() . ".StatusMovie ";
            $sql = $sql. " where IdStatus = '". $id ."'";
    
            $GLOBALS['sq']->DB_Execute($sql);
    
            if ($GLOBALS['sq']->fallo_query == true) {
    
                $GLOBALS['error']= "Error al intentar eliminar el elemento seleccionado";
                $GLOBALS['type']="warning";
                
                return;
            } 
            else{
                $GLOBALS['error']= "Elemento eliminado con exito.";
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

    public function status_update($nombre,$id)
    {
        try{
            $sql="";

            $sql = "Update " . $GLOBALS['sq']->getTableOwner() . ".StatusMovie set StatusDesc = '".$nombre."'";
            $sql = $sql. " where IdStatus = '". $id ."'";
    
            $GLOBALS['sq']->DB_Execute($sql);
    
            if ($GLOBALS['sq']->fallo_query == true) {
    
                $GLOBALS['error']= "Error en la actualización, por favor vuelva a intentarlo ";
                $GLOBALS['type']="warning";
                
                return;
            } 
            else{
                $GLOBALS['error']= "La actualización se ha realizado con exito.";
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
    public function new_status($Id,$nombre){

        $sql = "";

            $sql = "Insert into " . $GLOBALS['sq']->getTableOwner() . ".StatusMovie (IdStatus,StatusDesc) ";
            $sql = $sql. "Values('". $Id ."','". $nombre ."')";

            $GLOBALS['sq']->DB_Execute($sql);

            if ($GLOBALS['sq']->fallo_query == true) {

                $GLOBALS['error']= "Fallo al generar el nuevo registro. ";
                $GLOBALS['type']="error";
                return;
            } 
    }
}