<div class="iq-top-navbar">
         <div class="iq-navbar-custom">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
               <div class="iq-menu-bt d-flex align-items-center">
                  <div class="wrapper-menu">
                     <div class="main-circle"><i class="fa fa-bars"></i></div>
                  </div>
                   <div class="iq-navbar-logo d-flex justify-content-between">
                     <a href="/DWprojectAdmin/home" class="header-logo">
                        <img src="/DWprojectAdmin/public/img/logo_Transparente.png" class="img-fluid rounded-normal" alt="">
                       
                     </a>
                  </div> 
               </div>
               <div class="iq-search-bar ml-auto">
                  
               </div> 
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
                  <i class="ri-menu-3-line"></i>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-list">
                        <li class="nav-item nav-icon ">
                          <?php
                                require_once('server/models/UserModel.php');
                                  $modelo = new UserModel();
                                  $resultado = $modelo->search_messages($GLOBALS["sq"]->getMAppUserId());
                                  if($resultado->rowcount() === 0){
                                     echo "  <a href='#' class='search-toggle iq-waves-effect text-gray rounded'>
                                                <i class='fa fa-bell'></i>               
                                             </a>";
                                  }else{
                                     
                                     while ($dato = $resultado->fetch()){
                                        echo "
                                        <a href='#' class='search-toggle iq-waves-effect text-gray rounded'>
                                            <i class='fa fa-bell'></i>
                                            <span class='bg-primary dots'></span>                         
                                        </a>
                                        <div class='iq-sub-dropdown'>
                                            <div class='iq-card shadow-none m-0'>
                                                <div class='iq-card-body p-0 '>
                                                    <div class='bg-primary p-3'>
                                                        <h5 class='mb-0 text-white'>Tienes nuevos mensajes<small class='badge  badge-light float-right pt-1'>". $resultado->rowcount() ."</small></h5>
                                                    </div>
                                                <a href='#' class='iq-sub-card'>
                                                <div class='media align-items-center'>
                                                        <div class='media-body ml-3'>
                                                            <h6 class='mb-0 '>". $dato['emisor'] ."</h6> 
                                                            <small class='float-left font-size-12'>". $dato['SendDate'] ."</small>
                                                        </div>
                                                    </div>
                                                    </a>
                                        
                                                </div>
                                            </div>
                                        </div>";
                                     }
                                  }
                          ?>
                        </li>
                        <li class="line-height pt-3">
                            <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                                <img src=<?php echo  "/DWprojectAdmin/public/img/users/" .$GLOBALS['sq']->getfoto()?>
                                    class="img-fluid rounded-circle mr-3" alt="user">
                            </a>
                            <div class="iq-sub-dropdown iq-user-dropdown">
                                <div class="iq-card shadow-none m-0">
                                    <div class="iq-card-body p-0 ">
                                        <div class="bg-primary p-3">
                                            <h5 class="mb-0 text-white line-height"><?php echo $GLOBALS["sq"]->getMRealUserName()?></h5>
                                            <span class="text-white font-size-12"><?php echo $GLOBALS["sq"]->getUserName()?></span>
                                        </div>
                                        
                                        <a href="/DWprojectAdmin/profile" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-file-user-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">Mi Perfil</h6>
                                                    <p class="mb-0 font-size-12">Visualiza tu perfil o editalo</p>
                                                </div>
                                            </div>
                                        </a>
                                        
                                        <a href="/DWprojectAdmin/logoff" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-login-box-line ml-2"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">Cerrar Sesión</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>