/**
 * effects.js - Efectos visuales mejorados para latin.pe
 * Scroll reveal, ripple buttons, particles, counters, cursor glow
 */
(function () {
  'use strict';

  /* =============================================
     SCROLL REVEAL
  ============================================= */
  function initScrollReveal() {
    var elements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale, .reveal-stagger');
    if (!elements.length) return;

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('revealed');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    elements.forEach(function (el) { observer.observe(el); });
  }

  /* =============================================
     RIPPLE EFFECT ON BUTTONS
  ============================================= */
  function initRipple() {
    var buttons = document.querySelectorAll('.hero__btn, .plan-card__btn, .btn-one, .btn-two, .btn-three');
    buttons.forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        var rect = btn.getBoundingClientRect();
        var x = e.clientX - rect.left;
        var y = e.clientY - rect.top;
        var size = Math.max(rect.width, rect.height) * 2;

        var ripple = document.createElement('span');
        ripple.className = 'ripple';
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = (x - size / 2) + 'px';
        ripple.style.top = (y - size / 2) + 'px';
        btn.appendChild(ripple);

        ripple.addEventListener('animationend', function () { ripple.remove(); });
      });
    });
  }

  /* =============================================
     FLOATING PARTICLES
  ============================================= */
  function initParticles() {
    var sections = document.querySelectorAll('.hero, .featured-modern, .super-sale-area, .stream-area, .plans-section');
    var colors = ['rgba(0,180,255,0.3)', 'rgba(120,191,85,0.25)', 'rgba(0,224,255,0.2)', 'rgba(255,255,255,0.15)'];

    sections.forEach(function (section) {
      var container = document.createElement('div');
      container.className = 'particles-container';

      for (var i = 0; i < 12; i++) {
        var p = document.createElement('div');
        p.className = 'particle';
        var size = Math.random() * 6 + 3;
        p.style.width = size + 'px';
        p.style.height = size + 'px';
        p.style.left = Math.random() * 100 + '%';
        p.style.background = colors[Math.floor(Math.random() * colors.length)];
        p.style.animationDuration = (Math.random() * 15 + 10) + 's';
        p.style.animationDelay = (Math.random() * 10) + 's';
        container.appendChild(p);
      }

      section.style.position = 'relative';
      section.appendChild(container);
    });
  }

  /* =============================================
     COUNT UP ANIMATION
  ============================================= */
  function initCountUp() {
    var counters = document.querySelectorAll('.hero__stat b, .stat-num');
    if (!counters.length) return;

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });

    counters.forEach(function (el) { observer.observe(el); });
  }

  function animateCounter(el) {
    var text = el.textContent.trim();
    var match = text.match(/^(\+?)(\d+)(.*)/);
    if (!match) return;

    var prefix = match[1];
    var target = parseInt(match[2], 10);
    var suffix = match[3];
    var duration = 1500;
    var start = 0;
    var startTime = null;

    function step(timestamp) {
      if (!startTime) startTime = timestamp;
      var progress = Math.min((timestamp - startTime) / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 3);
      var current = Math.floor(eased * target);
      el.textContent = prefix + current + suffix;
      if (progress < 1) requestAnimationFrame(step);
      else el.textContent = text;
    }

    requestAnimationFrame(step);
  }

  /* =============================================
     CURSOR GLOW (DESKTOP ONLY)
  ============================================= */
  function initCursorGlow() {
    if (window.matchMedia('(hover: none)').matches) return;
    if (window.innerWidth < 768) return;

    var glow = document.createElement('div');
    glow.className = 'cursor-glow';
    document.body.appendChild(glow);

    var mouseX = 0, mouseY = 0;
    var glowX = 0, glowY = 0;

    document.addEventListener('mousemove', function (e) {
      mouseX = e.clientX;
      mouseY = e.clientY;
    });

    function animate() {
      glowX += (mouseX - glowX) * 0.08;
      glowY += (mouseY - glowY) * 0.08;
      glow.style.left = glowX + 'px';
      glow.style.top = glowY + 'px';
      requestAnimationFrame(animate);
    }
    animate();
  }

  /* =============================================
     PLAN CARD TILT EFFECT
  ============================================= */
  function initCardTilt() {
    if (window.matchMedia('(hover: none)').matches) return;

    var cards = document.querySelectorAll('.plan-card');
    cards.forEach(function (card) {
      card.addEventListener('mousemove', function (e) {
        var rect = card.getBoundingClientRect();
        var x = e.clientX - rect.left;
        var y = e.clientY - rect.top;
        var centerX = rect.width / 2;
        var centerY = rect.height / 2;
        var rotateX = (y - centerY) / centerY * -5;
        var rotateY = (x - centerX) / centerX * 5;

        var inner = card.querySelector('.plan-card__inner');
        if (inner) {
          inner.style.transform = 'perspective(1000px) rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg) scale(1.02)';
        }
      });

      card.addEventListener('mouseleave', function () {
        var inner = card.querySelector('.plan-card__inner');
        if (inner) {
          inner.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale(1)';
        }
      });
    });
  }

  /* =============================================
     LAZY IMAGE LOADING
  ============================================= */
  function initLazyImages() {
    var images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(function (img) {
      if (img.complete) {
        img.classList.add('loaded');
      } else {
        img.addEventListener('load', function () { img.classList.add('loaded'); });
        img.addEventListener('error', function () { img.classList.add('loaded'); });
      }
    });
  }

  /* =============================================
     BACK TO TOP
  ============================================= */
  function initBackToTop() {
    var btn = document.querySelector('.scroll-to-top');
    if (!btn) return;

    window.addEventListener('scroll', function () {
      if (window.scrollY > 400) {
        btn.classList.add('visible');
        btn.style.display = 'block';
      } else {
        btn.classList.remove('visible');
        btn.style.display = 'none';
      }
    });

    btn.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* =============================================
     PARALLAX ON SCROLL
  ============================================= */
  function initParallax() {
    var parallaxElements = document.querySelectorAll('.parallax-bg-one, .parallax-bg-two');
    if (!parallaxElements.length) return;

    window.addEventListener('scroll', function () {
      var scrollY = window.scrollY;
      parallaxElements.forEach(function (el) {
        var speed = 0.3;
        var rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom > 0) {
          el.style.backgroundPositionY = (scrollY * speed) + 'px';
        }
      });
    });
  }

  /* =============================================
     SMOOTH NAV SCROLL
  ============================================= */
  function initSmoothNavScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(function (link) {
      link.addEventListener('click', function (e) {
        var target = document.querySelector(this.getAttribute('href'));
        if (target) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    });
  }

  /* =============================================
     INITIALIZE ALL
  ============================================= */
  document.addEventListener('DOMContentLoaded', function () {
    initScrollReveal();
    initRipple();
    initParticles();
    initCountUp();
    initCursorGlow();
    initCardTilt();
    initLazyImages();
    initBackToTop();
    initParallax();
    initSmoothNavScroll();
  });

})();
