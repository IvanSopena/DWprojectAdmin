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
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title"> <?php echo $titulo ?></h4>
                                <input id="titulo" value = "<?php echo $valor ?>" hidden>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-view">
                                <table id='tabla_u' class="data-tables table movie_table" style="width:100%">
                                    <thead>
                                        <tr>

                                            <?php
                                                for($i = 0; $i < count($campos); ++$i) {
                                                    echo $campos[$i];
                                                }
                                            ?>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php
                                         echo $datos;
                                        ?>
                                            
                                    </tbody>
                                </table>
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