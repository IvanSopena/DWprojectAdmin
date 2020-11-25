<header id="main-header">
    <div class="main-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <nav class="navbar navbar-expand-lg navbar-light p-0">
                        <a href="#" class="navbar-toggler c-toggler" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <div class="navbar-toggler-icon" data-toggle="collapse">
                                <span class="navbar-menu-icon navbar-menu-icon--top"></span>
                                <span class="navbar-menu-icon navbar-menu-icon--middle"></span>
                                <span class="navbar-menu-icon navbar-menu-icon--bottom"></span>
                            </div>
                        </a>
                        <a class="navbar-brand" href="/DWProject/home"> <img class="img-fluid logo" src="/DWProject/public/img/tex1.png"
                                alt="streamit" /> </a>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="menu-main-menu-container">
                                <ul id="top-menu" class="navbar-nav ml-auto">
                                    <li class="menu-item">
                                        <a href="/DWProject/home">Inicio</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="/DWProject/series">Series</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="/DWProject/movies">Peliculas</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="mobile-more-menu">
                            <a href="javascript:void(0);" class="more-toggle" id="dropdownMenuButton"
                                data-toggle="more-toggle" aria-haspopup="true" aria-expanded="false">
                                <i class="ri-more-line"></i>
                            </a>
                            <div class="more-menu" aria-labelledby="dropdownMenuButton">
                                <div class="navbar-right position-relative">
                                    <ul class="d-flex align-items-center justify-content-end list-inline m-0">
                                        <li>
                                            <a href="#" class="search-toggle">
                                                <i class="fa fa-search"></i>
                                            </a>
                                            <div class="search-box iq-search-bar">
                                                <form action="/DWProject/search" method="POST" class="searchbox">
                                                    <div class="form-group position-relative">
                                                        <input type="text" name="busqueda"
                                                            class="text search-input font-size-12"
                                                            placeholder="Busca la pelicula por el titulo">
                                                        <i class="search-link ri-search-line"></i>
                                                    </div>
                                                </form>
                                            </div>
                                        </li>
                                        <li class="nav-item nav-icon">
                                            <a href="#" class="search-toggle" data-toggle="search-toggle">
                                                <i class="fa fa-bell"></i>
                                                <?php 
                                        
                                        $modelo = new ActionUsers();
                                        $novedades = $modelo->obtener_notificaciones();
                                        if(intval($novedades["total"])>0){
                                            echo "<span class='bg-danger dots'>".$novedades["total"]."</span>";
                                        }
                                 ?>

                                            </a>
                                            <div class="iq-sub-dropdown">

                                                <?php 
                                        
                                        $modelo = new ActionUsers();
                                        $novedades = $modelo->leer_notificaciones();
                                        while ($dato = $novedades->fetch()){
                                            echo "
                                            <div class='iq-card shadow-none m-0'>
                                            <div class='iq-card-body'>
                                            <a href='#' id ='iq-sub-card_msg'>
                                                <div  class='media align-items-center '>
                                                    <img id = 'msg_img' src='/DWProject/public/img/sobre.png' class='img-fluid mr-3'alt='streamit' />
                                                    <div id = 'msg_txt' class='media-body'>
                                                        <h6  class='mb-0 '>Nuevo Mensaje</h6>
                                                        <small class='font-size-12'>Remitente: " . $dato['Usuario'] ."</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        </div>";
                                        }
                                    ?>


                                            </div>
                                        </li>
                                        <li class="nav-item nav-icon">
                                            <a href="#"
                                                class="iq-user-dropdown search-toggle p-0 d-flex align-items-center"
                                                data-toggle="search-toggle">
                                                <img id="NavFoto"
                                                    src=<?php echo "/DWProject/public/img/users/". $GLOBALS['sq']->getfoto(); ?>
                                                    class="img-fluid avatar-40 rounded-circle" alt="user">
                                            </a>
                                            <div class="iq-sub-dropdown iq-user-dropdown">
                                                <div class="iq-card shadow-none m-0">
                                                    <div class="iq-card-body p-0 pl-3 pr-3">
                                                        <a href="/DWProject/profile" class="iq-sub-card setting-dropdown">
                                                            <div class="media align-items-center">
                                                                <div class="right-icon">
                                                                    <i class="fa fa-user text-primary"></i>
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <h6 class="mb-0 ">Perfil</h6>
                                                                </div>
                                                            </div>
                                                        </a>


                                                        <a href="/DWProject/logoff" class="iq-sub-card setting-dropdown">
                                                            <div class="media align-items-center">
                                                                <div class="right-icon">
                                                                    <i class="fa fa-sign-out text-primary"></i>
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <h6 class="mb-0">Cerrar Sesión</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="navbar-right menu-right">
                            <ul class="d-flex align-items-center list-inline m-0">
                                <li class="nav-item nav-icon">
                                    <a href="#" class="search-toggle device-search">
                                        <i class="fa fa-search"></i>
                                    </a>
                                    <div class="search-box iq-search-bar d-search">
                                        <form action="/DWProject/search" method="POST" class="searchbox">
                                            <div class="form-group position-relative">
                                                <input type="text" name="busqueda"
                                                    class="text search-input font-size-12"
                                                    placeholder="Busca la pelicula por el titulo">
                                                <i class="search-link ri-search-line"></i>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item nav-icon">
                                    <a href="#" class="search-toggle" data-toggle="search-toggle">
                                        <i class="fa fa-bell"></i></a>
                                    <?php 
                                        
                                        $modelo = new ActionUsers();
                                        $novedades = $modelo->obtener_notificaciones();
                                        if(intval($novedades["total"])>0){
                                            echo "<span class='bg-danger dots'>".$novedades["total"]."</span>";
                                        }
                                 ?>
                                    <div class="iq-sub-dropdown">

                                        <?php 
                                        
                                        $modelo = new ActionUsers();
                                        $novedades = $modelo->leer_notificaciones();
                                        while ($dato = $novedades->fetch()){
                                            echo "
                                            <div class='iq-card shadow-none m-0'>
                                            <div class='iq-card-body'>
                                            <a href='#' id ='iq-sub-card_msg'>
                                                <div  class='media align-items-center '>
                                                    <img id = 'msg_img' src='/DWProject/public/img/sobre.png' class='img-fluid mr-3'alt='streamit' />
                                                    <div id = 'msg_txt' class='media-body'>
                                                        <h6  class='mb-0 '>Nuevo Mensaje</h6>
                                                        <small class='font-size-12'>Remitente: " . $dato['Usuario'] ."</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        </div>";
                                        }
                                    ?>


                                    </div>
                                </li>
                                <li class="nav-item nav-icon">
                                    <a href="#" class="iq-user-dropdown search-toggle p-0 d-flex align-items-center"
                                        data-toggle="search-toggle">
                                        <img id="NavFoto"
                                            src=<?php echo "/DWProject/public/img/users/". $GLOBALS['sq']->getfoto(); ?>
                                            class="img-fluid avatar-40 rounded-circle" alt="user">
                                    </a>
                                    <div class="iq-sub-dropdown iq-user-dropdown">
                                        <div class="iq-card shadow-none m-0">
                                            <div class="iq-card-body p-0 pl-3 pr-3">
                                                <a href="/DWProject/profile" class="iq-sub-card setting-dropdown">
                                                    <div class="media align-items-center">
                                                        <div class="right-icon">
                                                            <i class="fa fa-user text-primary"></i>
                                                        </div>
                                                        <div class="media-body ml-3">
                                                            <h6 class="mb-0 ">Perfil</h6>
                                                        </div>
                                                    </div>
                                                </a>


                                                <a href="/DWProject/logoff" class="iq-sub-card setting-dropdown">
                                                    <div class="media align-items-center">
                                                        <div class="right-icon">
                                                            <i class="fa fa-sign-out text-primary"></i>
                                                        </div>
                                                        <div class="media-body ml-3">
                                                            <h6 class="mb-0">Cerrar Sesión</h6>
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
                    <div class="nav-overlay"></div>
                </div>
            </div>
        </div>
    </div>
</header>