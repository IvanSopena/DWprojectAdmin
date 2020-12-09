<?php

class LoginModel
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

    public function login($User, $Password)
    {
        
        if ($GLOBALS['sq']->getIsOpen() === true) 
        {
            $GLOBALS['sq']->AppOpen($User, $Password);

            if ($GLOBALS['sq']->geterrors() == true) {
                $GLOBALS['error']= $GLOBALS['sq']->getClsLastError();
                $GLOBALS['type']="warning";

               

                $this->setView("login");
                return;
            } 
            else 
            {
                /* setcookie("Foto", $GLOBALS['sq']->getfoto(), 0, "/"); 
                setcookie("Id", $GLOBALS['sq']->getMAppUserId(), 0, "/"); */

                session_start();
                $_SESSION["user"] = $GLOBALS['sq']->getMAppUserId(); 
               
                         
                $this->setView("dashboard");
                return;
            }

        } else {
            $GLOBALS['error']= "Error de conexión: ".$GLOBALS['sq']->getClsLastError();
            $GLOBALS['type']="error";
            $this->setView("login");
            return;
        }
    }

   
}