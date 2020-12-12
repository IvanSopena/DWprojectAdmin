<form id="cat_form" <?php if($titulo === "Añadir Nueva Categoria"){echo "action='/DWprojectAdmin/new_category'";}else{echo "action='/DWprojectAdmin/update_category'";}?> method="POST" >
    <div class="form-group">
    <?php if($titulo === "Añadir Nueva Categoria"){
        require_once("server/models/MenuModel.php");
        $modelo = new MenuModel();
        $result = $modelo->obtener_id("IdCat","CategoryMovie");
        echo " <input type='text' class='form-control' name='id' value='".$result['id']."' readonly>";
    }else{
        echo " <input type='text' class='form-control' name='id' value='".$datos['IdCat']."' readonly>";
    }
    ?>
       
    </div>
    <div class="form-group">
    <?php if($titulo === "Añadir Nueva Categoria"){
        
        echo " <input type='text' class='form-control' name='nombre' placeholder='Categoria'  >";
    }else{
        echo " <input type='text' class='form-control' name='nombre' placeholder='Categoria' value='". $datos["CatDesc"] ."' >";
    }
    ?>
    
    </div>
    <div class="form-group">
    <?php if($titulo === "Añadir Nueva Categoria"){
        
        echo " <input type='text' class='form-control' name='icono' placeholder='Icono'  >";
    }else{
        echo " <input type='text' class='form-control' name='icono' placeholder='Icono' value='". $datos["Icon"] ."' >";
    }
    ?>
    </div>
    <div class=" form-group">
            <select class="form-control" name="Color" id="exampleFormControlSelect3">
            <?php
                
                 switch ($datos["Color"]) {
                    case "":
                        echo "<option selected='selected' value=''>Seleccione el Color</option>
                        <option class='option_info' value='info'>info</option>
                        <option class='option_success' value='success'>success</option>
                        <option class='option_primary' value='primary'>primary</option>
                        <option class='option_warning' value='warning'>warning</option>";
                        break;
                    case "info":
                         echo "<option  value=''>Seleccione el Color</option>
                         <option selected='selected' class='option_info' value='info'>Info</option>
                         <option class='option_success' value='success'>success</option>
                          <option class='option_primary' value='primary'>primary</option>
                          <option class='option_warning' value='warning'>warning</option>";
                          break;
                    case "success":
                        echo "<option  value=''>Seleccione el Color</option>
                        <option class='option_info' value='Info'>info</option>
                        <option selected='selected'class='option_success' value='success'>success</option>
                        <option class='option_primary' value='primary'>primary</option>
                        <option class='option_warning' value='warning'>warning</option>";
                        break;
                    case "primary":
                        echo "<option  value=''>Seleccione el Color</option>
                        <option class='option_info' value='Info'>info</option>
                        <option class='option_success' value='success'>success</option>
                        <option selected='selected' class='option_primary' value='primary'>primary</option>
                        <option class='option_warning' value='warning'>warning</option>";
                        break;
                    case "warning":
                        echo "<option  value=''>Seleccione el Color</option>
                        <option class='option_info' value='Info'>info</option>
                        <option class='option_success' value='success'>success</option>
                        <option class='option_primary' value='primary'>primary</option>
                        <option selected='selected' class='option_warning' value='warning'>warning</option>";
                         break;

                 }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group ">
        <button type="submit" class="btn btn-primary">Aceptar</button>
        <a href="/DWprojectAdmin/" class="btn btn-primary">Cancelar</a>
    </div>
</form>
