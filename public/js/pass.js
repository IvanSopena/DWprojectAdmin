window.addEventListener("load", function () {
    // icono para mostrar contraseña
    showPassword = document.querySelector('.show-password');
    showPassword.addEventListener('click', () => {
        // elementos input de tipo clave
        password1 = document.querySelector('.Password1');
        
    
        if (password1.type === "text") {
            password1.type = "password"
            showPassword.classList.remove('fa-eye-slash');
        } else {
            password1.type = "text"
            showPassword.classList.toggle("fa-eye-slash");
        }
    })

    showPassword2 = document.querySelector('.show-password2');
    showPassword2.addEventListener('click', () => {
        // elementos input de tipo clave
        password2 = document.querySelector('.Password2');
        
    
        if (password2.type === "text") {
            password2.type = "password"
            showPassword2.classList.remove('fa-eye-slash');
        } else {
            password2.type = "text"
            showPassword2.classList.toggle("fa-eye-slash");
        }
    })

    showPassword3 = document.querySelector('.show-password3');
    showPassword3.addEventListener('click', () => {
        // elementos input de tipo clave
        password3 = document.querySelector('.Password3');
        
    
        if (password3.type === "text") {
            password3.type = "password"
            showPassword3.classList.remove('fa-eye-slash');
        } else {
            password3.type = "text"
            showPassword3.classList.toggle("fa-eye-slash");
        }
    })


});

