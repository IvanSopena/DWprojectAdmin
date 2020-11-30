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
</div>

<div id="content-page" class="content-page">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-8">
                  <div class="iq-header-title">
                     <h4 class="card-title">Resumen Semanal</h4>
                  </div>
                  <div class="row iq-mini_cards">
                
                     <div class="col-sm-6 col-lg-6 col-xl-3">
                    
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body">
                              <div class="d-flex align-items-center justify-content-between">
                                 <div class="iq-cart-text text-capitalize">
                                    <p class="mb-0">
                                       Visualiz.
                                    </p>
                                 </div>
                                 <div class="icon iq-icon-box-top rounded-circle bg-primary">
                                    <i class="fa fa-eye"></i>
                                 </div>
                              </div>
                              <div class="d-flex align-items-center justify-content-between mt-3">
                                 <h4 class=" mb-0">+24K</h4>
                                 <p class="mb-0 text-primary"><span><i class="fa fa-caret-down mr-2"></i></span>35%</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-6 col-xl-3">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body">
                              <div class="d-flex align-items-center justify-content-between">
                                 <div class="iq-cart-text text-capitalize">
                                    <p class="mb-0 font-size-14">
                                       Comentarios
                                    </p>
                                 </div>
                                 <div class="icon iq-icon-box-top rounded-circle bg-warning">
                                    <i class="fa fa-star"></i>
                                 </div>
                              </div>
                              <div class="d-flex align-items-center justify-content-between mt-3">
                                 <h4 class=" mb-0">+55K</h4>
                                 <p class="mb-0 text-warning"><span><i class="fa fa-caret-up mr-2"></i></span>50%</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-6 col-xl-3">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body">
                              <div class="d-flex align-items-center justify-content-between">
                                 <div class="iq-cart-text text-capitalize">
                                    <p class="mb-0 font-size-14">
                                      Descargas
                                    </p>
                                 </div>
                                 <div class="icon iq-icon-box-top rounded-circle bg-info">
                                    <i class="fa fa-download"></i>
                                 </div>
                              </div>
                              <div class="d-flex align-items-center justify-content-between mt-3">
                                 <h4 class=" mb-0">+1M</h4>
                                 <p class="mb-0 text-info"><span><i class="fa fa-caret-up mr-2"></i></span>80%</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-6 col-xl-3">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body">
                              <div class="d-flex align-items-center justify-content-between">
                                 <div class="iq-cart-text text-uppercase">
                                    <p class="mb-0 font-size-14">
                                       Usuarios
                                    </p>
                                 </div>
                                 <div class="icon iq-icon-box-top rounded-circle bg-success">
                                    <i class="fa fa-user"></i>
                                 </div>
                              </div>
                              <div class="d-flex align-items-center justify-content-between mt-3">
                                 <h4 class=" mb-0">+2M</h4>
                                 <p class="mb-0 text-success"><span><i class="fa fa-caret-up mr-2"></i></span>80%</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex align-items-center justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Resumen por Categorias</h4>
                        </div>
                       
                     </div>
                     <div class="iq-card-body row align-items-center">
                       <div class="col-lg-12">
                           <div class="row mb-3">
                              

                                 <?php
                                    $modelo = new MoviesModel();
                                    $resultado = $modelo->charge_category();
                                    if($resultado === ""){
                                       echo " <h4 class='card-title'>No hay Datos. Seguro que hay problemas</h4>";
                                    }else{
                                       
                                       while ($dato = $resultado->fetch()){
                                          echo "<div class='col-sm-6 col-md-4 col mb-3'>
                                                   <div class='iq-progress-bar progress-bar-vertical iq-bg-". $dato['Color'] ."'>
                                                      <span class='bg-". $dato['Color'] ."' data-percent='100' style='transition: height 2s ease 0s; width: 100%; height: 70%;'></span>
                                                   </div>
                                                   <div class='media align-items-center'>
                                                      <div class='iq-icon-box-view rounded mr-3 iq-bg-". $dato['Color'] ."'><i class='". $dato['Icon'] ." font-size-32'></i></div>
                                                      <div class='media-body text-white'>
                                                            <p class='mb-0 font-size-14 line-height'>". $dato['CatDesc'] ."</p>
                                                            <small class='text-". $dato['Color'] ." mb-0'>+44%</small>
                                                      </div>
                                                   </div>
                                                </div>";
                                       }
                                    }
                                 ?>

                        </div> 
                        
                     </div>
                    
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Peliculas mas vistas</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center seasons">
                           <div class="iq-custom-select d-inline-block sea-epi s-margin">
                              <select name="cars" class="form-control season-select">
                                 <option value="season1">Mas Vistas</option>
                                 <option value="season2">Menos Vistas</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <table class="data-tables table movie_table" style="width:100%">
                              <thead>
                                 <tr>
                                    <th style="width:20%;">Movie</th>
                                    <th style="width:10%;">Rating</th>
                                    <th style="width:20%;">Category</th>
                                    <th style="width:10%;">Download/Views</th>
                                    <th style="width:10%;">User</th>
                                    <th style="width:20%;">Date</th>
                                    <th style="width:10%;"><i class="fa fa-heart"></i></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>
                                       <div class="media align-items-center">
                                          <div class="iq-movie">
                                             <a href="javascript:void(0);"><img src="../assets/images/movie-thumb/01.jpg" class="img-border-radius avatar-40 img-fluid" alt=""></a>
                                          </div>
                                          <div class="media-body text-white text-left ml-3">
                                             <p class="mb-0">Champions</p>
                                             <small>1h 40m</small>
                                          </div>
                                       </div>
                                    </td>
                                    <td><i class="fa fa-star mr-2"></i> 9.2</td>
                                    <td>Horror</td>
                                    <td>
                                       <i class="fa fa-eye "></i>
                                    </td>
                                    <td>Unsubcriber</td>
                                    <td>21 July,2020</td>
                                    <td><i class="fa fa-heart text-primary"></i></td>
                                 </tr>
                                 <tr>
                                    <td >
                                       <div class="media align-items-center">
                                          <div class="iq-movie">
                                             <a href="javascript:void(0);"><img src="../assets/images/show-thumb/05.jpg" class="img-border-radius avatar-40 img-fluid" alt=""></a>
                                          </div>
                                          <div class="media-body text-white text-left ml-3">
                                             <p class="mb-0">Last Race</p>
                                          </div>
                                       </div>
                                    </td>
                                    <td><i class="fa fa-star mr-2"></i> 7.2</td>
                                    <td>Horror</td>
                                    <td>
                                       <i class="fa fa-eye "></i>
                                    </td>
                                    <td>subcriber</td>
                                    <td>22 July,2020</td>
                                    <td><i class="fa fa-heart text-primary"></i></td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class="media align-items-center">
                                          <div class="iq-movie">
                                             <a href="javascript:void(0);"><img src="../assets/images/show-thumb/07.jpg" class="img-border-radius avatar-40 img-fluid" alt=""></a>
                                          </div>
                                          <div class="media-body text-white text-left ml-3">
                                             <p class="mb-0">Boop Bitty</p>
                                          </div>
                                       </div>
                                    </td>
                                    <td><i class="fa fa-star mr-2"></i> 8.2</td>
                                    <td>Thriller</td>
                                    <td>
                                       <i class="fa fa-eye "></i>
                                    </td>
                                    <td>Unsubcriber</td>
                                    <td>23 July,2020</td>
                                    <td><i class="fa fa-heart text-primary"></i></td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class="media align-items-center">
                                          <div class="iq-movie">
                                             <a href="javascript:void(0);"><img src="../assets/images/show-thumb/10.jpg" class="img-border-radius avatar-40 img-fluid" alt=""></a>
                                          </div>
                                          <div class="media-body text-white text-left ml-3">
                                             <p class="mb-0">Dino Land</p>
                                          </div>
                                       </div>
                                    </td>
                                    <td><i class="fa fa-star mr-2"></i> 8.5</td>
                                    <td>Action</td>
                                    <td>
                                       <i class="fa fa-eye "></i>
                                    </td>
                                    <td>Unsubcriber</td>
                                    <td>24 July,2020</td>
                                    <td><i class="fa fa-heart text-primary"></i></td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class="media align-items-center">
                                          <div class="iq-movie">
                                             <a href="javascript:void(0);"><img src="../assets/images/show-thumb/04.jpg" class="img-border-radius avatar-40 img-fluid" alt=""></a>
                                          </div>
                                          <div class="media-body text-white text-left ml-3">
                                             <p class="mb-0">The Last Breath</p>
                                          </div>
                                       </div>
                                    </td>
                                    <td><i class="fa fa-star mr-2"></i> 8.9</td>
                                    <td>Horror</td>
                                    <td>
                                       <i class="fa fa-eye "></i>
                                    </td>
                                    <td>subcriber</td>
                                    <td>25 July,2020</td>
                                    <td><i class="fa fa-heart text-primary"></i></td>
                                 </tr>
                              </tbody>
                           </table>
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
                    
            echo " <script>
                     toastr.".$GLOBALS['type']."('".$GLOBALS['error']."','STREAMING MOVIES',{
                       'closeButton': true,
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