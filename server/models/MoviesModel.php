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

            $sql = "select  CatDesc,Icon,Color from " . $GLOBALS['sq']->getTableOwner() . ".CategoryMovie "; 
    
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

}

/* Select al1.CatDesc,al1.IdCat,count(al3.IdMovie), 

CONCAT(ROUND(count(al2.IdMovie) * (select count(IdMovie) from Movies) /100, 2), '%') as porcentaje

from 
CategoryMovie as al1, 
UserMovie as al2, 
Movies as al3

where

al1.IdCat = al3.cat and
al3.IdMovie = al2.IdMovie

Group by al1.IdCat */