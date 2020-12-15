<?php

class MoviesModel
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

    public function charge_category(){
        try{

            $sql = ""; 
            if ($GLOBALS['sq']->getIsOpen() === false) {
                $GLOBALS['sq']->connect_DB();
            }

            $sql = "Select al1.CatDesc,al1.Icon,al1.Color,
            CONCAT(ROUND(count(al2.IdMovie) * (select count(IdMovie) from Movies) /100, 2), '%') as porcentaje,
            ROUND(count(al2.IdMovie) * (select count(IdMovie) from Movies) /100, 2) as valores 
            from " . $GLOBALS['sq']->getTableOwner() . ".CategoryMovie as al1
            Left Join " . $GLOBALS['sq']->getTableOwner() . ".Movies as al3 ON al1.IdCat = al3.cat
            Left Join " . $GLOBALS['sq']->getTableOwner() . ".UserMovie as al2 ON al3.IdMovie = al2.IdMovie
            Group by al1.IdCat"; 
    
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

    public function charge_movie(){
        try{
            $sql = ""; 
            if ($GLOBALS['sq']->getIsOpen() === false) {
                $GLOBALS['sq']->connect_DB();
            }
            
            $sql = "Select al1.Name as titulo,al3.TypeDesc as tipo,al1.Cover as cover,
            al4.StatusDesc as status,al2.CatDesc as cat, al1.Duration as duracion  
            
            from " . $GLOBALS['sq']->getTableOwner() . ".CategoryMovie as al2,
            " . $GLOBALS['sq']->getTableOwner() . ".Movies as al1,
            " . $GLOBALS['sq']->getTableOwner() . ".UserMovie as al5,
            " . $GLOBALS['sq']->getTableOwner() . ".Type as al3,
            " . $GLOBALS['sq']->getTableOwner() . ".StatusMovie as al4

            where
            al1.IdMovie = al5.IdMovie and al1.cat = al2.IdCat and
            al1.Type = al3.Idtype and al1.Status = al4.IdStatus"; 
    
            $result = $GLOBALS['sq']->DbSelect_tablas($sql);
    
            if ($GLOBALS['sq']->fallo_query == false) {
    
                return $result;      
            }
            else{
                $GLOBALS['error']=getmessage();
                $GLOBALS['type']="warning";
                $result = "";
                return $result;
            }

        }
        catch(Exception $ex)
        {
            $GLOBALS['error']=getmessage();
            $GLOBALS['type']="warning";
            $result = "";
            return $result;
        }


    }

    public function Obtener_peliculas($type)
    {
        try{

            $sql = ""; 
            if ($GLOBALS['sq']->getIsOpen() === false) {
                $GLOBALS['sq']->connect_DB();
            }

            $sql = "Select al1.IdMovie,al1.Name,al1.Cover,
            al4.StatusDesc,al2.CatDesc,al1.Duration,al1.Age,al1.Active 
            from " . $GLOBALS['sq']->getTableOwner() . ".CategoryMovie as al2,
            " . $GLOBALS['sq']->getTableOwner() . ".Movies as al1,
            " . $GLOBALS['sq']->getTableOwner() . ".StatusMovie as al4

            where
            al1.cat = al2.IdCat and al1.type=".$type." and
            al1.Status = al4.IdStatus";   
    
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

    public function delete_movie($id){
        try{
            $sql="";

            $sql = "Update " . $GLOBALS['sq']->getTableOwner() . ".Movies set Active = '2'";
            $sql = $sql. " where IdMovie = '". $id ."'";
    
            $GLOBALS['sq']->DB_Execute($sql);
    
            if ($GLOBALS['sq']->fallo_query == true) {
    
                $GLOBALS['error']= "Error al desactivar el registro, por favor vuelva a intentarlo. ";
                $GLOBALS['type']="warning";
                
                return;
            } 
            else{
                $GLOBALS['error']= "El registro se ha desactivado correctamente.";
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

    public function data_movie($id)
    {
        try{

            $sql = ""; 
            if ($GLOBALS['sq']->getIsOpen() === false) {
                $GLOBALS['sq']->connect_DB();
            }

            $sql = "Select al1.IdMovie,al1.Name,al1.Cover,
            al4.StatusDesc,al2.CatDesc,al1.Sinopsis,al1.Trailler,al1.Details, al1.Duration,al1.Age,al1.Active 
            from " . $GLOBALS['sq']->getTableOwner() . ".CategoryMovie as al2,
            " . $GLOBALS['sq']->getTableOwner() . ".Movies as al1,
            " . $GLOBALS['sq']->getTableOwner() . ".StatusMovie as al4

            where
            al1.cat = al2.IdCat and al1.IdMovie=".$id." and
            al1.Status = al4.IdStatus";   
    
            $result = $GLOBALS['sq']->Db_Select($sql);
    
            if ($GLOBALS['sq']->fallo_query == false) {
    
                return $result;      
            }
            else{
                $GLOBALS['error']= "Error en la carga de la información seleccionada";
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

    public function new_movie($titulo,$id,$trailler,$categoria,$estado,$sinopsis,$cover,$detalle,$publico,$duracion,$tipo)
    {
        $sql = "";

      
        $sql = "Insert into " . $GLOBALS['sq']->getTableOwner() . ".Movies (IdMovie,Name,Type,cover,status,
        cat,sinopsis,trailler,details,active,duration,age) ";
        $sql = $sql. "Values('". $id ."','". $titulo ."','". $tipo ."','". $cover ."'
        ,'". $estado ."','". $categoria ."','". $sinopsis ."','". $trailler ."','". $detalle ."'
        ,'1','". $duracion ."','". $publico ."')";

        $GLOBALS['sq']->DB_Execute($sql);

        if ($GLOBALS['sq']->fallo_query == true) {

            $GLOBALS['error']= "Fallo al generar el nuevo registro. ";
            $GLOBALS['type']="error";
            return;
        } 
        else{
            $GLOBALS['error']= "Registro Generado. ";
            $GLOBALS['type']="success";
            return;
        }
    }

    public function movies_update($titulo,$id,$trailler,$categoria,$estado,$sinopsis,$detalle,$publico,$duracion,$activo)
    {
        try{
            $sql="";

            $sql = "Update " . $GLOBALS['sq']->getTableOwner() . ".Movies set Name = '".$titulo."',";
            $sql = $sql. " status = '".$estado."',cat = '".$categoria."',sinopsis = '".$sinopsis."',trailler = '".$trailler."',details = '".$detalle."',";
            $sql = $sql. " active = '".$activo."', duration = '".$duracion."',age = '".$publico."'";
            $sql = $sql. " where IdMovie = '". $id ."'";
    
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

}

