<?php require_once("server/models/MenuModel.php");?>
<form id="movies_form" <?php if($titulo === "Añadir Nueva Serie"){echo "action='/DWprojectAdmin/add_series'";}else{echo "action='/DWprojectAdmin/update_series'";}?> method="POST" >
    <div class="row">
        <div class="col-lg-7">
            <div class="row">
                <div class="col-12 form-group">
                <?php if($titulo === "Añadir Nueva Serie"){
                   
                    $modelo = new MenuModel();
                    $result = $modelo->obtener_id("IdMovie","Movies");
                    echo " <input type='text' class='form-control' name='id' value='".$result['id']."' readonly>";
                }else{
                    echo " <input type='text' class='form-control' name='id' value='".$datos['IdMovie']."' readonly>";
                }
                ?>
                </div>
                <div class="col-12 form-group">
                <?php if($titulo === "Añadir Nueva Serie"){
        
                        echo " <input type='text' class='form-control' name='nombre' placeholder='Titulo'  >";
                    }else{
                        echo " <input type='text' class='form-control' name='nombre' placeholder='Titulo' value='". $datos["Name"] ."' >";
                    }
                ?>
                </div>
                <div class="col-12  form-group">
                <?php if($titulo === "Añadir Nueva Serie"){
                        echo " <input type='text' class='form-control' name='trailler' placeholder='Enlace Trailler'  >";
                    }else{
                        echo " <input type='text' class='form-control' name='trailler' placeholder='Enlace Trailler' value='". $datos["Trailler"] ."' >";
                    }
                ?>
                
                </div>
                <div name="cat" class="col-md-6  form-group">
                    <select class="form-control" id="exampleFormControlSelect1">
                    <?php 
                    if($titulo === "Añadir Nueva Serie"){
                        
                        $modelo = new MenuModel();
                        $result = $modelo->rellena_cat("0");
                        echo "<option selected='selected' value =''>Elige una Categoria</option>" . $result;
                    }else{
                      
                        $modelo = new MenuModel();
                        $result = $modelo->rellena_cat($datos["CatDesc"]);
                        echo "<option value =''>Elige una Categoria</option>" . $result;
                    }
                    ?>
                    </select>
                </div>
                <div name="st" class="col-sm-6 form-group">
                    <select class="form-control" id="exampleFormControlSelect2">
                    <?php 
                    if($titulo === "Añadir Nueva Serie"){
                        
                        $modelo = new MenuModel();
                        $result = $modelo->rellena_estado("0");
                        echo "<option selected='selected' value =''>Elige un estado</option>" . $result;
                    }else{
                      
                        $modelo = new MenuModel();
                        $result = $modelo->rellena_estado($datos["StatusDesc"]);
                        echo "<option value =''>Elige un estado</option>" . $result;
                    }
                    ?>
                    </select>
                </div>
                <div name="sinopsis" class="col-12 form-group">
                    
                    <?php if($titulo === "Añadir Nueva Serie"){
                        echo " <textarea id='text' name='Sinopsis' rows='5' class='form-control' placeholder='Sinopsis'></textarea>";
                    }else{
                        echo "<textarea id='text' name='Sinopsis' rows='5' class='form-control' placeholder='Sinopsis'>". $datos["Sinopsis"] ."</textarea>";
                    }
                ?>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="d-block position-relative">
                <div class="form_video-upload"> 
                
                    <?php if($titulo === "Añadir Nueva Serie"){
                        echo "<img  class='Cover img-fluid' src='' alt='Foto de Portada'>";
                    }else{
                        echo "<img  class=' Cover img-fluid' src= '/DWprojectAdmin".$datos["Cover"]."' alt='profile-pic'>";
                    }
                    ?>
            
                    <div class="p-image" >  
                    <?php if($titulo === "Añadir Nueva Serie"){
                        echo "<i class='ri-image-line upload-Cover'></i>
                        <input class='Cover-upload' id='thefile' name='cover' type='file' value = ''/>";
                    }else{
                        echo "<i class='ri-image-line upload-Cover'></i>
                        <input class='Cover-upload' id='thefile' name='cover' type='file' value = '".$datos["Cover"]."'/>";
                    }
                    ?>
                        
                    </div>
               </div>
            </div>
        </div>
    </div>
    <div class="row">
    
        <div class="col-sm-6 form-group">
        <?php if($titulo === "Añadir Nueva Serie"){
                echo " <input type='text' name='detalles' class='form-control'  placeholder='Detalles'  >";
            }else{
                echo " <input type='text' name='detalles' class='form-control'  placeholder='Detalles' value='". $datos["Details"] ."' >";
            }
        ?>
        </div>
        <div class="col-sm-6 form-group">
        <?php if($titulo === "Añadir Nueva Serie"){
                echo " <input type='text' name='publicos' class='form-control'  placeholder='Autorización Publicos'  >";
            }else{
                echo " <input type='text' name='publicos' class='form-control'  placeholder='Autorización Publicos' value='". $datos["Age"] ."' >";
            }
        ?>
        </div>
        <div class="col-sm-12 form-group">
        <?php if($titulo === "Añadir Nueva Serie"){
                echo " <input type='text' name='duracion' class='form-control'  placeholder='Duración'  >";
            }else{
                echo " <input type='text' name='duracion' class='form-control'  placeholder='Duración' value='". $datos["Duration"] ." minutos' >";
            }
        ?>
        </div>
        <?php
            if($titulo != "Añadir Nueva Serie"){
              $valor = " <div class='col-md-12  form-group'>
                    <select name ='activo' class='form-control' id='exampleFormControlSelect1'> ";
                     if($datos["Active"]==="1"){
                        $valor = $valor . "<option selected value='1' class='option_success'>Activo</option>
                                            <option  value='2' class='option_primary'>Inactivo</option>";
                     }else{
                        $valor = $valor . "<option value='1' class='option_success'>Activo</option>
                                            <option value='2' selected class='option_primary'>Inactivo</option>";
                     }
                    $valor = $valor . " </select></div>";
                   
                echo $valor;
            }
        ?>
        
        <div class="col-12 form-group ">
            <button type="submit" class="btn btn-primary">Aceptar</button>
            <a href="/DWprojectAdmin/" class="btn btn-primary">Cancelar</a>
        </div>
    </div>
</form>