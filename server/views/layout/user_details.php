<form id= "user_form" action="/DWprojectAdmin/update_user" method="POST">
    <div class="row">
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" name="nombre" placeholder="Nombre"
                value="<?php echo $datos["Nombre"] ?>">
            <input type="text" class="form-control" hidden name="id" value="<?php echo $datos["Id"] ?>">
        </div>
        <div class="col-md-6 form-group">
            <input type="text" class="form-control" name="apellido" placeholder="Apellidos"
                value="<?php echo $datos["Apellidos"] ?>">
        </div>
        <div class="col-md-6 form-group">
            <input type="email" class="form-control" name="email" placeholder="Email"
                value="<?php echo $datos["Email"] ?>">
        </div>
        <div class="col-md-6 form-group form-group">
            <input class="form-control date-input  basicFlatpickr" name="date" placeholder="Nacimiento" type="text"
                value="<?php echo $datos["Nacimiento"] ?>">
        </div>
        <div class="col-md-6 form-group form-group">
            <input type="text" class="form-control" placeholder="Pais" name="pais" value="<?php echo $datos["Pais"] ?>">
        </div>
        <div class="col-md-6 form-group">
            <select class="form-control" name="plan" id="exampleFormControlSelect3">

                <?php
                switch ($datos["Plan"]) {
                    case "0":
                        echo "<option selected='selected' value='0'>Seleccione un Plan</option>
                        <option value='1'>Basico</option>
                        <option value='2'>Estandar</option>
                        <option value='3'>Platino</option>
                        <option value='4'>Premium</option>";
                    break;
                    case "1":
                        echo "<option  value='0'>Seleccione un Plan</option>
                        <option selected='selected' value='1'>Basico</option>
                        <option value='2'>Estandar</option>
                        <option value='3'>Platino</option>
                        <option value='4'>Premium</option>";
                    break;
                    case "2":
                        echo "<option  value='0'>Seleccione un Plan</option>
                        <option value='1'>Basico</option>
                        <option selected='selected' value='2'>Estandar</option>
                        <option value='3'>Platino</option>
                        <option value='4'>Premium</option>";
                    break;
                    case "3":
                        echo "<option  value='0'>Seleccione un Plan</option>
                        <option value='1'>Basico</option>
                        <option value='2'>Estandar</option>
                        <option selected='selected' value='3'>Platino</option>
                        <option value='4'>Premium</option>";
                    break;
                    case "4":
                        echo "<option  value='0'>Seleccione un Plan</option>
                        <option value='1'>Basico</option>
                        <option value='2'>Estandar</option>
                        <option value='3'>Platino</option>
                        <option selected='selected' value='4'>Premium</option>";
                    break;

                }
            ?>
            </select>
        </div>

        <div class="col-12 form-group">
            <select class="form-control" name="activo" id="exampleFormControlSelect3">

                <?php
            switch ($datos["Activo"]) {
                case "0":
                    echo "<option selected='selected' value='0'>Seleccione Estado</option>
                    <option value='1'>Activo</option>
                    <option value='2'>Inactivo</option>
                    ";
                break;
                case "1":
                    echo "<option  value='0'>Seleccione Estado</option>
                    <option selected='selected' value='1'>Activo</option>
                    <option value='2'>Inactivo</option>";
                break;
                case "2":
                    echo "<option  value='0'>Seleccione Estado</option>
                    <option  value='1'>Activo</option>
                    <option selected='selected' value='2'>Inactivo</option>";
                break;
            
            }
        ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-12 form-group">
            <button type="submit" class="btn btn-primary">Aceptar</button>
            <a href="/DWprojectAdmin/" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
</form>