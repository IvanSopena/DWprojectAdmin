
(function(jQuery) {



    "use strict";

    jQuery(document).ready(function() {

        /*---------------------------------------------------------------------
        Tooltip
        -----------------------------------------------------------------------*/
        jQuery('[data-toggle="popover"]').popover();
        jQuery('[data-toggle="tooltip"]').tooltip();

        /*---------------------------------------------------------------------
        Magnific Popup
        -----------------------------------------------------------------------*/
        jQuery('.popup-gallery').magnificPopup({
            delegate: 'a.popup-img',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function(item) {
                    return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
                }
            }
        });
        jQuery('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });


        /*---------------------------------------------------------------------
        Ripple Effect
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', ".iq-waves-effect", function(e) {
            // Remove any old one
            jQuery('.ripple').remove();
            // Setup
            let posX = jQuery(this).offset().left,
                posY = jQuery(this).offset().top,
                buttonWidth = jQuery(this).width(),
                buttonHeight = jQuery(this).height();

            // Add the element
            jQuery(this).prepend("<span class='ripple'></span>");


            // Make it round!
            if (buttonWidth >= buttonHeight) {
                buttonHeight = buttonWidth;
            } else {
                buttonWidth = buttonHeight;
            }

            // Get the center of the element
            let x = e.pageX - posX - buttonWidth / 2;
            let y = e.pageY - posY - buttonHeight / 2;


            // Add the ripples CSS and start the animation
            jQuery(".ripple").css({
                width: buttonWidth,
                height: buttonHeight,
                top: y + 'px',
                left: x + 'px'
            }).addClass("rippleEffect");
        });

       /*---------------------------------------------------------------------
        Sidebar Widget
        -----------------------------------------------------------------------*/
       
        jQuery(document).on("click", '.iq-menu > li > a', function() {
            jQuery('.iq-menu > li > a').parent().removeClass('active');
            jQuery(this).parent().addClass('active');
        });
       
        /*---------------------------------------------------------------------
        Page FAQ
        -----------------------------------------------------------------------*/
        jQuery('.iq-accordion .iq-accordion-block .accordion-details').hide();
        jQuery('.iq-accordion .iq-accordion-block:first').addClass('accordion-active').children().slideDown('slow');
        jQuery(document).on("click", '.iq-accordion .iq-accordion-block', function() {
            if (jQuery(this).children('div.accordion-details ').is(':hidden')) {
                jQuery('.iq-accordion .iq-accordion-block').removeClass('accordion-active').children('div.accordion-details ').slideUp('slow');
                jQuery(this).toggleClass('accordion-active').children('div.accordion-details ').slideDown('slow');
            }
        });
        
        /*---------------------------------------------------------------------
        Page Loader
        -----------------------------------------------------------------------*/
        jQuery("#load").fadeOut();
        jQuery("#loading").delay().fadeOut("");

        

       /*---------------------------------------------------------------------
       Owl Carousel
       -----------------------------------------------------------------------*/
        jQuery('.owl-carousel').each(function() {
            let jQuerycarousel = jQuery(this);
            jQuerycarousel.owlCarousel({
                items: jQuerycarousel.data("items"),
                loop: jQuerycarousel.data("loop"),
                margin: jQuerycarousel.data("margin"),
                nav: jQuerycarousel.data("nav"),
                dots: jQuerycarousel.data("dots"),
                autoplay: jQuerycarousel.data("autoplay"),
                autoplayTimeout: jQuerycarousel.data("autoplay-timeout"),
                navText: ["<i class='fa fa-angle-left fa-2x'></i>", "<i class='fa fa-angle-right fa-2x'></i>"],
                responsiveClass: true,
                responsive: {
                    // breakpoint from 0 up
                    0: {
                        items: jQuerycarousel.data("items-mobile-sm"),
                        nav: false,
                        dots: true
                    },
                    // breakpoint from 480 up
                    480: {
                        items: jQuerycarousel.data("items-mobile"),
                        nav: false,
                        dots: true
                    },
                    // breakpoint from 786 up
                    786: {
                        items: jQuerycarousel.data("items-tab")
                    },
                    // breakpoint from 1023 up
                    1023: {
                        items: jQuerycarousel.data("items-laptop")
                    },
                    1199: {
                        items: jQuerycarousel.data("items")
                    }
                }
            });
        });

        /*---------------------------------------------------------------------
        Search input
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', function(e) {
            let myTargetElement = e.target;
            let selector, mainElement;
            if (jQuery(myTargetElement).hasClass('search-toggle') || jQuery(myTargetElement).parent().hasClass('search-toggle') || jQuery(myTargetElement).parent().parent().hasClass('search-toggle')) {
                if (jQuery(myTargetElement).hasClass('search-toggle')) {
                    selector = jQuery(myTargetElement).parent();
                    mainElement = jQuery(myTargetElement);
                } else if (jQuery(myTargetElement).parent().hasClass('search-toggle')) {
                    selector = jQuery(myTargetElement).parent().parent();
                    mainElement = jQuery(myTargetElement).parent();
                } else if (jQuery(myTargetElement).parent().parent().hasClass('search-toggle')) {
                    selector = jQuery(myTargetElement).parent().parent().parent();
                    mainElement = jQuery(myTargetElement).parent().parent();
                }
                if (!mainElement.hasClass('active') && jQuery(".navbar-list li").find('.active')) {
                    jQuery('.navbar-list li').removeClass('iq-show');
                    jQuery('.navbar-list li .search-toggle').removeClass('active');
                }

                selector.toggleClass('iq-show');
                mainElement.toggleClass('active');

                e.preventDefault();
            } else if (jQuery(myTargetElement).is('.search-input')) {} else {
                jQuery('.navbar-list li').removeClass('iq-show');
                jQuery('.navbar-list li .search-toggle').removeClass('active');
            }
        });

        /*---------------------------------------------------------------------
        Scrollbar
        -----------------------------------------------------------------------*/
        let Scrollbar = window.Scrollbar;
        if (jQuery('#sidebar-scrollbar').length) {
            Scrollbar.init(document.querySelector('#sidebar-scrollbar'), options);
        }
        let Scrollbar1 = window.Scrollbar;
        if (jQuery('#right-sidebar-scrollbar').length) {
            Scrollbar1.init(document.querySelector('#right-sidebar-scrollbar'), options);
        }



        /*---------------------------------------------------------------------
        Counter
        -----------------------------------------------------------------------*/
        jQuery('.counter').counterUp({
            delay: 10,
            time: 1000
        });

        /*---------------------------------------------------------------------
        slick
        -----------------------------------------------------------------------*/
        jQuery('.slick-slider').slick({
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 9,
            slidesToScroll: 1,
            focusOnSelect: true,
            responsive: [{
                breakpoint: 992,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '30',
                    slidesToShow: 3
                }
            }, {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '15',
                    slidesToShow: 1
                }
            }],
            nextArrow: '<a href="#" class="ri-arrow-left-s-line left"></a>',
            prevArrow: '<a href="#" class="ri-arrow-right-s-line right"></a>',
        });
      
        jQuery('.top-rated-item').slick({
            slidesToShow: 4,
            speed: 300,
            slidesToScroll: 1,
            focusOnSelect: true,
             appendArrows: $('#top-rated-item-slick-arrow'),
            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3
                }
            },{
                breakpoint: 798,
                settings: {
                    slidesToShow: 2
                }
            },{
                breakpoint: 480,
                settings: {
                    arrows: false,
                    autoplay:true,
                    slidesToShow: 1
                }
            }],
        });

        $('#newrealease-slider').slick({
          dots: false,
          arrows: false,
          infinite: true,
          speed: 300,
          centerMode: true,
          centerPadding: false,
          variableWidth: true ,
          infinite: true,
          focusOnSelect: true,
          autoplay: false,
          slidesToShow: 7,
          slidesToScroll: 1,
          
          
        });

       $("#newrealease-slider .slick-active.slick-center").prev('.slick-active').addClass('temp');
        $("#newrealease-slider .slick-active.temp").prev().addClass('temp-1');
        $("#newrealease-slider .slick-active.temp-1").prev().addClass('temp-2');

         $("#newrealease-slider .slick-active.slick-center").next('.slick-active').addClass('temp-next');
        $("#newrealease-slider .slick-active.temp-next").next().addClass('temp-next-1');
        $("#newrealease-slider .slick-active.temp-next-1").next().addClass('temp-next-2');

         $("#newrealease-slider").on("afterChange", function (){
          var slick_index = $(".slick-active.slick-center").data('slick-index');
          
          $('#newrealease-slider .slick-active[data-slick-index="'+(slick_index-1)+'"]').addClass('temp');
          $('#newrealease-slider .slick-active[data-slick-index="'+(slick_index-2)+'"]').addClass('temp-1');
          $('#newrealease-slider .slick-active[data-slick-index="'+(slick_index-3)+'"]').addClass('temp-2');

          $('#newrealease-slider .slick-active[data-slick-index="'+(parseInt(slick_index+1))+'"]').addClass('temp-next');
          $('#newrealease-slider .slick-active[data-slick-index="'+(parseInt(slick_index+2))+'"]').addClass('temp-next-1');
          $('#newrealease-slider .slick-active[data-slick-index="'+(parseInt(slick_index+3))+'"]').addClass('temp-next-2');


        });

        $("#newrealease-slider").on("beforeChange", function (){
          var slick_index = $(".slick-active.slick-center").data('slick-index');
          
          $('#newrealease-slider .slick-active[data-slick-index="'+(slick_index-1)+'"]').removeClass('temp');
          $('#newrealease-slider .slick-active[data-slick-index="'+(slick_index-2)+'"]').removeClass('temp-1');
          $('#newrealease-slider .slick-active[data-slick-index="'+(slick_index-3)+'"]').removeClass('temp-2');

          $('#newrealease-slider .slick-active[data-slick-index="'+(parseInt(slick_index+1))+'"]').removeClass('temp-next');
          $('#newrealease-slider .slick-active[data-slick-index="'+(parseInt(slick_index+2))+'"]').removeClass('temp-next-1');
          $('#newrealease-slider .slick-active[data-slick-index="'+(parseInt(slick_index+3))+'"]').removeClass('temp-next-2');

        });

        $('#favorites-slider').slick({
          dots: false,
          arrows: false,
          infinite: true,
          speed: 300,
          centerMode: false,
          autoplay: true,
          slidesToShow: 3,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
              }
            },
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
        });

        $('#similar-slider').slick({
          dots: false,
          arrows: false,
          infinite: true,
          speed: 300,
          centerMode: false,
          autoplay: true,
          slidesToShow: 4,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 576,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
        });

        $('#single-similar-slider').slick({
          dots: false,
          arrows: false,
          infinite: true,
          speed: 300,
          centerMode: false,
          autoplay: true,
          slidesToShow: 3,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 576,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
        });

        $('#trendy-slider').slick({
          dots: false,
          arrows: false,
          infinite: true,
          speed: 300,
          centerMode: false,
          autoplay: true,
          slidesToShow: 4,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 576,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
        });

        $('#description-slider').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          fade: true,
          asNavFor: '#description-slider-nav'
        });

        $('#description-slider-nav').slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          asNavFor: '#description-slider',
          dots: false,
          arrows: false,
          infinite: true,
          vertical: true,
          centerMode: false,
          focusOnSelect: true
        });

       /*---------------------------------------------------------------------
      Select 2 Dropdown
    -----------------------------------------------------------------------*/


   if (jQuery('select').hasClass('season-select')) {

        jQuery('select').select2({
          theme: 'bootstrap4',
          allowClear: false 
        });
      }
   


        /*---------------------------------------------------------------------
        Progress Bar
        -----------------------------------------------------------------------*/
        jQuery('.iq-progress-bar > span').each(function() {
            let progressBar = jQuery(this);
            let width = jQuery(this).data('percent');
            progressBar.css({
                'transition': 'width 2s'
            });

            setTimeout(function() {
                progressBar.appear(function() {
                    progressBar.css('width', width + '%');
                });
            }, 100);
        });


        /*---------------------------------------------------------------------
        Page Menu
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', '.wrapper-menu', function() {
            jQuery(this).toggleClass('open');
        });

        jQuery(document).on('click', ".wrapper-menu", function() {
            jQuery("body").toggleClass("sidebar-main");
        });
        


        /*---------------------------------------------------------------------
        Wow Animation
        -----------------------------------------------------------------------*/
        let wow = new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 0,
            mobile: false,
            live: true
        });
        wow.init();


        
        /*---------------------------------------------------------------------
        Form Validation
        -----------------------------------------------------------------------*/

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);

      /*---------------------------------------------------------------------
       Active Class for Pricing Table
       -----------------------------------------------------------------------*/
      jQuery("#my-table tr th").click(function () {
        jQuery('#my-table tr th').children().removeClass('active');
        jQuery(this).children().addClass('active');
        jQuery("#my-table td").each(function () {
          if (jQuery(this).hasClass('active')) {
            jQuery(this).removeClass('active')
          }
        });
        var col = jQuery(this).index();
        jQuery("#my-table tr td:nth-child(" + parseInt(col + 1) + ")").addClass('active');
      });

        /*------------------------------------------------------------------
        Flatpicker
        * -----------------------------------------------------------------*/
      if (jQuery('.date-input').hasClass('basicFlatpickr')) {
          jQuery('.basicFlatpickr').flatpickr();
          jQuery('#inputTime').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
          });
          jQuery('#inputDatetime').flatpickr({
            enableTime: true
          });
          jQuery('#inputWeek').flatpickr({            
            weekNumbers: true
          });          
      }
        
        /*---------------------------------------------------------------------
           Scroll up menu
        -----------------------------------------------------------------------*/
        var position = $(window).scrollTop();
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            //  console.log(scroll);
            
            if(scroll < position) {
                 $('.tab-menu-horizontal').addClass('menu-up');
                 $('.tab-menu-horizontal').removeClass('menu-down');
            } 
            else {
                $('.tab-menu-horizontal').addClass('menu-down');
                $('.tab-menu-horizontal').removeClass('menu-up');
            }
            if(scroll == 0)
            {
                $('.tab-menu-horizontal').removeClass('menu-up');
                $('.tab-menu-horizontal').removeClass('menu-down');
            }
            position = scroll;
        });


        /*---------------------------------------------------------------------
           checkout
        -----------------------------------------------------------------------*/

        jQuery(document).ready(function(){
            jQuery('#place-order').click(function(){
                jQuery('#cart').removeClass('show');
                jQuery('#address').addClass('show');
            });
            jQuery('#deliver-address').click(function(){
                jQuery('#address').removeClass('show');
                jQuery('#payment').addClass('show');
            });
        });

         /*---------------------------------------------------------------------
           Datatables
        -----------------------------------------------------------------------*/
        if(jQuery('.data-tables').length)
        {
          $('.data-tables').DataTable({
            language: {
                "emptyTable": "No hay información",
                "search": "Buscar:",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "paginate": {
                  "first": "Primero",
                  "last": "Ultimo",
                  "next": "Siguiente",
                  "previous": "Anterior"
              }
            }
          });
        }



        /************************************************************
         Data Table users Actions 
         **************************************************************/
        $("#tabla_u").on("click", "#edit", function () {
          let thisrow = $(this).closest("tr");
          let dato = thisrow.find("td:eq(0)").text();
          var tipo = $('#titulo').val();
         
           if(tipo == 1){ //Usuarios
            window.location.href = "/DWprojectAdmin/details" + "?id=" + dato;
           }
           if(tipo == 4){//Peliculas
            window.location.href = "/DWprojectAdmin/edit_movies" + "?id=" + dato;
           }
           if(tipo == 5){
            window.location.href = "/DWprojectAdmin/edit_series" + "?id=" + dato;
           }
           if(tipo == 2){ //Categorias
            window.location.href = "/DWprojectAdmin/edit_category" + "?id=" + dato;
           }
           if(tipo == 3){ //Estados
            window.location.href = "/DWprojectAdmin/edit_status" + "?id=" + dato;
           }
           
          
        });
        $("#tabla_u").on("click", "#del", function () {
          let thisrow = $(this).closest("tr");
          let dato = thisrow.find("td:eq(0)").text();
          var tipo = $('#titulo').val();
         
           if(tipo == 1){
            window.location.href = "/DWprojectAdmin/delete_user" + "?id=" + dato;
           }
           if(tipo == 4){//Peliculas
            window.location.href = "/DWprojectAdmin/delete_movies" + "?id=" + dato;
           }
           if(tipo == 5){
            window.location.href = "/DWprojectAdmin/delete_series" + "?id=" + dato;
           } //Series
           if(tipo == 2){
            window.location.href = "/DWprojectAdmin/delete_category" + "?id=" + dato;
           }
           if(tipo == 3){
            window.location.href = "/DWprojectAdmin/delete_status" + "?id=" + dato;
           }
           
        });

    
       
        /*---------------------------------------------------------------------
        Button 
        -----------------------------------------------------------------------*/

        jQuery('.qty-btn').on('click',function(){
          var id = jQuery(this).attr('id');

          var val = parseInt(jQuery('#quantity').val());

          if(id == 'btn-minus')
          {
            if(val != 0)
            {
              jQuery('#quantity').val(val-1);
            }
            else
            {
              jQuery('#quantity').val(0);
            }

          }
          else
          {
            jQuery('#quantity').val(val+1);
          }
        });

        
    });

  /*---------------------------------------------------------------------
    Validacion
  -----------------------------------------------------------------------*/
  $().ready(function() {
    $("#data_user").validate({
      rules: {
        name:{
          required: true,
					minlength: 2
        },
        surname:{
          required: true,
					minlength: 2
        },
        email:{
          required: true,
					email: true
        },
        city:{
          required: true,
					minlength: 2
        },
        date: {
          required: true
        },
        customRadio1:{
          required: true
        },
        job:{
          required: true
        },
        country:{
          required: true
        },
        address:{
          required: true,
          minlength: 5/* ,
          maxlength: 30 */
        
        }
        
      },
      messages: {
        name: {
					required: "El campo Nombre es obligatorio",
					minlength: "El campo de Nombre no puede ser inferior a 2 caracteres"
        },
        surname: {
					required: "El campo Apellidos es obligatorio",
					minlength: "El campo de Apellidos no puede ser inferior a 2 caracteres"
        },
        email: "Debe poner una dirección de correo electronico valida",
        city: {
					required: "El campo Ciudad es obligatorio",
					minlength: "El campo de Ciudad no puede ser inferior a 2 caracteres"
        },
        date: {
					required: "El campo Fecha de Nacimiento es obligatorio"
        },
        customRadio1: {
					required: "<br/> Debe elegir su genero."
        },
        job: {
					required: "<br/>Debe elegir su puesto de trabajo."
        },
        country: {
					required: "<br/>Debe elegir su país."
        },
        address: {
          required: "Este campo es obligatorio,por favor introduce una dirección. 5-30 caracteres",
           minlength: "Este campo no puede ser inferior a 5 caracteres."/* ,
          maxlength: "Este campo no puede ser superior a 30 caracteres." */
        },
      },
    
    
    });

    $("#pass_form").validate({
      rules: {
        pass: {
          required: true,
          minlength: 8
        },
        validate: {
          required: true,
          minlength: 8,
          equalTo: "#npass"
        }
        
      },
      messages: {
        
        pass: {
          required: "Por favor introduce una contraseña",
          minlength: "La contraseña debe de ser al menos de 8 caracteres"
        },
        validate: {
          required: "Por favor introduce una contraseña",
          minlength: "La contraseña debe de ser al menos de 8 caracteres",
          equalTo: "Las contraseñas no coinciden,por favor reviselas antes de continuar"
         
        },

       }
      } );

      $("#user_form").validate({
        rules: {
          nombre:{
            required: true,
            minlength: 2
          },
          apellido:{
            required: true,
            minlength: 2
          },
          email:{
            required: true,
            email: true
          },
          
          date: {
            required: true
          },
          
          plan:{
            required: true
          },
          pais:{
            required: true,
            minlength: 2
          },
          activo:{
            required: true
          }
          
        },
        messages: {
          nombre: {
            required: "El campo Nombre es obligatorio",
            minlength: "El campo de Nombre no puede ser inferior a 2 caracteres"
          },
          apellido: {
            required: "El campo Apellidos es obligatorio",
            minlength: "El campo de Apellidos no puede ser inferior a 2 caracteres"
          },
          email: "Debe poner una dirección de correo electronico valida",
          pais: {
            required: "El campo Pais es obligatorio",
            minlength: "El campo de Pais no puede ser inferior a 2 caracteres"
          },
          date: {
            required: "El campo Fecha de Nacimiento es obligatorio"
          },
          
          plan: {
            required: "<br/>Debe elegir el plan del cliente."
          },
          activo: {
            required: "<br/>Debe elegir el estado."
          },
          
        },
      
      
      });

      $("#cat_form").validate({
        rules: {
          nombre:{
            required: true,
            minlength: 2
          },
          icono:{
            required: true,
            minlength: 2
          },
          Color:{
            required: true
          }
        },
        messages: {
          nombre: {
            required: "El campo Nombre es obligatorio",
            minlength: "El campo de Nombre no puede ser inferior a 2 caracteres"
          },
          icono: {
            required: "El campo Icono es obligatorio",
            minlength: "El campo de Icono no puede ser inferior a 2 caracteres"
          },
          Color: {
            required: "<br/>Debe elegir un color para indicar la categoria."
          }
        },
      });

      $("#status_form").validate({
        rules: {
          nombre:{
            required: true,
            minlength: 2
          }
        },
        messages: {
          nombre: {
            required: "El campo Nombre es obligatorio",
            minlength: "El campo de Nombre no puede ser inferior a 2 caracteres"
          }
        },
      });

      $("#movies_form").validate({
        rules: {
          nombre:{
            required: true,
            minlength: 2
          },
          trailler:{
            required: true,
            url: true
          },
          cat:{
            required: true
          },
          st:{
            required: true
          },
          Sinopsis:{
            required: true,
            minlength: 5//,
            //maxlength:100
          
          },
          detalles:{
            required: true,
            minlength: 2
          },
          publicos:{
            required: true,
            minlength: 1
          },
          duracion:{
            required: true,
            minlength: 1
          },
          /* cover:{
            required: true
          } */
        },
        messages: {
          nombre: {
            required: "El campo Titulo es obligatorio",
            minlength: "El campo de Titulo no puede ser inferior a 2 caracteres"
          },
          trailler: "Debe poner una dirección url valida",
          cat: {
            required: "<br/>Debe elegir una Categoria para indicar la categoria."
          },
          st: {
            required: "<br/>Debe elegir un Estado para indicar la categoria."
          },
          Sinopsis: {
            required: "Este campo es obligatorio,por favor introduce la sinopsis. MAX 100 caracteres",
             minlength: "Este campo no puede ser inferior a 5 caracteres."/* ,
             maxlength: "Se han excedido los 100 caracteres." */
          },
          detalles: {
            required: "El campo Titulo es obligatorio",
            minlength: "El campo de Titulo no puede ser inferior a 2 caracteres"
          },
          publicos: {
            required: "El campo Titulo es obligatorio",
            minlength: "El campo de Titulo no puede ser inferior a 2 caracteres"
          },
          duracion: {
            required: "El campo Titulo es obligatorio",
            minlength: "El campo de Titulo no puede ser inferior a 2 caracteres"
          },
          /* cover: {
            required: "Por favor introduce una portada.",
            
          } */
        },
      });


  });
  



})(jQuery);