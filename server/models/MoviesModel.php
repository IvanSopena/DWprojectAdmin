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

    public function Obtener_peliculas()
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
            al1.cat = al2.IdCat and al1.type=1 and
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

    public function Obtener_series()
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
            al1.cat = al2.IdCat and al1.type=2 and
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

}

