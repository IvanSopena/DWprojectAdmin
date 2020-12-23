<?php require_once("server/models/MenuModel.php");?>
<form id= "user_form" action="/DWprojectAdmin/send_notification" method="POST">
    <div class="row">
        <div class="col-md-12 form-group">
         <select name="user" class="form-control" id="exampleFormControlSelect2">
                    <?php 
                        $modelo = new MenuModel();
                        $result = $modelo->rellena_user();
                        echo "<option selected='selected' value =''>Elige un Usuario</option>" . $result;
                    ?>
          </select>
        </div>
        
        <div class="col-md-12 form-group">
            <select name="peli" class="form-control" id="exampleFormControlSelect2">
                        <?php 
                            $modelo = new MenuModel();
                            $result = $modelo->rellena_peli();
                            echo "<option selected='selected' value =''>Elige una Pelicula o Serie</option>" . $result;
                        ?>
            </select>
          </div>

        <div class="col-md-12 form-group ">
                <textarea class="form-control" name="message" placeholder='Mensaje' rows="5" ></textarea>
        </div>
        
    <div class="row">
        <div class="col-12 form-group">
            <button type="submit" class="btn btn-primary">Enviar</button>
            <a href="/DWprojectAdmin/" class="btn btn-primary">Cancelar</a>
        </div>
    </div>
</form>