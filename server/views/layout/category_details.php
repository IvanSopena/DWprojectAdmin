<form <?php if($titulo === "Añadir Categoria"){echo "action='DWprojectAdmin/new_category'";}else{echo "action='DWprojectAdmin/update_category'";}?> method="POST" >
    <div class="form-group">
        <input type="text" class="form-control" name="id" placeholder="Identificador (Solo Lectura)" readonly>
    </div>
    <div class="form-group">
    <input type="text" class="form-control" name="nombre" placeholder="Categoria" >
    </div>
    <div class="form-group">
    <input type="text" class="form-control" name="icono" placeholder="Icono" >
    </div>
    <div class=" form-group">
            <select class="form-control" name="Color" id="exampleFormControlSelect3">
                    <option selected='selected' value='0'>Seleccione un Color</option>
                    <option class="option_info" value='1'>Info</option>
                    <option class="option_success" value='2'>success</option>
                    <option class="option_primary" value='3'>primary</option>
                    <option class="option_warning" value='4'>warning</option>
            </select>
        </div>
    </div>
    <div class="form-group ">
        <button type="submit" class="btn btn-primary">Aceptar</button>
        <a href="/DWprojectAdmin/" class="btn btn-primary">Cancelar</a>
    </div>
</form>
