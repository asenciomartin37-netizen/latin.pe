<?php
   /*
   	Sound Class :  clase que controla el diseño y funcionamiento
   	de la mayor parte de la web.
   	Header,footer, cuerpo y algunas consultas de la web */
   
   class Sound {
       private $c = array();
   
   	public function Sound( $c ) {
   		$this->c = $c;
   	}
   
   	public function header() {
   
?>
<?php sendNoCacheHeaders(); ?>
<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="UTF-8">
      <title><?php echo TITULO ?></title>
      <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
      <meta http-equiv="Pragma" content="no-cache">
      <meta http-equiv="Expires" content="0">
      <base href="<?php echo URL; ?>">
      <!-- responsive meta -->
       <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
       <link rel="preconnect" href="https://fonts.googleapis.com">
       <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
       <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
       <!-- For IE -->
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- master stylesheet -->
      <link rel="stylesheet" href="<?php info('css');?>style.css?v=20260831b">
      <!-- home stylesheet -->
      <link rel="stylesheet" href="<?php info('css');?>home.css?v=20260831b">
      <!-- Modern header stylesheet -->
        <link rel="stylesheet" href="<?php info('css');?>header-modern.css?v=20260831e">
       <!-- Responsive stylesheet (MUST be last) -->
        <link rel="stylesheet" href="<?php info('css');?>responsive.css?v=20260831d">
      <!-- Favicon -->
      <link rel="apple-touch-icon" sizes="180x180" href="<?php info('favicons');?>apple-touch-icon.png">
      <link rel="icon" type="image/png" href="<?php info('favicons');?>favicon-32x32.png" sizes="32x32">
      <link rel="icon" type="image/png" href="<?php info('favicons');?>favicon-16x16.png" sizes="16x16">
      <meta name="google-adsense-account" content="ca-pub-6305290560524331">
      <!-- Fixing Internet Explorer-->
      <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
      <script src="<?php info('js');?>html5shiv.js"></script>
      <![endif]-->
   </head>
   <body style="margin:0;padding:0;">
      <div class="boxed_wrapper" style="margin:0;padding:0;">

         <!-- Floating WhatsApp (única entrada, sin duplicados) -->
         <div class="h-wa-float" id="hWaFloat" title="Escríbenos por WhatsApp">
            <i class="fa fa-whatsapp" aria-hidden="true"></i>
         </div>
         <div class="h-wa-pop" id="hWaPop">
            <span class="h-wa-close" id="hWaClose">&times;</span>
            <h4>¿En qué podemos ayudarte?</h4>
            <a class="h-wa-opt o-rrhh"   href="https://wa.me/51974299089?text=Hola%20Recursos%20Humanos" target="_blank"><i class="fa fa-user" aria-hidden="true"></i> Recursos Humanos</a>
            <a class="h-wa-opt o-soporte" href="https://wa.me/51948327717?text=Hola%20Soporte%20Técnico" target="_blank"><i class="fa fa-wrench" aria-hidden="true"></i> Soporte Técnico</a>
            <a class="h-wa-opt o-ventas"  href="https://wa.me/51944138229?text=Hola%20Área%20Comercial" target="_blank"><i class="fa fa-briefcase" aria-hidden="true"></i> Ventas / Comercial</a>
            <a class="h-wa-opt o-factu"   href="https://wa.me/51944138229?text=Hola%20Área%20Facturación" target="_blank"><i class="fa fa-credit-card" aria-hidden="true"></i> Facturación</a>
         </div>

         <!-- Modern Header -->
         <header class="site-header" id="siteHeader">
            <!-- Main bar -->
            <div class="h-mainbar">
               <div class="h-container">
                  <a class="h-logo" href="<?php info('url');?>">
                     <img src="<?php info('url');?>images/logo.png" alt="Latin">
                  </a>

                  <button class="h-nav-toggle" id="hNavToggle" aria-label="Menú" aria-expanded="false">
                     <span></span><span></span><span></span>
                  </button>

                  <nav class="h-nav" id="hNav">
                     <ul>
                        <li class="<?php if (($_GET['modo'] ?? '') == "") echo " current"; ?>">
                           <a href="<?php info('url');?>">Inicio</a>
                        </li>
                        <li class="<?php if (($_GET['modo'] ?? '') == "planesduo") echo " current"; ?>">
                           <a href="<?php info('url');?>?modo=planesduo">Dúos</a>
                        </li>
                        <li class="<?php if (($_GET['modo'] ?? '') == "internetilimitado") echo " current"; ?>">
                           <a href="<?php info('url');?>?modo=internetilimitado">Internet</a>
                        </li>
                        <li class="<?php if (($_GET['modo'] ?? '') == "guiadecanales") echo " current"; ?>">
                           <a href="<?php info('url');?>?modo=guiadecanales">TV Digital</a>
                        </li>
                        <li class="<?php if (($_GET['modo'] ?? '') == "formaspago") echo " current"; ?>">
                           <a href="<?php info('url');?>?modo=formaspago">Formas de Pago</a>
                        </li>
                        <li class="<?php if (($_GET['modo'] ?? '') == "contacto") echo " current"; ?>">
                           <a href="<?php info('url');?>?modo=contacto">Contacto</a>
                        </li>
                     </ul>
                  </nav>

                  <div class="h-right">
                     <div class="h-tb-social">
                        <a href="#" aria-label="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                     </div>
                      <a class="h-cta" href="tel:016805680">
                         <i class="fa fa-phone" aria-hidden="true"></i>
                         <span class="h-cta-txt">(01) 680-5680</span>
                      </a>
                   </div>
               </div>
             </div>
          </header>
<script>
(function () {
   var header   = document.getElementById('siteHeader');
   var toggle   = document.getElementById('hNavToggle');
   var nav      = document.getElementById('hNav');
   var waFloat  = document.getElementById('hWaFloat');
   var waPop    = document.getElementById('hWaPop');
   var waClose  = document.getElementById('hWaClose');

   window.addEventListener('scroll', function () {
      header.classList.toggle('is-scrolled', window.scrollY > 10);
   });

   toggle.addEventListener('click', function () {
      var open = nav.classList.toggle('is-open');
      toggle.classList.toggle('is-open', open);
      toggle.setAttribute('aria-expanded', open);
   });

   nav.addEventListener('click', function (e) {
      if (e.target.closest('a') && window.innerWidth <= 991) {
         nav.classList.remove('is-open');
         toggle.classList.remove('is-open');
         toggle.setAttribute('aria-expanded', 'false');
      }
   });

   function openWa() { waPop.classList.add('is-open'); }
   function closeWa() { waPop.classList.remove('is-open'); }

   waFloat.addEventListener('click', function () {
      waPop.classList.contains('is-open') ? closeWa() : openWa();
   });
   waClose.addEventListener('click', closeWa);
   document.addEventListener('click', function (e) {
      if (!waPop.contains(e.target) && !waFloat.contains(e.target)) closeWa();
   });

   if (!sessionStorage.getItem('hWaShown')) {
      setTimeout(function () {
         openWa();
         sessionStorage.setItem('hWaShown', '1');
      }, 4000);
   }
})();
</script>
<?php
         }
         public function footer(){
         
         ?>
	   
	   <!--Start slogan area-->
         <section class="slogan-area text-center" style="background-image:url(images/parallax-background/slogan-bg.jpg);">
            <div class="container">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="inner-content fix wow fadeInUp" data-wow-delay="100ms">
                        <div class="title">
                           <h6>Descubre la nueva tecnología de Latin que tiene para ti</h6>
                           <h1>Navega a una velocidad increíble con el internet de fibra óptica</h1>
                        </div>
                        <div class="button">
                           <a class="btn-two" href="#">Conoce los beneficios</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!--End slogan area-->
         <!--Start footer area-->  
         <footer class="footer-area">
            <div class="container">
               <div class="row">
                  <!--Start single footer widget-->
                  <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
                     <div class="single-footer-widget marbtm50">
                        <div class="footer-widget-title">
                           <h3>Oficina Principal</h3>
                        </div>
                        <div class="company-info">
                            <div class="footer-info-item">
                               <span class="fa fa-map-marker"></span>
                               <p>Av. Venezuela #1179 C.C Estrellas Plaza Ofic 310 - Breña</p>
                            </div>
                            <div class="footer-info-item">
                               <span class="fa fa-envelope"></span>
                               <p>informes@latin.pe</p>
                            </div>
                            <div class="footer-info-item">
                               <span class="fa fa-phone-square"></span>
                               <p>+51 948 327 717</p>
                            </div>
                            <div class="footer-branch-title">
                               <span class="fa fa-building-o"></span>
                               <a href="#">Sucursales</a>
                            </div>
                            <div class="footer-branch">
                               <p><span class="fa fa-map-marker"></span> Av. Alfredo Mendiola #160 - San Martin de Porres</p>
                               <p class="branch-phone"><span class="fa fa-phone"></span> 930 748 842</p>
                            </div>
                            <div class="footer-branch">
                               <p><span class="fa fa-map-marker"></span> Calle Mayta Capac #113 - Independencia</p>
                               <p class="branch-phone"><span class="fa fa-phone"></span> 944 941 396</p>
                            </div>
                        </div>
                     </div>
                  </div>
                  <!--End single footer widget-->
                  <!--Start single footer widget-->
                  <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                     <div class="single-footer-widget marbtm50">
                        <div class="footer-widget-title">
                           <h3>Empresa</h3>
                        </div>
                        <ul class="page-links">
                           <li><a href="#"><span class="fa fa-chevron-right"></span> Acerca De</a></li>
                           <li><a href="<?php info('url');?>?modo=contacto"><span class="fa fa-chevron-right"></span> Contacto</a></li>
                        </ul>
                     </div>
                  </div>
                  <!--End single footer widget-->
                  <!--Start single footer widget-->
                  <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
                     <div class="single-footer-widget marbtm50">
                        <div class="footer-widget-title">
                           <h3>Servicios</h3>
                        </div>
                        <ul class="services-links">
                           <li><a href="<?php info('url');?>?modo=planesduo"><span class="fa fa-caret-right"></span> Planes Dúos</a></li>
                           <li><a href="<?php info('url');?>"><span class="fa fa-caret-right"></span> TV Digital</a></li>
                           <li><a href="<?php info('url');?>?modo=internetilimitado"><span class="fa fa-caret-right"></span> Internet Ilimitado</a></li>
                           <li><a href="<?php info('url');?>?modo=guiadecanales"><span class="fa fa-caret-right"></span> Guía de canales</a></li>
                           <li><a href="<?php info('url');?>"><span class="fa fa-caret-right"></span> Servicio Técnico</a></li>
                           <li><a href="https://latincable.speedtestcustom.com/"><span class="fa fa-caret-right"></span> Mide Tu Velocidad</a></li>
                           <li><a href="<?php info('url');?>terminos-y-condiciones.html"><span class="fa fa-caret-right"></span> Terminos y Condiciones</a></li>
                           <li><a href="<?php info('url');?>privacidad.html"><span class="fa fa-caret-right"></span> Privacidad</a></li>
                        </ul>
                     </div>
                  </div>
                  <!--End single footer widget-->
                  <!--Start single footer widget-->
                  <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                     <div class="single-footer-widget pdtop50">
                        <div class="footer-widget-title">
                           <h3>Boletin Informativo</h3>
                        </div>
                        <p class="newsletter-desc">Recibe las mejores ofertas y novedades directamente en tu correo.</p>
                        <form class="newsletter-form" action="#">
                           <div class="newsletter-input-group">
                              <input type="email" name="email" placeholder="Tu correo Electronico">
                              <button class="btn-one" type="submit">
                                 <span class="btn-text">Suscribir</span>
                                 <span class="fa fa-paper-plane"></span>
                              </button>
                           </div>
                        </form>
                     </div>
                  </div>
                  <!--End single footer widget-->
               </div>
            </div>
         </footer>
         <!--End footer area-->
         <!--Start footer bottom area-->
         <section class="footer-bottom-area">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                     <div class="copyright-text">
                        <p>&copy; 2021 <span>LATIN AMERICAN CONNETION SRL</span></p>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                     <div class="footer-bottom-contact-info">
                        <ul>
                           <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:informes@latin.pe">informes@latin.pe</a></li>
                           <li><i class="fa fa-phone-square" aria-hidden="true"></i><a>(01) 680-5680</a></li>
                           <li><i class="fa fa-university" aria-hidden="true"></i><a>RUC: 20600388194</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                     <div class="footer-social-links">
                        <ul class="sociallinks-style-two fix">
                           <li class="wow slideInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                              <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                           </li>
                           <li class="wow slideInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                              <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                           </li>
                           <li class="wow slideInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                              <a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                           </li>
                           <li class="wow slideInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                              <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!--End footer bottom area-->   
      </div>
      
      <!--Scroll to top-->
      <div class="scroll-to-top scroll-to-target thm-bg-clr" data-target="html"><span class="fa fa-angle-up"></span></div>
      <!-- main jQuery -->
      <script src="<?php info('js');?>jquery.js"></script>
      <!-- Wow Script -->
      <script src="<?php info('js');?>wow.js"></script>
      <!-- bootstrap -->
      <script src="<?php info('js');?>bootstrap.min.js"></script>
      <!-- bx slider -->
      <script src="<?php info('js');?>jquery.bxslider.min.js"></script>
      <!-- Fancybox Script -->
      <script src="<?php info('js');?>jquery.fancybox.js"></script>
      <!-- count to -->
      <script src="<?php info('js');?>jquery.countTo.js"></script>
      <script src="<?php info('js');?>appear.js"></script>
      <script src="<?php info('js');?>knob.js"></script>
      <!-- owl carousel -->
      <script src="<?php info('js');?>owl.js"></script>
      <!-- validate -->
      <script src="<?php info('js');?>validation.js"></script>
      <!-- mixit up -->
      <script src="<?php info('js');?>jquery.mixitup.min.js"></script>
      <!-- isotope script-->
      <script src="<?php info('js');?>isotope.js"></script>
      <!-- Easing -->
      <script src="<?php info('js');?>jquery.easing.min.js"></script>
      <!-- Gmap helper -->
      <script src="http://maps.google.com/maps/api/js?key=AIzaSyB2uu6KHbLc_y7fyAVA4dpqSVM4w9ZnnUw"></script>
      <!--Gmap script-->
      <script src="<?php info('js');?>gmaps.js"></script>
      <script src="<?php info('js');?>jmap-helper.js"></script>
      <!-- jQuery ui js -->
      <script src="<?php info('url');?>assets/jquery-ui-1.11.4/jquery-ui.js"></script>
      <!-- Language Switche  -->
      <script src="<?php info('url');?>assets/language-switcher/jquery.polyglot.language.switcher.js"></script>
      <!-- jQuery timepicker js -->
      <script src="<?php info('url');?>assets/timepicker/timePicker.js"></script>
      <!-- Bootstrap select picker js -->
      <script src="<?php info('url');?>assets/bootstrap-sl-1.12.1/bootstrap-select.js"></script> 
      <!-- html5lightbox js -->                              
      <script src="<?php info('url');?>assets/html5lightbox/html5lightbox.js"></script>
       <!--Revolution Slider-->
       <script src="<?php info('url');?>plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
       <script src="<?php info('url');?>plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
       <script src="<?php info('url');?>plugins/revolution/js/extensions/revolution.extension.actions.min.js"></script>
       <script src="<?php info('url');?>plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
       <script src="<?php info('url');?>plugins/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
       <script src="<?php info('url');?>plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
       <script src="<?php info('url');?>plugins/revolution/js/extensions/revolution.extension.migration.min.js"></script>
       <script src="<?php info('url');?>plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
       <script src="<?php info('url');?>plugins/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
       <script src="<?php info('url');?>plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
       <script src="<?php info('url');?>plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
       <!-- Revolution Slider Init -->
       <script src="<?php info('js');?>main-slider-script.js"></script>

      <!-- thm custom script -->
      <script src="<?php info('js');?>custom.js"></script>
      

<!-- Messenger plugin del chat Code -->
    <div id="fb-root"></div>

    <!-- Your plugin del chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "100999315260434");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v11.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    
   </body>
</html>
<?php
   }
   
   }
   ?>