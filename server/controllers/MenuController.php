<?php

class MenuController extends Controlador
{


	public function __construct()
	{
    }

    /********************************** Menu Usuarios ********************************/
    public function detail_users()
    {
        session_start();
        $GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]);
        $model = $this->modelo('MenuModel');
        $datos = $model->info_user($_GET["id"]);
        
        $this->vista_grid('details', $datos,'',"Editar Usuarios","");
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
        $this->vista_grid('details', $datos,'',"Editar Usuarios","");
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
                           <a class='iq-bg-success' id='edit' data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar' href='#'> 
                               <i class='ri-pencil-line'></i></a>
                           <a class='iq-bg-primary' id='del' data-toggle='tooltip' data-placement='top' title='' data-original-title='Borrar' href='#'>
                               <i class='ri-delete-bin-line'></i></a>
                       </div>
                   </td>
                   </tr>";         
        }

		$this->vista_grid('datagrid', $escritura,$campos,"Listado de Usuarios","1");
		
    }
    /********************************** Menu Categorias ********************************/

    public function details_category()
    {
        session_start();
        $GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]);
       
        
        $this->vista_grid('details', '','',"Añadir Nueva Categoria","");
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
                   <td>". $dato['IdCat'] ."</td>
                   <td>
                        <i class='". $dato['Icon'] ." font-size-32'></i>
                   </td>
                   <td>". $dato['CatDesc'] ."</td>
                  <td><span class='badge iq-bg-". $dato['Color'] ."'>". $dato['Color'] ."</span></td>";
                  
                   $escritura = $escritura . "<td>". $dato['Total'] ."</td>
                   
                   <td>
                       <div class='flex align-items-center list-user-action'>
                           <a class='iq-bg-success' id='edit' data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar' href='#'> 
                               <i class='ri-pencil-line'></i></a>
                           <a class='iq-bg-primary' id='del' data-toggle='tooltip' data-placement='top' title='' data-original-title='Eliminar' href='#'>
                               <i class='ri-delete-bin-line'></i></a>
                       </div>
                   </td>
                   </tr>";         
        }

		$this->vista_grid('datagrid', $escritura,$campos,"Listado de Categorias","2");
    }

    public function add_category()
    {
        
        $model = $this->modelo('MenuModel');

        $nombre = $_POST["nombre"];
        $Ico = $_POST["icono"];
        $color = $_POST["Color"];
        $Id = $_POST["id"];

        $model->new_category($Id,$nombre,$Ico,$color);

        $this->view_category();
    }

    public function delete_category()
    {
        $model = $this->modelo('MenuModel');
        $datos = $model->del_cat($_GET["id"]);
        

        $this->view_category();
    }

    public function edit_category()
    {
        session_start();
        $GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]);
        $model = $this->modelo('MenuModel');
        $datos = $model->category_data($_GET["id"]);
        
        $this->vista_grid('details', $datos,'',"Editar Categoria","");
    }

    public function update_category()
    {
        /* session_start();
        $GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]); */
        $model = $this->modelo('MenuModel');

        $nombre = $_POST["nombre"];
        $Ico = $_POST["icono"];
        $color = $_POST["Color"];
        $id = $_POST["id"];
      
        $model->Category_update($nombre,$Ico,$color,$id);
        
        $datos = $model->category_data($id);
        $this->vista_grid('details', $datos,'',"Editar Categoria","");
    }
    /********************************** Menu Estados ********************************/

    public function view_status()
    {
        session_start();
        $GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]);
        
        $campos = array("<th style='width: 5%;'>ID</th>" ,  "<th style='width: 10%;'>NOMBRE</th>"  , "<th style='width: 10%;'>PELICULAS/SERIES</th>" , "<th style='width: 10%;'>ACCIONES</th>");
        
        $model = $this->modelo('MenuModel');

        $datos = $model->Obtener_Estados();
        $escritura = "";

        while ($dato = $datos->fetch()){
            $escritura = $escritura . "<tr>
                   <td>". $dato['IdStatus'] ."</td>
                   
                   <td>". $dato['StatusDesc'] ."</td>";
                  
                   $escritura = $escritura . "<td>". $dato['Total'] ."</td>
                   
                   <td>
                       <div class='flex align-items-center list-user-action'>
                           <a class='iq-bg-success' id='edit' data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar' href='#'> 
                               <i class='ri-pencil-line'></i></a>
                           <a class='iq-bg-primary' id='del' data-toggle='tooltip' data-placement='top' title='' data-original-title='Eliminar' href='#'>
                               <i class='ri-delete-bin-line'></i></a>
                       </div>
                   </td>
                   </tr>";         
        }

		$this->vista_grid('datagrid', $escritura,$campos,"Listado de Estados","3");
    }

    public function details_status()
    {
        session_start();
        $GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]);
       
        
        $this->vista_grid('details', '','',"Añadir Nuevo Estado","");
    }

    public function edit_status()
    {
        session_start();
        $GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]);
        $model = $this->modelo('MenuModel');
        $datos = $model->status_data($_GET["id"]);
        
        $this->vista_grid('details', $datos,'',"Editar Estado","");
    }

    public function delete_status()
    {
        $model = $this->modelo('MenuModel');
        $model->del_status($_GET["id"]);
        

        $this->view_status();
    }

    public function update_status()
    {
        
        $model = $this->modelo('MenuModel');

        $nombre = $_POST["nombre"];
        $id = $_POST["id"];
      
        $model->status_update($nombre,$id);
        
        $datos = $model->status_data($id);
        $this->vista_grid('details', $datos,'',"Editar Estado","");
    }

    public function add_status()
    {
        
        $model = $this->modelo('MenuModel');

        $nombre = $_POST["nombre"];
        $Id = $_POST["id"];

        $model->new_status($Id,$nombre);

        $this->view_status();
    }
    /********************************** Menu Peliculas ********************************/
    public function view_movies()
    {
        session_start();
        $GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]);
        
        $campos = array("<th style='width: 3%;'>Id</th>" , "<th style='width: 8%;'></th>" , 
        "<th style='width: 10%;'>Titulo</th>"  , "<th style='width: 10%;'>Estado</th>", 
        "<th style='width: 10%;'>Categoria</th>" , "<th style='width: 10%;'>Activo</th>" ,
        "<th style='width: 10%;'>Duración</th>" , "<th style='width: 8%;'>Públicos</th>" ,  
        "<th style='width: 10%;'>ACCIONES</th>");

        $model = $this->modelo('MoviesModel');

        $datos = $model->Obtener_peliculas();
        $escritura = "";

        while ($dato = $datos->fetch()){
            $escritura = $escritura . "<tr>
                   <td>". $dato['IdMovie'] ."</td>
                   <td>
                       <img src='/DWprojectAdmin/". $dato['Cover'] ."' class='img-fluid avatar-50' alt='author-profile'>
                   </td>
                   <td>". $dato['Name'] ."</td>
                  
                   <td>". $dato['StatusDesc'] ."</td>
                   <td>". $dato['CatDesc'] ."</td>";
                   if($dato['Active'] === "1"){
                       $escritura = $escritura . "<td><span class='badge iq-bg-success'>Activo</span></td>";
                   }else{
                       $escritura = $escritura . "<td><span class='badge iq-bg-primary'>Inactivo</span></td>";
                   }
                   $escritura = $escritura . "<td>". $dato['Duration'] ."</td>
                   <td>". $dato['Age'] ."</td>
                   <td>
                       <div class='flex align-items-center list-user-action'>
                           <a class='iq-bg-success' id='edit' data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar' href='#'> 
                               <i class='ri-pencil-line'></i></a>
                           <a class='iq-bg-primary' id='del' data-toggle='tooltip' data-placement='top' title='' data-original-title='Eliminar' href='#'>
                               <i class='ri-delete-bin-line'></i></a>
                       </div>
                   </td>
                   </tr>";         
        }
		$this->vista_grid('datagrid', $escritura,$campos,"Listado de Pelicuas","4");
    }

    public function details_movies()
    {
        session_start();
        $GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]);
       
        
        $this->vista_grid('details', '','',"Añadir Nueva Pelicula","");
    }

    /********************************** Menu Series ********************************/
    public function view_series()
    {
        session_start();
        $GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]);
        
        $campos = array("<th style='width: 3%;'>Id</th>" , "<th style='width: 8%;'></th>" , 
        "<th style='width: 10%;'>Titulo</th>"  , "<th style='width: 10%;'>Estado</th>", 
        "<th style='width: 10%;'>Categoria</th>" , "<th style='width: 10%;'>Activo</th>" ,
        "<th style='width: 10%;'>Duración</th>" , "<th style='width: 8%;'>Públicos</th>" ,  
        "<th style='width: 10%;'>ACCIONES</th>");

        $model = $this->modelo('MoviesModel');

        $datos = $model->Obtener_series();
        $escritura = "";

        while ($dato = $datos->fetch()){
            $escritura = $escritura . "<tr>
                   <td>". $dato['IdMovie'] ."</td>
                   <td>
                       <img src='/DWprojectAdmin/". $dato['Cover'] ."' class='img-fluid avatar-50' alt='author-profile'>
                   </td>
                   <td>". $dato['Name'] ."</td>
                  
                   <td>". $dato['StatusDesc'] ."</td>
                   <td>". $dato['CatDesc'] ."</td>";
                   if($dato['Active'] === "1"){
                       $escritura = $escritura . "<td><span class='badge iq-bg-success'>Activo</span></td>";
                   }else{
                       $escritura = $escritura . "<td><span class='badge iq-bg-primary'>Inactivo</span></td>";
                   }
                   $escritura = $escritura . "<td>". $dato['Duration'] ."</td>
                   <td>". $dato['Age'] ."</td>
                   <td>
                       <div class='flex align-items-center list-user-action'>
                           <a class='iq-bg-success' id='edit' data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar' href='#'> 
                               <i class='ri-pencil-line'></i></a>
                           <a class='iq-bg-primary' id='del' data-toggle='tooltip' data-placement='top' title='' data-original-title='Eliminar' href='#'>
                               <i class='ri-delete-bin-line'></i></a>
                       </div>
                   </td>
                   </tr>";         
        }
		$this->vista_grid('datagrid', $escritura,$campos,"Listado de Pelicuas","4");
    }
    public function details_series()
    {
        session_start();
        $GLOBALS['sq']->refrescar_credenciales($_SESSION["user"]);
       
        
        $this->vista_grid('details', '','',"Añadir Nueva Serie","");
    }
}
   