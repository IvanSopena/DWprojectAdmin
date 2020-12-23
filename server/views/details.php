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

    <div id="content-page" class="content-page">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4  class="card-title"><?php echo $titulo ?></h4>
                        </div>
                     </div>
                     <div class="iq-card-body">


                        
                        <?php 
                            switch ($titulo) {
                              case "Editar Usuarios":
                                 require_once("layout/user_details.php");
                              break;
                              case "Añadir Nueva Categoria":
                                 require_once("layout/category_details.php");
                              break;
                              case "Editar Categoria":
                                 require_once("layout/category_details.php");
                              break;
                              case "Añadir Nuevo Estado":
                                 require_once("layout/status_details.php");
                              break;
                              case "Editar Estado":
                                 require_once("layout/status_details.php");
                              break;
                              case "Añadir Nueva Pelicula":
                                 require_once("layout/movies_detail.php");
                              break;
                              case "Editar Pelicula":
                                 require_once("layout/movies_detail.php");
                              break;
                              case "Añadir Nueva Serie":
                                 require_once("layout/detail_series.php");
                              break;
                              case "Editar Serie":
                                 require_once("layout/detail_series.php");
                              break;
                              case "Notifications":
                                 require_once("layout/notifications.php");
                              break;
                              case "Enviar Notificaciones":
                                 require_once("layout/notify.php");
                              break;
                              
                          
                          }

                         ?>
                        
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
    </div>
</div>
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
<?php require_once("global/footer.php") ?>
</body>

</html>