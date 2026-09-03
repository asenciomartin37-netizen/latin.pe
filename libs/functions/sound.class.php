<?php
   /*
   	Sound Class :  clase que controla el diseño y funcionamiento
   	de la mayor parte de la web.
   	Header,footer, cuerpo y algunas consultas de la web */
   
   class Sound {
       private $c = array();
   
   	public function __construct( $c ) {
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
      <link rel="stylesheet" href="<?php info('css');?>home.css?v=20260902a">
      <!-- Modern header stylesheet -->
        <link rel="stylesheet" href="<?php info('css');?>header-modern.css?v=20260902a">
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
   <body style="margin:0;padding:0;background:#070e24;border:none;outline:none;">
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
                         <a href="https://www.facebook.com/latinperu/" target="_blank" aria-label="Facebook"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                         <a href="https://www.instagram.com/latinperuoficial/" target="_blank" aria-label="Instagram"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></a>
                      </div>
                      <a class="h-cta" href="tel:016805680">
                         <i class="fa fa-phone" aria-hidden="true"></i>
                         <span class="h-cta-txt">(01) 680-5680</span>
                      </a>
                   </div>
               </div>
               </div>
</header><script>
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
</script><?php
         }
         public function footer(){
         
         ?>

	   <!--Start footer area-->  
         <footer style="background: #fff; padding: 50px 0 0; color: #fff;">
            <div style="background: linear-gradient(180deg, #0b2e6b 0%, #061d45 100%); padding: 40px 0;">
               <div class="container">
                  <div class="row">
                         <!--Logo-->
                          <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                             <div style="display: flex; flex-direction: column; align-items: flex-start; justify-content: flex-start; padding: 10px 0;">
                                <img src="images/logo.png" alt="Latin" style="height: 85px; width: auto; margin-bottom: 8px;">
                               <p style="color: #94a3b8; font-size: 13px; line-height: 1.7; margin: 0 0 16px 0;">Fibra y televisión sin límites.</p>
                            </div>
                         </div>
                  <!--Oficina Principal-->
                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                     <div style="padding: 10px 0;">
                        <h4 style="color: #fff; font-size: 18px; font-weight: 700; margin-bottom: 24px; position: relative; padding-bottom: 12px;">Oficina Principal<span style="position: absolute; bottom: 0; left: 0; width: 40px; height: 3px; background: linear-gradient(90deg, #00b4ff, #7b2ff2); border-radius: 2px;"></span></h4>
                        <div style="display: flex; flex-direction: column; gap: 16px;">
                           <div style="display: flex; align-items: flex-start; gap: 12px;">
                              <div style="width: 36px; height: 36px; min-width: 36px; background: rgba(0,180,255,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                 <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00b4ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                              </div>
                              <p style="color: #cbd5e1; font-size: 14px; margin: 0; line-height: 1.6;">Av. Venezuela #1179 C.C Estrellas Plaza Ofic 310 - Breña</p>
                           </div>
                           <div style="display: flex; align-items: flex-start; gap: 12px;">
                              <div style="width: 36px; height: 36px; min-width: 36px; background: rgba(0,180,255,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                 <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00b4ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                              </div>
                              <a href="mailto:informes@latin.pe" style="color: #cbd5e1; font-size: 14px; text-decoration: none; transition: color 0.3s;">informes@latin.pe</a>
                           </div>
                           <div style="display: flex; align-items: flex-start; gap: 12px;">
                              <div style="width: 36px; height: 36px; min-width: 36px; background: rgba(0,180,255,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                 <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00b4ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                              </div>
                              <a href="tel:+51948327717" style="color: #cbd5e1; font-size: 14px; text-decoration: none; transition: color 0.3s;">+51 948 327 717</a>
                           </div>
                        </div>
                        <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.08);">
                           <h5 style="color: #fff; font-size: 15px; font-weight: 600; margin-bottom: 14px; display: flex; align-items: center; gap: 8px;">
                              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7b2ff2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect><path d="M9 22v-4h6v4"></path><path d="M8 6h.01"></path><path d="M16 6h.01"></path><path d="M12 6h.01"></path><path d="M12 10h.01"></path><path d="M12 14h.01"></path><path d="M16 10h.01"></path><path d="M16 14h.01"></path><path d="M8 10h.01"></path><path d="M8 14h.01"></path></svg>
                              Sucursales
                           </h5>
                           <div style="display: flex; flex-direction: column; gap: 12px; padding-left: 4px;">
                              <div>
                                 <p style="color: #94a3b8; font-size: 13px; margin: 0; display: flex; align-items: center; gap: 6px;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg> Av. Alfredo Mendiola #160 - San Martin de Porres</p>
                                 <p style="color: #64748b; font-size: 12px; margin: 4px 0 0; padding-left: 18px;">930 748 842</p>
                              </div>
                              <div>
                                 <p style="color: #94a3b8; font-size: 13px; margin: 0; display: flex; align-items: center; gap: 6px;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg> Calle Mayta Capac #113 - Independencia</p>
                                 <p style="color: #64748b; font-size: 12px; margin: 4px 0 0; padding-left: 18px;">944 941 396</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--Empresa-->
                  <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12">
                     <div style="padding: 10px 0;">
                        <h4 style="color: #fff; font-size: 18px; font-weight: 700; margin-bottom: 24px; position: relative; padding-bottom: 12px;">Empresa<span style="position: absolute; bottom: 0; left: 0; width: 40px; height: 3px; background: linear-gradient(90deg, #00b4ff, #7b2ff2); border-radius: 2px;"></span></h4>
                         <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px;">
                            <li><a href="<?php info('url');?>?modo=planesduo" style="color: #94a3b8; font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#00b4ff" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg> Acerca De</a></li>
                            <li><a href="<?php info('url');?>?modo=contacto" style="color: #94a3b8; font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#00b4ff" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg> Contacto</a></li>
                         </ul>
                     </div>
                  </div>
                  <!--Servicios-->
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                     <div style="padding: 10px 0;">
                        <h4 style="color: #fff; font-size: 18px; font-weight: 700; margin-bottom: 24px; position: relative; padding-bottom: 12px;">Servicios<span style="position: absolute; bottom: 0; left: 0; width: 40px; height: 3px; background: linear-gradient(90deg, #00b4ff, #7b2ff2); border-radius: 2px;"></span></h4>
                        <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px;">
                           <li><a href="<?php info('url');?>?modo=planesduo" style="color: #94a3b8; font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#00b4ff" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg> Planes Dúos</a></li>
                            <li><a href="<?php info('url');?>?modo=guiadecanales" style="color: #94a3b8; font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#00b4ff" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg> TV Digital</a></li>
                           <li><a href="<?php info('url');?>?modo=internetilimitado" style="color: #94a3b8; font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#00b4ff" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg> Internet Ilimitado</a></li>
                           <li><a href="<?php info('url');?>?modo=guiadecanales" style="color: #94a3b8; font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#00b4ff" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg> Guía de Canales</a></li>
                           <li><a href="<?php info('url');?>?modo=formaspago" style="color: #94a3b8; font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#00b4ff" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg> Formas de Pago</a></li>
                           <li><a href="https://latincable.speedtestcustom.com/" target="_blank" style="color: #94a3b8; font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#00b4ff" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg> Mide Tu Velocidad</a></li>
                           <li><a href="<?php info('url');?>terminos-y-condiciones.html" style="color: #94a3b8; font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#00b4ff" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg> Términos y Condiciones</a></li>
                           <li><a href="<?php info('url');?>privacidad.html" style="color: #94a3b8; font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.3s;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#00b4ff" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg> Privacidad</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <!--Footer Bottom-->
             <div class="footer-bottom-area" style="background: #061d45 !important; border-top: 1px solid rgba(255,255,255,0.08) !important; padding: 6px 0 !important;">
                <div class="container">
                   <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: nowrap; gap: 16px;">
                      <p style="color: #64748b; font-size: 12px; margin: 0; white-space: nowrap;">&copy; <?php echo date('Y'); ?> <span style="color: #94a3b8; font-weight: 600;">LATIN AMERICAN CONNECTION SRL</span></p>
                      <div style="display: flex; align-items: center; gap: 20px; white-space: nowrap;">
                         <a href="mailto:informes@latin.pe" style="color: #64748b; font-size: 12px; text-decoration: none; display: flex; align-items: center; gap: 5px;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            informes@latin.pe
                         </a>
                         <a href="tel:016805680" style="color: #64748b; font-size: 12px; text-decoration: none; display: flex; align-items: center; gap: 5px;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            (01) 680-5680
                         </a>
                         <span style="color: #64748b; font-size: 12px; display: flex; align-items: center; gap: 5px;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                            RUC: 20600388194
                         </span>
                      </div>
                   </div>
                </div>
             </div>
         </footer>
         <!--End footer area-->
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
      <script src="https://maps.google.com/maps/api/js?key=AIzaSyB2uu6KHbLc_y7fyAVA4dpqSVM4w9ZnnUw"></script>
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
          version          : 'v21.0'
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
    
<!-- Popup Promocional -->
<div id="promoModal" style="display: none; position: fixed; inset: 0; z-index: 99999; background: rgba(0,0,0,0.75); align-items: center; justify-content: center; padding: 20px;">
    <div id="promoContent" style="position: relative; max-width: 600px; width: 100%; animation: promoSlideIn 0.5s ease;">
        <button id="promoCloseBtn" style="position: absolute; top: -15px; right: -15px; width: 40px; height: 40px; background: #fff; border: none; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(0,0,0,0.2); z-index: 10; transition: transform 0.3s;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0b2e6b" stroke-width="3" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        <div style="border-radius: 20px; overflow: hidden; box-shadow: 0 25px 60px rgba(0,0,0,0.3);">
            <img src="images/propaganda.jpeg" alt="Promoción Latin Cable" style="width: 100%; height: auto; display: block;">
        </div>
        <div style="text-align: center; margin-top: 15px;">
            <button id="promoCloseBtn2" style="background: rgba(255,255,255,0.9); border: none; padding: 10px 30px; border-radius: 25px; color: #0b2e6b; font-weight: 600; cursor: pointer; font-size: 14px; transition: all 0.3s;">Cerrar</button>
        </div>
    </div>
</div>

<style>
@keyframes promoSlideIn {
    from { opacity: 0; transform: scale(0.8) translateY(30px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}
#promoModal button:hover {
    transform: scale(1.1) !important;
}
</style>

<script>
(function() {
    var shown = sessionStorage.getItem('promoShown');
    if (!shown) {
        setTimeout(function() {
            document.getElementById('promoModal').style.display = 'flex';
            sessionStorage.setItem('promoShown', '1');
        }, 1500);
    }
    function closePromoModal() {
        var modal = document.getElementById('promoModal');
        if (!modal) return;
        modal.style.display = 'none';
        modal.parentNode.removeChild(modal);
        var hero = document.getElementById('hero');
        if (hero) {
            var video = hero.querySelector('.hero__slide.is-active .hero__video');
            if (video) {
                video.currentTime = 0;
                video.play().catch(function(){});
            }
        }
    }
    document.getElementById('promoCloseBtn').addEventListener('click', closePromoModal);
    document.getElementById('promoCloseBtn2').addEventListener('click', closePromoModal);
    document.getElementById('promoModal').addEventListener('click', function(e) {
        if (e.target === this) closePromoModal();
    });
})();
</script>

   </body>
</html>
<?php
   }
   
   }
   ?>