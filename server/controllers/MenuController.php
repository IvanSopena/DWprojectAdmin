<?php

class MenuController extends Controlador
{


	public function __construct()
	{
    }

    /********************************** Menu de Usuarios ********************************/
    public function detail_users()
    {
        session_start();
        $GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]);
        $model = $this->modelo('MenuModel');
        $datos = $model->info_user($_GET["id"]);
        
        $this->vista_grid('details', $datos,'',"Editar Usuarios");
    }
    public function update_users()
    {
        session_start();
        $GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]);
        $model = $this->modelo('MenuModel');

        $Nombre = $_POST["nombre"];
        $Apellidos = $_POST["apellido"];
        $email = $_POST["email"];
        $date = $_POST["date"];
        $plan = $_POST["plan"];
        $pais = $_POST["pais"];
        $activo = $_POST["activo"];
        $id = $_POST["id"];
      
        $model->user_update($Nombre,$Apellidos,$email,$date,$plan,$pais,$activo,$id);
        $datos = $model->info_user($id);
        $this->vista_grid('details', $datos,'',"Editar Usuarios");
    }
    public function delete_user()
    {
        
        $model = $this->modelo('MenuModel');
        $datos = $model->del_user($_GET["id"]);

        $this->users();
    }
    public function users()
	{
		session_start();
        $GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]);
        
        $campos = array("<th style='width: 3%;'>ID</th>" , "<th style='width: 8%;'></th>" , "<th style='width: 10%;'>NOMBRE</th>"  , "<th style='width: 10%;'>EMAIL</th>", "<th style='width: 10%;'>PAIS</th>" , "<th style='width: 10%;'>ESTADO</th>" ,"<th style='width: 10%;'>NACIMIENTO</th>" , "<th style='width: 8%;'>PLAN</th>" ,  "<th style='width: 10%;'>ACCIONES</th>");
        
        $model = $this->modelo('MenuModel');

        $datos = $model->Obtener_Usuarios();
        $escritura = "";

        while ($dato = $datos->fetch()){
            $escritura = $escritura . "<tr>
                   <td>". $dato['Id'] ."</td>
                   <td>
                       <img src='/DWprojectAdmin/public/img/users/". $dato['Foto'] ."' class='img-fluid avatar-50' alt='author-profile'>
                   </td>
                   <td>". $dato['Usuario'] ."</td>
                  
                   <td>". $dato['Email'] ."</td>
                   <td>". $dato['Pais'] ."</td>";
                   if($dato['Activo'] === "1"){
                       $escritura = $escritura . "<td><span class='badge iq-bg-success'>Activo</span></td>";
                   }else{
                       $escritura = $escritura . "<td><span class='badge iq-bg-primary'>Inactivo</span></td>";
                   }
                   $escritura = $escritura . "<td>". $dato['Nacimiento'] ."</td>
                   <td>". $dato['Plan'] ."</td>
                   <td>
                       <div class='flex align-items-center list-user-action'>
                           <a class='iq-bg-success' id='edit' data-toggle='tooltip' data-placement='top' title='' data-original-title='Edit' href='#'> 
                               <i class='ri-pencil-line'></i></a>
                           <a class='iq-bg-primary' id='del' data-toggle='tooltip' data-placement='top' title='' data-original-title='Delete' href='#'>
                               <i class='ri-delete-bin-line'></i></a>
                       </div>
                   </td>
                   </tr>";         
        }

		$this->vista_grid('datagrid', $escritura,$campos,"Listado de Usuarios");
		
    }
    /********************************** Menu de Categorias ********************************/

    public function add_category()
    {
        session_start();
        $GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]);
       /*  $model = $this->modelo('MenuModel');
        $datos = $model->info_user($_GET["id"]); */
        
        $this->vista_grid('details', '','',"Añadir Categoria");
    }

    public function view_category()
    {
        session_start();
        $GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]);
        
        $campos = array("<th style='width: 3%;'>ID</th>" , "<th style='width: 3%;'></th>" , "<th style='width: 10%;'>NOMBRE</th>"  , "<th style='width: 10%;'>COLOR</th>", "<th style='width: 10%;'>PELICULAS/SERIES</th>" , "<th style='width: 10%;'>ACCIONES</th>");
        
        $model = $this->modelo('MenuModel');

        $datos = $model->Obtener_Categorias();
        $escritura = "";

        while ($dato = $datos->fetch()){
            $escritura = $escritura . "<tr>
                   <td>". $dato['Id'] ."</td>
                   <td>
                        <i class='". $dato['Icon'] ." font-size-32'></i>
                   </td>
                   <td>". $dato['Descripcion'] ."</td>
                  <td><span class='badge iq-bg-". $dato['Color'] ."'>". $dato['Color'] ."</span></td>";
                  
                   $escritura = $escritura . "<td>". $dato['Totales'] ."</td>
                   
                   <td>
                       <div class='flex align-items-center list-user-action'>
                           <a class='iq-bg-success' id='edit' data-toggle='tooltip' data-placement='top' title='' data-original-title='Edit' href='#'> 
                               <i class='ri-pencil-line'></i></a>
                           <a class='iq-bg-primary' id='del' data-toggle='tooltip' data-placement='top' title='' data-original-title='Delete' href='#'>
                               <i class='ri-delete-bin-line'></i></a>
                       </div>
                   </td>
                   </tr>";         
        }

		$this->vista_grid('datagrid', $escritura,$campos,"Listado de Categorias");
    }
}