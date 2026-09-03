<link rel="stylesheet" href="<?php info('url');?>css/effects.css">
<section class="hero" id="hero">
  <div class="hero__slides">
    <article class="hero__slide is-active" style="--img:url('images/slides/v1-1.jpg')">
      <div class="hero__poster" style="background-image:url('images/slides/internet-laptop.jpg')"></div>
      <video class="hero__video" muted loop playsinline preload="none" data-src="images/slides/internet-laptop.mp4" poster="images/slides/internet-laptop.jpg">
      </video>
      <div class="hero__overlay"></div>
      <div class="container hero__inner">
        <span class="hero__eyebrow">100% Fibra &Oacute;ptica</span>
        <h1 class="hero__title"><span>Internet de alta velocidad<br>para todo tu hogar</span></h1>
        <p class="hero__text">Navega, trabaja y disfruta sin l&iacute;mites con la red de fibra dedicada de Latin. Conexi&oacute;n sim&eacute;trica y estable.</p>
        <div class="hero__actions">
          <a class="hero__btn hero__btn--primary" href="<?php info('url');?>?modo=internetilimitado">Ver planes de Internet</a>
          <a class="hero__btn hero__btn--ghost" href="<?php info('url');?>?modo=planesduo">Planes D&uacute;o</a>
        </div>
        <div class="hero__stats">
          <div class="hero__stat"><b>600</b><span>Mbps</span></div>
          <div class="hero__stat"><b>+115</b><span>Canales HD</span></div>
          <div class="hero__stat"><b>24/7</b><span>Soporte</span></div>
        </div>
      </div>
    </article>

    <article class="hero__slide" style="--img:url('images/slides/liga1max.jpg')">
      <img class="hero__bg" src="images/slides/liga1max.jpg" alt="Liga 1 MAX">
      <div class="hero__overlay"></div>
      <div class="container hero__inner">
        <span class="hero__eyebrow">Canales & Deportes</span>
        <h1 class="hero__title"><span>Vive la Liga 1 MAX<br>en tu pantalla</span></h1>
        <p class="hero__text">Somos distribuidores de Liga 1 MAX y m&aacute;s de 115 canales HD. La mejor televisi&oacute;n para tu familia con Latin.</p>
        <div class="hero__actions">
          <a class="hero__btn hero__btn--primary" href="<?php info('url');?>?modo=guiadecanales">Ver gu&iacute;a de canales</a>
          <a class="hero__btn hero__btn--ghost" href="<?php info('url');?>?modo=planesduo">Planes D&uacute;o</a>
        </div>
      </div>
    </article>

    <article class="hero__slide" style="--img:url('images/slides/familia-tv.jpg')">
      <div class="hero__poster" style="background-image:url('images/slides/familia-tv.jpg')"></div>
      <video class="hero__video" muted loop playsinline preload="none" data-src="images/slides/familia-tv.mp4" poster="images/slides/familia-tv.jpg">
      </video>
      <div class="hero__overlay"></div>
      <div class="container hero__inner">
        <span class="hero__eyebrow">Planes D&uacute;o</span>
        <h1 class="hero__title"><span>Internet + Cable<br>en un solo plan</span></h1>
        <p class="hero__text">Fibra y televisi&oacute;n sin l&iacute;mites: Conecta tu hogar a la velocidad real de la fibra &oacute;ptica y disfruta de la mejor televisi&oacute;n digital en un solo plan.</p>
        <div class="hero__actions">
          <a class="hero__btn hero__btn--primary" href="<?php info('url');?>?modo=planesduo">Ver Planes D&uacute;o</a>
          <a class="hero__btn hero__btn--ghost" href="https://api.whatsapp.com/send?phone=51944138229&text=Hola%20Latin" target="_blank">Cotizar por WhatsApp</a>
        </div>
        <div class="hero__stats">
          <div class="hero__stat"><b>Desde</b><span>S/49</span></div>
          <div class="hero__stat"><b>Fibra</b><span>&Oacute;ptica</span></div>
          <div class="hero__stat"><b>Sin</b><span>Cl&aacute;usulas</span></div>
        </div>
      </div>
    </article>
  </div>

  <button class="hero__nav hero__nav--prev" aria-label="Anterior">&#8249;</button>
  <button class="hero__nav hero__nav--next" aria-label="Siguiente">&#8250;</button>
  <div class="hero__dots"></div>
  <div class="hero__progress"><i></i></div>

  <script src="<?php info('url');?>js/home.js"></script>
</section>
<!--End Main Slider-->





















         <!--Start Featured area - Modern Cards-->
         <section class="featured-modern">
            <div class="container">
               <div class="featured-mascot reveal-scale">
                  <!-- Mascota Izquierda -->
                  <div class="featured-mascot__image">
                     <div class="featured-mascot__halo"></div>
                     <img src="images/mascotaderecha.png" alt="Mascota Latin">
                     <span class="featured-mascot__spark featured-mascot__spark--1">&#10022;</span>
                     <span class="featured-mascot__spark featured-mascot__spark--2">&#10022;</span>
                     <span class="featured-mascot__spark featured-mascot__spark--3">&#10022;</span>
                  </div>
                  <!-- Beneficios Derecha (Vertical) -->
                  <div class="featured-mascot__benefits">
                     <!--Beneficio 1: Soporte 24 Horas-->
                     <div class="featured-modern__row">
                        <div class="featured-modern__row-icon">
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                              <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                              <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                           </svg>
                        </div>
                        <div class="featured-modern__row-content">
                           <h3 class="featured-modern__title">Soporte 24 Horas</h3>
                           <p class="featured-modern__desc">Atenci&oacute;n personalizada las 24 horas del d&iacute;a. Nuestro equipo est&aacute; siempre listo para ayudarte.</p>
                        </div>
                     </div>

                     <!--Beneficio 2: Conexión Rápida-->
                     <div class="featured-modern__row">
                        <div class="featured-modern__row-icon">
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                              <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                           </svg>
                        </div>
                        <div class="featured-modern__row-content">
                           <h3 class="featured-modern__title">Conexi&oacute;n R&aacute;pida</h3>
                           <p class="featured-modern__desc">100% fibra &oacute;ptica dedicada. Velocidad sim&eacute;trica para que disfrutes sin interrupciones.</p>
                        </div>
                     </div>

                     <!--Beneficio 3: Navegación Segura-->
                     <div class="featured-modern__row">
                        <div class="featured-modern__row-icon">
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                              <polyline points="9 12 11 14 15 10"></polyline>
                           </svg>
                        </div>
                        <div class="featured-modern__row-content">
                           <h3 class="featured-modern__title">Navegaci&oacute;n Segura</h3>
                           <p class="featured-modern__desc">Navega de forma r&aacute;pida y segura. Protecci&oacute;n y estabilidad en cada conexi&oacute;n.</p>
                        </div>
                     </div>

                     <!--Beneficio 4: 100% Fibra Óptica-->
                     <div class="featured-modern__row">
                        <div class="featured-modern__row-icon">
                           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                              <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                              <path d="M2 17l10 5 10-5"></path>
                              <path d="M2 12l10 5 10-5"></path>
                           </svg>
                        </div>
                        <div class="featured-modern__row-content">
                           <h3 class="featured-modern__title">100% Fibra &Oacute;ptica</h3>
                           <p class="featured-modern__desc">Aut&eacute;ntica fibra dedicada punto a punto. Conexi&oacute;n de fibra directa al router.</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!--End Featured area-->
    
         <!--Start Services Style1 - Modern Pricing-->
<section class="plans-section">
   <div class="plans-bg-glow plans-bg-glow--1"></div>
   <div class="plans-bg-glow plans-bg-glow--2"></div>
   <div class="container">
      <div class="plans-header text-center reveal">
         <span class="plans-tag">Nuestros Planes</span>
         <h2 class="plans-title gradient-text-animated">Elige tu plan ideal</h2>
         <p class="plans-subtitle">Conectividad de alta velocidad con los mejores beneficios para ti y tu familia</p>
      </div>
      <div class="plans-carousel owl-carousel owl-theme">
         <!--Plan 1: LATINCABLE HD-->
         <div class="plan-card wow fadeInUp shimmer" data-wow-delay="200ms" data-wow-duration="1000ms">
            <div class="plan-card__glow"></div>
            <div class="plan-card__inner">
               <div class="plan-card__header">
                  <div class="plan-card__icon">
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="20" height="15" rx="2" ry="2"></rect>
                        <polyline points="17 2 12 7 7 2"></polyline>
                     </svg>
                  </div>
                  <span class="plan-card__badge">Cable</span>
               </div>
               <h3 class="plan-card__name">LATINCABLE HD</h3>
               <p class="plan-card__desc">Televisi&oacute;n por cable con alta definici&oacute;n</p>
               <div class="plan-card__price">
                  <span class="plan-card__currency">S/</span>
                  <span class="plan-card__amount">49</span>
                  <span class="plan-card__period">.00 / mes</span>
               </div>
               <div class="plan-card__divider"></div>
               <ul class="plan-card__features">
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>80 canales Anal&oacute;gicos</li>
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>M&aacute;s de 115 Canales HD</li>
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>100% Fibra &Oacute;ptica</li>
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>Instalaci&oacute;n R&aacute;pida</li>
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>Soporte T&eacute;cnico 24/7</li>
               </ul>
               <div class="plan-card__footer">
                  <span class="plan-card__insc">Inscripci&oacute;n: S/ 50.00</span>
                  <a class="plan-card__btn" href="https://bit.ly/InternetHogarPeru" target="_blank">Contratar Ahora</a>
               </div>
            </div>
         </div>
         <!--Plan 2: LATIN PRACTICO HD-->
         <div class="plan-card wow fadeInUp shimmer" data-wow-delay="400ms" data-wow-duration="1000ms">
            <div class="plan-card__glow"></div>
            <div class="plan-card__inner">
               <div class="plan-card__header">
                  <div class="plan-card__icon">
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="20" height="15" rx="2" ry="2"></rect>
                        <polyline points="17 2 12 7 7 2"></polyline>
                        <path d="M12 11v4"></path>
                        <path d="M8 15h8"></path>
                     </svg>
                  </div>
                  <span class="plan-card__badge plan-card__badge--accent">D&uacute;o</span>
               </div>
               <h3 class="plan-card__name">LATIN PRACTICO HD</h3>
               <p class="plan-card__desc">Cable + Internet en un solo plan</p>
               <div class="plan-card__price">
                  <span class="plan-card__currency">S/</span>
                  <span class="plan-card__amount">80</span>
                  <span class="plan-card__period">.00 / mes</span>
               </div>
               <div class="plan-card__divider"></div>
               <ul class="plan-card__features">
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>100+ canales Anal&oacute;gicos y HD</li>
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>Internet ilimitado 100MB</li>
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>100% Fibra &Oacute;ptica</li>
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>Instalaci&oacute;n R&aacute;pida</li>
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>Soporte T&eacute;cnico 24/7</li>
               </ul>
               <div class="plan-card__footer">
                  <span class="plan-card__insc">Inscripci&oacute;n: S/ 100.00</span>
                  <a class="plan-card__btn" href="https://bit.ly/InternetHogarPeru" target="_blank">Contratar Ahora</a>
               </div>
            </div>
         </div>
         <!--Plan 3: LATIN PRACTICO-->
         <div class="plan-card wow fadeInUp shimmer" data-wow-delay="600ms" data-wow-duration="1000ms">
            <div class="plan-card__glow"></div>
            <div class="plan-card__inner">
               <div class="plan-card__header">
                  <div class="plan-card__icon">
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12.55a11 11 0 0 1 14.08 0"></path>
                        <path d="M1.42 9a16 16 0 0 1 21.16 0"></path>
                        <path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path>
                        <line x1="12" y1="20" x2="12.01" y2="20"></line>
                     </svg>
                  </div>
                  <span class="plan-card__badge">Internet</span>
               </div>
               <h3 class="plan-card__name">LATIN PRACTICO</h3>
               <p class="plan-card__desc">Solo Internet de alta velocidad</p>
               <div class="plan-card__price">
                  <span class="plan-card__currency">S/</span>
                  <span class="plan-card__amount">40</span>
                  <span class="plan-card__period">.00 / mes</span>
               </div>
               <div class="plan-card__divider"></div>
               <ul class="plan-card__features">
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>Conexi&oacute;n Sim&eacute;trica</li>
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>Internet ilimitado 100MB</li>
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>100% Fibra &Oacute;ptica</li>
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>Instalaci&oacute;n R&aacute;pida</li>
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>Soporte T&eacute;cnico 24/7</li>
               </ul>
               <div class="plan-card__footer">
                  <span class="plan-card__insc">Inscripci&oacute;n: S/ 50.00</span>
                  <a class="plan-card__btn" href="https://bit.ly/InternetHogarPeru" target="_blank">Contratar Ahora</a>
               </div>
            </div>
         </div>
         <!--Plan 4: LATIN NEGOCIO HD-->
         <div class="plan-card wow fadeInUp shimmer" data-wow-delay="200ms" data-wow-duration="1000ms">
            <div class="plan-card__glow"></div>
            <div class="plan-card__inner">
               <div class="plan-card__header">
                  <div class="plan-card__icon">
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="20" height="15" rx="2" ry="2"></rect>
                        <polyline points="17 2 12 7 7 2"></polyline>
                        <line x1="8" y1="12" x2="16" y2="12"></line>
                        <line x1="8" y1="16" x2="16" y2="16"></line>
                     </svg>
                  </div>
                  <span class="plan-card__badge plan-card__badge--dark">Negocio</span>
               </div>
               <h3 class="plan-card__name">LATIN NEGOCIO HD</h3>
               <p class="plan-card__desc">Cable para tu negocio</p>
               <div class="plan-card__price">
                  <span class="plan-card__currency">S/</span>
                  <span class="plan-card__amount">200</span>
                  <span class="plan-card__period">.00 / mes</span>
               </div>
               <div class="plan-card__divider"></div>
               <ul class="plan-card__features">
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>80+ canales Anal&oacute;gicos</li>
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>115+ Canales Digitales HD</li>
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>100% Fibra &Oacute;ptica</li>
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>Instalaci&oacute;n R&aacute;pida</li>
                  <li><svg class="plan-card__check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>Soporte T&eacute;cnico Prioritario</li>
               </ul>
               <div class="plan-card__footer">
                  <span class="plan-card__insc">Inscripci&oacute;n: S/ 250.00</span>
                  <a class="plan-card__btn" href="https://bit.ly/InternetHogarPeru" target="_blank">Contratar Ahora</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!--End Services Style1 - Modern Pricing-->

          <!--Start Super Sale Area-->
         <section class="super-sale-area">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-xl-6 pd0 reveal-left">
                     <div class="super-sale-image">
                        <div class="super-sale-visual">
                           <div class="tv-grid">
                              <div class="tv-cell"><img src="images/canales-tv/fox-sport.jpg" alt="Fox Sports"><span>Fox Sports</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/foxsport-2.jpg" alt="Fox Sports 2"><span>Fox Sports 2</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/espn.jpg" alt="ESPN"><span>ESPN</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/espn-2.jpg" alt="ESPN 2"><span>ESPN 2</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/liga1-max.jpg" alt="Liga 1 MAX"><span>Liga 1 MAX</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/discovery.jpg" alt="Discovery"><span>Discovery</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/discovery-kids.jpg" alt="Discovery Kids"><span>Disc. Kids</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/discovery-turbo.jpg" alt="Discovery Turbo"><span>Disc. Turbo</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/national-geografi.jpg" alt="Nat Geo"><span>Nat Geo</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/nat-geo-wilds.jpg" alt="Nat Geo Wild"><span>Geo Wild</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/disney-channel.jpg" alt="Disney"><span>Disney</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/disney-junior.jpg" alt="Disney Junior"><span>Disney Jr</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/disney-xd.jpg" alt="Disney XD"><span>Disney XD</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/nickelodeon.jpg" alt="Nickelodeon"><span>Nickelodeon</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/nick-jr.jpg" alt="Nick Jr"><span>Nick Jr</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/axn.jpg" alt="AXN"><span>AXN</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/history.jpg" alt="History"><span>History</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/paramount.jpg" alt="Paramount"><span>Paramount</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/cinecanal.jpg" alt="Cinecanal"><span>Cinecanal</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/cine-latino.jpg" alt="Cine Latino"><span>Cine Latino</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/tv-peru.jpg" alt="TV Perú"><span>TV Perú</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/latina.jpg" alt="Latina"><span>Latina</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/panamericana.jpg" alt="Panamericana"><span>Panamericana</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/atv.jpg" alt="ATV"><span>ATV</span></div>
                              <div class="tv-cell"><img src="images/canales-tv/global.jpg" alt="Global"><span>Global</span></div>
                           </div>
                           <div class="tv-scanline"></div>
                           <div class="tv-orb tv-orb--1"></div>
                           <div class="tv-orb tv-orb--2"></div>
                           <div class="tv-orb tv-orb--3"></div>
                        </div>
                        <div class="super-sale-particles">
                           <span></span><span></span><span></span><span></span><span></span>
                        </div>
                        <div class="super-sale-overlay"></div>
                     </div>
                  </div>
                   <div class="col-xl-6 pd0 reveal-right">
                     <div class="super-sale-content">
                        <div class="inner">
                           <div class="sec-title">
                              <div class="title">Entretenimiento<br>Para Toda La Familia</div>
                           </div>
                           <p class="super-sale-desc">Disfruta de la mejor programación con calidad HD y SD. Deportes en vivo, películas, series, noticias y contenido infantil. Conexión estable por fibra óptica dedicada.</p>
                           <div class="super-sale-features">
                              <div class="ss-feature">
                                 <div class="ss-feature-icon"><i class="fa fa-signal"></i></div>
                                 <div class="ss-feature-text">
                                    <strong>Calidad HD</strong>
                                    <span>115+ canales en alta definición</span>
                                 </div>
                              </div>
                              <div class="ss-feature">
                                 <div class="ss-feature-icon"><i class="fa fa-tv"></i></div>
                                 <div class="ss-feature-text">
                                    <strong>Canales Analógicos</strong>
                                    <span>80+ canales en SD</span>
                                 </div>
                              </div>
                              <div class="ss-feature">
                                 <div class="ss-feature-icon"><i class="fa fa-wifi"></i></div>
                                 <div class="ss-feature-text">
                                    <strong>Fibra Óptica</strong>
                                    <span>Conexión dedicada estable</span>
                                 </div>
                              </div>
                           </div>
                           <div class="super-sale-stats">
                              <div class="stat-item">
                                 <span class="stat-num">115+</span>
                                 <span class="stat-label">Canales HD</span>
                              </div>
                              <div class="stat-divider"></div>
                              <div class="stat-item">
                                 <span class="stat-num">80+</span>
                                 <span class="stat-label">Canales SD</span>
                              </div>
                              <div class="stat-divider"></div>
                              <div class="stat-item">
                                 <span class="stat-num">24/7</span>
                                 <span class="stat-label">Soporte</span>
                              </div>
                           </div>
                           <div class="button">
                              <a class="btn-one" href="?modo=guiadecanales">Ver Guía de Canales <i class="fa fa-arrow-right"></i></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!--End Super Sale Area-->
          <!--Start stream Area-->
         <section class="stream-area" style="background: #fff; padding: 80px 0 90px;">
            <div class="container">
               <div class="stream-header text-center reveal" style="margin-bottom: 50px;">
                  <span style="display: inline-block; background: #0b2e6b; color: #fff; padding: 8px 24px; border-radius: 30px; font-size: 13px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 18px;">Transmision en Vivo</span>
                   <h2 style="color: #0b2e6b; font-size: 38px; font-weight: 800; margin-bottom: 14px; line-height: 1.2;" class="hero__title"><span class="gradient-text-animated">Descubre Un Mundo<br>De Entretenimiento</span></h2>
                  <p style="color: #64748b; font-size: 17px; max-width: 520px; margin: 0 auto; line-height: 1.7;">Contenido variado para toda la familia las 24 horas del dia</p>
               </div>
                <div class="stream-grid reveal-stagger" style="gap: 30px; max-width: 1200px; margin: 0 auto;">

                  <!-- Deportes -->
                  <div class="stream-cat-card" style="background: #fff; border-radius: 28px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.1); border: 1px solid #f1f5f9; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer; position: relative;">
                     <div style="height: 340px; background: linear-gradient(180deg, #ffffff 0%, #fff8f8 100%); position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                        <div style="position: absolute; inset: 0; background-image: url('images/stream/deportes.jpg'); background-size: cover; background-position: center; opacity: 0.7;"></div>
                        <div style="position: relative; z-index: 2; width: 120px; height: 120px; background: rgba(255,107,107,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(12px); border: 3px solid rgba(255,107,107,0.3);">
                           <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#ff6b6b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                              <circle cx="12" cy="12" r="10"></circle>
                              <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"></path>
                              <path d="M2 12h20"></path>
                           </svg>
                        </div>
                        <div style="position: absolute; bottom: 18px; right: 18px; background: #ff6b6b; color: #fff; padding: 8px 18px; border-radius: 24px; font-size: 14px; font-weight: 700; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 15px rgba(255,107,107,0.3);">
                           <span style="width: 9px; height: 9px; background: #fff; border-radius: 50%; animation: pulse-dot 1.5s infinite;"></span>
                           En Vivo
                        </div>
                     </div>
                     <div style="padding: 32px 36px;">
                         <h3 style="color: #0b2e6b; font-size: 30px; font-weight: 800; margin-bottom: 10px;" class="hero__title"><span>Deportes</span></h3>
                        <p style="color: #64748b; font-size: 16px; margin-bottom: 24px; line-height: 1.6;">Futbol, NBA, F1 y mas en vivo</p>
                        <div style="display: flex; gap: 12px; align-items: center;">
                           <div style="width: 56px; height: 56px; border-radius: 14px; overflow: hidden; border: 2px solid #f1f5f9; box-shadow: 0 3px 10px rgba(0,0,0,0.08);">
                              <img src="images/canales-tv/fox-sport.jpg" alt="Fox Sports" style="width: 100%; height: 100%; object-fit: cover;">
                           </div>
                           <div style="width: 56px; height: 56px; border-radius: 14px; overflow: hidden; border: 2px solid #f1f5f9; box-shadow: 0 3px 10px rgba(0,0,0,0.08);">
                              <img src="images/canales-tv/espn.jpg" alt="ESPN" style="width: 100%; height: 100%; object-fit: cover;">
                           </div>
                           <div style="width: 56px; height: 56px; border-radius: 14px; overflow: hidden; border: 2px solid #f1f5f9; box-shadow: 0 3px 10px rgba(0,0,0,0.08);">
                              <img src="images/canales-tv/liga1-max.jpg" alt="Liga 1 MAX" style="width: 100%; height: 100%; object-fit: cover;">
                           </div>
                           <span style="background: #f1f5f9; color: #64748b; width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 700;">+3</span>
                        </div>
                     </div>
                  </div>

                  <!-- Entretenimiento -->
                  <div class="stream-cat-card" style="background: #fff; border-radius: 28px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.1); border: 1px solid #f1f5f9; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer; position: relative;">
                     <div style="height: 340px; background: linear-gradient(180deg, #ffffff 0%, #fdf8ff 100%); position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                        <div style="position: absolute; inset: 0; background-image: url('images/stream/entretenimiento.jpg'); background-size: cover; background-position: center; opacity: 0.7;"></div>
                        <div style="position: relative; z-index: 2; width: 120px; height: 120px; background: rgba(168,85,247,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(12px); border: 3px solid rgba(168,85,247,0.3);">
                           <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                              <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"></rect>
                              <line x1="7" y1="2" x2="7" y2="22"></line>
                              <line x1="17" y1="2" x2="17" y2="22"></line>
                              <line x1="2" y1="12" x2="22" y2="12"></line>
                           </svg>
                        </div>
                        <div style="position: absolute; bottom: 18px; right: 18px; background: #a855f7; color: #fff; padding: 8px 18px; border-radius: 24px; font-size: 14px; font-weight: 700; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 15px rgba(168,85,247,0.3);">
                           <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                           HD
                        </div>
                     </div>
                     <div style="padding: 32px 36px;">
                         <h3 style="color: #0b2e6b; font-size: 30px; font-weight: 800; margin-bottom: 10px;" class="hero__title"><span>Entretenimiento</span></h3>
                        <p style="color: #64748b; font-size: 16px; margin-bottom: 24px; line-height: 1.6;">Peliculas, series y novelas</p>
                        <div style="display: flex; gap: 12px; align-items: center;">
                           <div style="width: 56px; height: 56px; border-radius: 14px; overflow: hidden; border: 2px solid #f1f5f9; box-shadow: 0 3px 10px rgba(0,0,0,0.08);">
                              <img src="images/canales-tv/cinecanal.jpg" alt="Cinecanal" style="width: 100%; height: 100%; object-fit: cover;">
                           </div>
                           <div style="width: 56px; height: 56px; border-radius: 14px; overflow: hidden; border: 2px solid #f1f5f9; box-shadow: 0 3px 10px rgba(0,0,0,0.08);">
                              <img src="images/canales-tv/paramount.jpg" alt="Paramount" style="width: 100%; height: 100%; object-fit: cover;">
                           </div>
                           <div style="width: 56px; height: 56px; border-radius: 14px; overflow: hidden; border: 2px solid #f1f5f9; box-shadow: 0 3px 10px rgba(0,0,0,0.08);">
                              <img src="images/canales-tv/axn.jpg" alt="AXN" style="width: 100%; height: 100%; object-fit: cover;">
                           </div>
                           <span style="background: #f1f5f9; color: #64748b; width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 700;">+3</span>
                        </div>
                     </div>
                  </div>

                  <!-- Infantil -->
                  <div class="stream-cat-card" style="background: #fff; border-radius: 28px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.1); border: 1px solid #f1f5f9; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer; position: relative;">
                     <div style="height: 340px; background: linear-gradient(180deg, #ffffff 0%, #fffcf5 100%); position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                        <div style="position: absolute; inset: 0; background-image: url('images/stream/infantil.jpg'); background-size: cover; background-position: center; opacity: 0.7;"></div>
                        <div style="position: relative; z-index: 2; width: 120px; height: 120px; background: rgba(245,158,11,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(12px); border: 3px solid rgba(245,158,11,0.3);">
                           <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                              <circle cx="12" cy="12" r="10"></circle>
                              <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                              <line x1="9" y1="9" x2="9.01" y2="9"></line>
                              <line x1="15" y1="9" x2="15.01" y2="9"></line>
                           </svg>
                        </div>
                        <div style="position: absolute; bottom: 18px; right: 18px; background: #f59e0b; color: #fff; padding: 8px 18px; border-radius: 24px; font-size: 14px; font-weight: 700; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 15px rgba(245,158,11,0.3);">
                           <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                           Kids
                        </div>
                     </div>
                     <div style="padding: 32px 36px;">
                         <h3 style="color: #0b2e6b; font-size: 30px; font-weight: 800; margin-bottom: 10px;" class="hero__title"><span>Infantil</span></h3>
                        <p style="color: #64748b; font-size: 16px; margin-bottom: 24px; line-height: 1.6;">Diversión y aprendizaje para los más pequeños</p>
                        <div style="display: flex; gap: 12px; align-items: center;">
                           <div style="width: 56px; height: 56px; border-radius: 14px; overflow: hidden; border: 2px solid #f1f5f9; box-shadow: 0 3px 10px rgba(0,0,0,0.08);">
                              <img src="images/canales-tv/disney-channel.jpg" alt="Disney" style="width: 100%; height: 100%; object-fit: cover;">
                           </div>
                           <div style="width: 56px; height: 56px; border-radius: 14px; overflow: hidden; border: 2px solid #f1f5f9; box-shadow: 0 3px 10px rgba(0,0,0,0.08);">
                              <img src="images/canales-tv/nickelodeon.jpg" alt="Nickelodeon" style="width: 100%; height: 100%; object-fit: cover;">
                           </div>
                           <div style="width: 56px; height: 56px; border-radius: 14px; overflow: hidden; border: 2px solid #f1f5f9; box-shadow: 0 3px 10px rgba(0,0,0,0.08);">
                              <img src="images/canales-tv/discovery-kids.jpg" alt="Discovery Kids" style="width: 100%; height: 100%; object-fit: cover;">
                           </div>
                           <span style="background: #f1f5f9; color: #64748b; width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 700;">+3</span>
                        </div>
                     </div>
                  </div>

                  <!-- Documentales -->
                  <div class="stream-cat-card" style="background: #fff; border-radius: 28px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.1); border: 1px solid #f1f5f9; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer; position: relative;">
                     <div style="height: 340px; background: linear-gradient(180deg, #ffffff 0%, #f5fffc 100%); position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                        <div style="position: absolute; inset: 0; background-image: url('images/stream/documentales.jpg'); background-size: cover; background-position: center; opacity: 0.7;"></div>
                        <div style="position: relative; z-index: 2; width: 120px; height: 120px; background: rgba(16,185,129,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(12px); border: 3px solid rgba(16,185,129,0.3);">
                           <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                              <circle cx="12" cy="12" r="10"></circle>
                              <line x1="2" y1="12" x2="22" y2="12"></line>
                              <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                           </svg>
                        </div>
                        <div style="position: absolute; bottom: 18px; right: 18px; background: #10b981; color: #fff; padding: 8px 18px; border-radius: 24px; font-size: 14px; font-weight: 700; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 15px rgba(16,185,129,0.3);">
                           <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path></svg>
                           4K
                        </div>
                     </div>
                     <div style="padding: 32px 36px;">
                        <h3 style="color: #0b2e6b; font-size: 30px; font-weight: 800; margin-bottom: 10px;" class="hero__title"><span>Documentales</span></h3>
                        <p style="color: #64748b; font-size: 16px; margin-bottom: 24px; line-height: 1.6;">Naturaleza, ciencia y aventura</p>
                        <div style="display: flex; gap: 12px; align-items: center;">
                           <div style="width: 56px; height: 56px; border-radius: 14px; overflow: hidden; border: 2px solid #f1f5f9; box-shadow: 0 3px 10px rgba(0,0,0,0.08);">
                              <img src="images/canales-tv/discovery.jpg" alt="Discovery" style="width: 100%; height: 100%; object-fit: cover;">
                           </div>
                           <div style="width: 56px; height: 56px; border-radius: 14px; overflow: hidden; border: 2px solid #f1f5f9; box-shadow: 0 3px 10px rgba(0,0,0,0.08);">
                              <img src="images/canales-tv/national-geografi.jpg" alt="Nat Geo" style="width: 100%; height: 100%; object-fit: cover;">
                           </div>
                           <div style="width: 56px; height: 56px; border-radius: 14px; overflow: hidden; border: 2px solid #f1f5f9; box-shadow: 0 3px 10px rgba(0,0,0,0.08);">
                              <img src="images/canales-tv/nat-geo-wilds.jpg" alt="Nat Geo Wild" style="width: 100%; height: 100%; object-fit: cover;">
                           </div>
                           <span style="background: #f1f5f9; color: #64748b; width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 700;">+3</span>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
         </section>
         <!--End stream Area-->

         <style>
         @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.2); }
         }
         @keyframes mascotFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-18px); }
         }
         @keyframes sparkPulse {
            0%, 100% { opacity: 0.2; transform: scale(0.8); }
            50% { opacity: 1; transform: scale(1.2); }
         }
          .featured-mascot {
             position: relative;
             padding: 0 0;
             min-height: 520px;
          }
          .featured-mascot__image {
             position: absolute;
             left: 0;
             top: 25%;
             transform: translateY(-65%);
             width: 720px;
             height: 520px;
             z-index: 3;
             pointer-events: none;
          }
         .featured-mascot__halo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 620px;
            height: 620px;
            max-width: 90%;
            background: radial-gradient(circle, rgba(11,46,107,0.12) 0%, rgba(11,46,107,0.04) 60%, transparent 75%);
            border-radius: 50%;
            z-index: 0;
         }
         .featured-mascot__halo::after {
            content: "";
            position: absolute;
            inset: 25px;
            border: 2px dashed rgba(11,46,107,0.20);
            border-radius: 50%;
            animation: haloSpin 20s linear infinite;
         }
         @keyframes haloSpin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
         }
          .featured-mascot__image img {
             position: absolute;
             left: 0;
             top: 50%;
             transform: translateY(-65%);
             height: 100%;
             width: auto;
             max-width: 720px;
             object-fit: contain;
             z-index: 1;
             right: -120px;
             filter: drop-shadow(0 25px 60px rgba(11,46,107,0.35));
             animation: mascotFloat 3s ease-in-out infinite;
          }
         .featured-mascot__spark {
            position: absolute;
            color: #0b2e6b;
            font-size: 22px;
            z-index: 4;
            animation: sparkPulse 2s ease-in-out infinite;
         }
         .featured-mascot__spark--1 { top: 10%; left: 15%; }
         .featured-mascot__spark--2 { top: 18%; left: 45%; animation-delay: 0.5s; color: #2a5cc0; }
         .featured-mascot__spark--3 { bottom: 15%; left: 22%; animation-delay: 1s; color: #14439e; }
         .featured-mascot__benefits {
            position: relative;
            z-index: 2;
            margin-left: 40%;
            display: flex;
            flex-direction: column;
            gap: 22px;
         }
         .featured-modern__row {
            display: flex;
            align-items: center;
            gap: 24px;
            background: #ffffff;
            border-radius: 20px;
            padding: 22px 28px;
            border: 1px solid rgba(11,46,107,0.08);
            box-shadow: 0 12px 30px rgba(11,46,107,0.06);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
         }
         .featured-modern__row::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 5px;
            height: 100%;
            background: #0b2e6b;
            border-radius: 5px 0 0 5px;
         }
         .featured-modern__row:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 45px rgba(11,46,107,0.15);
         }
         .featured-modern__row-icon {
            flex: 0 0 70px;
            width: 70px;
            height: 70px;
            border-radius: 18px;
            background: linear-gradient(135deg, #0b2e6b, #14439e);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            box-shadow: 0 8px 20px rgba(11,46,107,0.25);
            transition: all 0.3s ease;
         }
         .featured-modern__row:hover .featured-modern__row-icon {
            transform: rotate(-6deg) scale(1.05);
            background: linear-gradient(135deg, #0b2e6b, #2a5cc0);
         }
         .featured-modern__row-icon svg {
            width: 34px;
            height: 34px;
         }
         .featured-modern__row-content {
            flex: 1;
         }
         .featured-modern__row-content h3 {
            margin: 0 0 6px;
            font-size: 22px;
            font-weight: 800;
            color: #0b2e6b;
            line-height: 1.2;
         }
         .featured-modern__row-content p {
            margin: 0;
            color: #64748b;
            font-size: 15px;
            line-height: 1.6;
         }
         @media (max-width: 1200px) {
            .featured-mascot__image { width: 620px; height: 480px; }
            .featured-mascot__image img { max-width: 620px; right: -100px; }
            .featured-mascot__halo { width: 480px; height: 480px; }
            .featured-mascot__benefits { margin-left: 42%; }
         }
         @media (max-width: 991px) {
            .featured-mascot {
               display: block;
               min-height: 0;
               padding: 0;
            }
            .featured-mascot__image {
               position: relative;
               transform: none;
               width: 100%;
               height: 320px;
               top: auto;
               left: auto;
               margin-bottom: 10px;
            }
            .featured-mascot__image img {
               position: relative;
               transform: none;
               top: auto;
               left: 50%;
               transform: translateX(-50%);
               height: 100%;
               max-width: 340px;
               right: auto;
            }
            .featured-mascot__halo {
               width: 300px;
               height: 300px;
               max-width: 90%;
            }
            .featured-mascot__benefits {
               margin-left: 0;
               width: 100%;
            }
         }
         .stream-cat-card:hover {
            transform: translateY(-8px) !important;
            box-shadow: 0 25px 60px rgba(0,0,0,0.12) !important;
         }
          </style>
          <script src="<?php info('url');?>js/effects.js"></script>

