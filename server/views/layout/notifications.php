<form id= "user_form" action="/DWprojectAdmin/read_notification" method="POST">
    <div class="row">
        <div class="col-md-12 form-group">
            <input type="text" class="form-control" name="nombre" readonly 
                value="<?php echo $datos["emisor"] ?>">
            <input type="text" class="form-control" hidden name="id" value="<?php echo $datos["id"] ?>">
        </div>
        
        <div class="col-md-12 form-group">
        <input class="form-control " readonly name="date"  type="text"  
                value="<?php echo $datos["SendDate"] ?>">
        </div>
        <div class="col-md-12 form-group form-group">
        <textarea class="form-control" name="address" readonly rows="5" ><?php echo trim($datos["Message"]); ?></textarea>
        </div>
        
    <div class="row">
        <div class="col-12 form-group">
            <button type="submit" class="btn btn-primary">Leido</button>
            <a href="/DWprojectAdmin/" class="btn btn-primary">Cancelar</a>
        </div>
    </div>
</form>