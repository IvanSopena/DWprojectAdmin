<form id="status_form" <?php if($titulo === "Añadir Nuevo Estado"){echo "action='/DWprojectAdmin/add_status'";}else{echo "action='/DWprojectAdmin/update_status'";}?> method="POST" >
    
    <div class="form-group">
        <?php if($titulo === "Añadir Nuevo Estado"){
            require_once("server/models/MenuModel.php");
            $modelo = new MenuModel();
            $result = $modelo->obtener_id("IdStatus","StatusMovie");
            echo " <input type='text' class='form-control' name='id' value='".$result['id']."' readonly>";
        }else{
            echo " <input type='text' class='form-control' name='id' value='".$datos['IdStatus']."' readonly>";
        }
        ?>
    </div>
    <div class="form-group">
        <?php if($titulo === "Añadir Nuevo Estado"){
            
            echo " <input type='text' class='form-control' name='nombre' placeholder='Estado'  >";
        }else{
            echo " <input type='text' class='form-control' name='nombre' placeholder='Estado' value='". $datos["StatusDesc"] ."' >";
        }
        ?>
    </div>
    
    
    <div class="form-group ">
        <button type="submit" class="btn btn-primary">Aceptar</button>
        <a href="/DWprojectAdmin/" class="btn btn-primary">Cancelar</a>
    </div>
</form>
