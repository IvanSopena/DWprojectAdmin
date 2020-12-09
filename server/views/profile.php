<?php require_once("global/header.php");require_once('server/models/MoviesModel.php'); ?>
<div class="wrapper">

    <div class="iq-sidebar">
        <div class="iq-sidebar-logo d-flex justify-content-between">
            <a href="index-2.html" class="header-logo">
                <img src="/DWprojectAdmin/public/img/logo_Transparente.png" class="img-fluid rounded-normal" alt="">
            </a>
             <div class="iq-menu-bt-sidebar">
                <div class="iq-menu-bt align-self-center">
                  <div class="wrapper-menu">
                     <div class="main-circle"><i class="fa fa-bars"></i></div>
                  </div>
               </div> 
            </div>
        </div>

        <?php require_once("layout/menu.php") ?>
    </div>
    <?php require_once("layout/navbar.php") ?>

    <?php
         if (isset($GLOBALS['error'])) 
         { 
           $err =  $GLOBALS['error'];        
            echo " <script>
                     toastr.".$GLOBALS['type']."('".$err."','STREAMING MOVIES',{
                       'closeButton': true,
                       'debug': true,
                       'preventDuplicates': false,
                       'progressBar': false,
                       'positionClass': 'toast-bottom-full-width'
                      });
                  </script>";
           
                  $GLOBALS['error'] = "";
          }
   ?>              
    <div id="content-page" class="content-page">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12">
                  <div class="iq-card">
                     <div class="iq-card-body p-0">
                        <div class="iq-edit-list">
                           <ul class="iq-edit-profile d-flex nav nav-pills">
                              <li class="col-md-3 p-0">
                                 <a class="nav-link active" data-toggle="pill" href="#personal-information">
                                    Información Personal
                                 </a>
                              </li>
                              <li class="col-md-3 p-0">
                                 <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                                    Cambiar Contraseña
                                 </a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-12">
                  <div class="iq-edit-list-data">
                     <div class="tab-content">
                        <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                           <div class="iq-card">
                              <div class="iq-card-header d-flex justify-content-between">
                                 <div class="iq-header-title">
                                    <h4 class="card-title">Información Personal</h4>
                                 </div>
                              </div>
                              <div class="iq-card-body">
                                 <form id="data_user" action="/DWprojectAdmin/update_profile" method="POST">
                                    <div class="form-group row align-items-center">
                                       <div class="col-md-12">
                                          <div class="profile-img-edit">
                                             <img id="FotoPerfil" class="profile-pic" src="<?php echo  "/DWprojectAdmin/public/img/users/" .$_COOKIE["Foto"]; ?>" alt="profile-pic">
                                             <div class="p-image">
                                                <i class="ri-pencil-line upload-button"></i>
                                                <input class="file-upload" id="thefile" name="thefile" type="file" value = ""/>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class=" row align-items-center">
                                       <div class="form-group col-sm-6">
                                          <label for="fname">Nombre:</label>
                                          <input type="text" class="form-control" name="name" id="fname" value="<?php echo $datos["name"]; ?>">
                                       </div>
                                       <div class="form-group col-sm-6">
                                          <label for="lname">Apellidos:</label>
                                          <input type="text" class="form-control" name="surname" id="lname" value="<?php echo $datos["surname"]; ?>">
                                       </div>
                                       <div class="form-group col-sm-6">
                                          <label for="uname">Email:</label>
                                          <input type="text" class="form-control" name="email" id="uname" value="<?php echo $datos["email"]; ?>">
                                       </div>
                                       <div class="form-group col-sm-6">
                                          <label for="cname">Ciudad:</label>
                                          <input type="text" class="form-control" name="city" id="cname" value="<?php echo $datos["city"]; ?>">
                                       </div>
                                       <div class="form-group col-sm-6">
                                          <label class="d-block">Genero:</label>
                                          <div class="custom-control custom-radio custom-control-inline">

                                             <input type="radio" id="customRadio6" name="customRadio1" value="Masculino" class="custom-control-input" <?php if($datos["gener"] == "Masculino"){echo "checked=''";}?>>
                                             <label class="custom-control-label" for="customRadio6"> Masculino </label> 
                                          </div>
                                          <div class="custom-control custom-radio custom-control-inline">
                                             <input type="radio" id="customRadio7" name="customRadio1" value="Femenino"  class="custom-control-input" <?php if($datos["gener"] == "Femenino"){echo "checked=''";}?>>
                                             <label class="custom-control-label" for="customRadio7"> Femeninino </label> 
                                          </div>
                                       </div>
                                       <div class="form-group col-sm-6">
                                          <label>Fecha de Nacimiento:</label>
                                          <input class="form-control date-input  basicFlatpickr" name="date" type="text" value="<?php echo $datos["birthday"]; ?>">
                                          
                                       </div>
                                       <div class="form-group col-sm-6">
                                          <label>Puesto:</label>
                                          <select class="form-control" name="job" id="exampleFormControlSelect1">

                                          <?php
                                          switch ($datos["job"]) {
                                             case "0":
                                                   echo "<option selected='selected' value=''>Seleccione su puesto</option>
                                                   <option value='1'>Programador</option>
                                                   <option value='2'>Diseñador</option>
                                                   <option value='3'>Coordinador</option>
                                                   <option value='4'>Administrativo</option>";
                                                   break;
                                             case "1":
                                                   echo "<option  value=''>Seleccione su puesto</option>
                                                   <option selected='selected' value='1'>Programador</option>
                                                   <option value='2'>Diseñador</option>
                                                   <option value='3'>Coordinador</option>
                                                   <option value='4'>Administrativo</option>";
                                                   break;
                                             case "2":
                                                   echo "<option  value='0'>Seleccione su puesto</option>
                                                   <option value='1'>Programador</option>
                                                   <option selected='selected' value='2'>Diseñador</option>
                                                   <option value='3'>Coordinador</option>
                                                   <option value='4'>Administrativo</option>";
                                                   break;
                                             case "3":
                                                   echo "<option  value='0'>Seleccione su puesto</option>
                                                   <option value='1'>Programador</option>
                                                   <option value='2'>Diseñador</option>
                                                   <option selected='selected' value='3'>Coordinador</option>
                                                   <option value='4'>Administrativo</option>";
                                                   break;
                                             case "4":
                                                   echo "<option  value='0'>Seleccione su puesto</option>
                                                   <option value='1'>Programador</option>
                                                   <option value='2'>Diseñador</option>
                                                   <option value='3'>Coordinador</option>
                                                   <option selected='selected' value='4'>Administrativo</option>";
                                                   break;
                                        }
                                    ?>

                                          </select>
                                       </div>
                                       
                                       <div class="form-group col-sm-6">
                                          <label>Pais:</label>
                                          <select class="form-control" name="country" id="exampleFormControlSelect3">
                                          <?php
                                          switch ($datos["country"]) {
                                             case "0":
                                                   echo "<option selected='selected' value='0'>Seleccione su país</option>
                                                   <option value='1'>España</option>
                                                   <option value='2'>Francia</option>
                                                   <option value='3'>USA</option>
                                                   <option value='4'>Italia</option>";
                                                   break;
                                             case "1":
                                                   echo "<option  value='0'>Seleccione su país</option>
                                                   <option selected='selected' value='1'>España</option>
                                                   <option value='2'>Francia</option>
                                                   <option value='3'>USA</option>
                                                   <option value='4'>Italia</option>";
                                                   break;
                                             case "2":
                                                   echo "<option  value='0'>Seleccione su país</option>
                                                   <option value='1'>España</option>
                                                   <option selected='selected' value='2'>Francia</option>
                                                   <option value='3'>USA</option>
                                                   <option value='4'>Italia</option>";
                                                   break;
                                             case "3":
                                                   echo "<option  value='0'>Seleccione su país</option>
                                                   <option value='1'>España</option>
                                                   <option value='2'>Francia</option>
                                                   <option selected='selected' value='3'>USA</option>
                                                   <option value='4'>Italia</option>";
                                                   break;
                                             case "4":
                                                   echo "<option  value='0'>Seleccione su país</option>
                                                   <option value='1'>España</option>
                                                   <option value='2'>Francia</option>
                                                   <option value='3'>USA</option>
                                                   <option selected='selected' value='4'>Italia</option>";
                                                   break;
                                        }
                                    ?>
                                          </select>
                                       </div>
                                      
                                       <div class="form-group col-sm-12">
                                          <label>Direccion:</label>
                                          <textarea class="form-control" name="address" rows="5" ><?php echo trim($datos["address"]); ?></textarea>
                                       </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Cambiar</button>
                                    <a href="/DWprojectAdmin/" class="btn btn-primary">Cancelar</a>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                           <div class="iq-card">
                              <div class="iq-card-header d-flex justify-content-between">
                                 <div class="iq-header-title">
                                    <h4 class="card-title">Cambio de Contraseña</h4>
                                 </div>
                              </div>
                              <div class="iq-card-body">
                                 <form id="pass_form" action="/DWprojectAdmin/update_password" method="POST">
                                   
                                    <div class="form-group ">
                                       <label for="npass">Nueva Contraseña:</label>
                                       <input type="Password" name="pass" class="form-control Password2" id="npass" value="">
                                       <span class="fa fa-fw fa-eye password-icon show-password2"></span>
                                    </div>
                                    <div class="form-group">
                                       <label for="vpass">Verificación:</label>
                                       <input type="Password" name="validate" class="form-control Password3" id="vpass" value="">
                                       <span class="fa fa-fw fa-eye password-icon show-password3"></span>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Cambiar</button>
                                    <a href="/DWprojectAdmin/" class="btn btn-primary">Cancelar</a>
                                 </form>
                              </div>
                           </div>
                        </div>
                       
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

</div>


   <?php require_once("global/footer.php") ?>
</body>

</html>