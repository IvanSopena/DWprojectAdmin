<?php require_once("Template/header.php") ?>

<section class="sign-in-page">
   <div class="container">
  
      <div class="row justify-content-center align-items-center height-self-center">
         <div class="col-lg-5 col-md-12 align-self-center">
        
            <div class="sign-user_card ">  
           
               <div class="sign-in-page-data">
              
                  <div class="sign-in-from w-100 m-auto">
                  <h3 class="mb-3 text-center"> SISTEMA DE GESTIÓN DE PELICULAS </h3> 
                  
                     <form class="mt-4" action="/DWprojectAdmin/login" method="POST">
                        <div class="form-group">                                 
                           <input type="email" class="form-control mb-0" name="mail_user" id="email" placeholder="Email" autocomplete="off" required>
                        </div>
                        <div class="form-group">                                 
                           <input type="password" class="form-control mb-0" name="pass" id="pass" placeholder="Contraseña" required>
                        </div>
                        
                           <div class="sign-info">
                              <button type="submit" class="btn btn-hover">Acceder</button>
                                       
                           </div>                                    
                     </form>
                  </div>
               </div>
               <br>  
                  <div class="d-flex justify-content-center links">
                     <a href="/DWProject/reset_password" class="f-link">¿Has olvidado tu contraseña?</a>
                  </div>
               </div>
              
            </div>
            <?php
                    if (isset($GLOBALS['error'])) 
                    { 
                    
                        echo " <script>
                                       toastr.".$GLOBALS['type']."('".$GLOBALS['error']."','ERROR',{
                                          'closeButton': true,
                                          'preventDuplicates': false,
                                          'progressBar': false,
                                          'positionClass': 'toast-bottom-full-width'
                                    });
                                 </script>";
                        
                    }
            ?>                  
         </div>
      </div>

     
    
   </div>
</section>
    

<?php require_once("Template/footer.php") ?>

</body>

</html>