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

   /*  public function send_new_password ($user_mail,$new_password){
        require 'Server/app/PHPMailer/Exception.php';
        require 'Server/app/PHPMailer/PHPMailer.php';
        require 'Server/app/PHPMailer/SMTP.php';
        
        $mail = new PHPMailer(true);
        try {
            
            $app_mail = "ivansopena.garbajosa@gmail.com";
            //Server settings 
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $app_mail;
            $mail->Password   = $GLOBALS['security']-> decrypt("T1JjTkR3a2FGUWtCRWdCWFZnPT0=",$app_mail);                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
            $mail->Port       = 587;                   

            //Recipients
            $mail->setFrom("notreply@streammovies.com",'notreply@streammovies.com'); // origen $app_mail, 
            $mail->addAddress($user_mail);     // destino Add a recipient
    
            // Content
            $mail->isHTML(true);                                  
            $mail->Subject = "Don't Reply StreaminMovies Team";
            $mail->Body    = 'Estimado usuario su nueva CONTRASEÑA es :Temporal1';
        
            $mail->send();
            
            $this->setErrorMail("Su nueva contraseña esta en camino, revise su correo");
            $this->setTypeMail("info");
        } catch (Exception $e) {
            $this->setErrorMail("Error al generar su nueva contraseña, pongase en contacto con nuestro servicio tecnico en el telefono 900123456");
            $this->setTypeMail("error");
        }
    } */
}