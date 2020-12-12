<form <?php if($titulo === "Añadir Nueva Pelicula"){echo "action='/DWprojectAdmin/add_movies'";}else{echo "action='/DWprojectAdmin/update_movies'";}?> method="POST" >
    <div class="row">
        <div class="col-lg-7">
            <div class="row">
                <div class="col-12 form-group">
                <?php if($titulo === "Añadir Nueva Pelicula"){
                    require_once("server/models/MenuModel.php");
                    $modelo = new MenuModel();
                    $result = $modelo->obtener_id("IdMovie","Movies");
                    echo " <input type='text' class='form-control' name='id' value='".$result['id']."' readonly>";
                }else{
                    echo " <input type='text' class='form-control' name='id' value='".$datos['IdMovie']."' readonly>";
                }
                ?>
                </div>
                <div class="col-12 form-group">
                <?php if($titulo === "Añadir Nueva Pelicula"){
        
                        echo " <input type='text' class='form-control' name='nombre' placeholder='Titulo'  >";
                    }else{
                        echo " <input type='text' class='form-control' name='nombre' placeholder='Titulo' value='". $datos["Name"] ."' >";
                    }
                ?>
                </div>
                <div class="col-12  form-group">
                <?php if($titulo === "Añadir Nueva Pelicula"){
                        echo " <input type='text' class='form-control' name='nombre' placeholder='Enlace Trailler'  >";
                    }else{
                        echo " <input type='text' class='form-control' name='nombre' placeholder='Enlace Trailler' value='". $datos["Name"] ."' >";
                    }
                ?>
                
                </div>
                <div class="col-md-6 form-group">
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option select="">Categoria</option>
                        <option>Comedy</option>
                        <option>Crime</option>
                        <option>Drama</option>
                        <option>Horror</option>
                        <option>Romance</option>
                    </select>
                </div>
                <div class="col-sm-6 form-group">
                    <select class="form-control" id="exampleFormControlSelect2">
                        <option select="">Estado</option>
                        <option>FULLHD</option>
                        <option>HD</option>
                    </select>
                </div>
                <div class="col-12 form-group">
                    
                    <?php if($titulo === "Añadir Nueva Pelicula"){
                        echo " <textarea id='text' name='text' rows='5' class='form-control' placeholder='Sinopsis'></textarea>";
                    }else{
                        echo "<textarea id='text' name='text' rows='5' class='form-control' placeholder='Sinopsis'>". $datos["Name"] ."</textarea>";
                    }
                ?>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="d-block position-relative">
            <div class="form_video-upload">
                <?php if($titulo === "Añadir Nueva Pelicula"){
                    echo "<img id='FotoPerfil' class='img-fluid' src='' alt='Foto de Portada'>";
                }else{
                    echo "<img id='FotoPerfil' class='img-fluid' src='".$datos["Cover"]."' alt='profile-pic'>";
                }
                ?>
            </div>
                <div class="p-image">
                    <i class="ri-image-line upload-button"></i>
                    <input class="file-upload" id="thefile" name="thefile" type="file" value = ""/>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    
        <div class="col-sm-6 form-group">
        <?php if($titulo === "Añadir Nueva Pelicula"){
                echo " <input type='text' class='form-control' name='nombre' placeholder='Detalles'  >";
            }else{
                echo " <input type='text' class='form-control' name='nombre' placeholder='Detalles' value='". $datos["Name"] ."' >";
            }
        ?>
        </div>
        <div class="col-sm-6 form-group">
        <?php if($titulo === "Añadir Nueva Pelicula"){
                echo " <input type='text' class='form-control' name='nombre' placeholder='Autorización Publicos'  >";
            }else{
                echo " <input type='text' class='form-control' name='nombre' placeholder='Autorización Publicos' value='". $datos["Name"] ."' >";
            }
        ?>
        </div>
        <div class="col-sm-12 form-group">
        <?php if($titulo === "Añadir Nueva Pelicula"){
                echo " <input type='text' class='form-control' name='nombre' placeholder='Duración'  >";
            }else{
                echo " <input type='text' class='form-control' name='nombre' placeholder='Duración' value='". $datos["Name"] ."' >";
            }
        ?>
        </div>
        <div class="col-12 form-group ">
            <button type="submit" class="btn btn-primary">Aceptar</button>
            <a href="/DWprojectAdmin/" class="btn btn-primary">Cancelar</a>
        </div>
    </div>
</form>