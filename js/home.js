(function () {
    var hero = document.getElementById('hero');
    if (!hero) return;
    var slides = hero.querySelectorAll('.hero__slide');
    var dotsWrap = hero.querySelector('.hero__dots');
    var progress = hero.querySelector('.hero__progress i');
    var current = 0, timer;
    var DURATION = 6000;

    slides.forEach(function (s, i) {
        var d = document.createElement('button');
        d.className = 'hero__dot' + (i === 0 ? ' is-active' : '');
        d.setAttribute('aria-label', 'Ir a slide ' + (i + 1));
        d.addEventListener('click', function () { go(i); });
        dotsWrap.appendChild(d);
    });

    var dots = dotsWrap.querySelectorAll('.hero__dot');

    function loadVideo(slide) {
        var video = slide.querySelector('.hero__video');
        if (!video || video.src) return;
        var src = video.getAttribute('data-src');
        if (!src) return;
        video.src = src;
        video.load();
    }

    function playVideo(slide) {
        var video = slide.querySelector('.hero__video');
        var poster = slide.querySelector('.hero__poster');
        if (!video) return;
        loadVideo(slide);
        video.play().catch(function () {});
        video.oncanplay = function () {
            video.classList.add('is-ready');
            if (poster) poster.classList.add('is-hidden');
        };
    }

    function pauseVideo(slide) {
        var video = slide.querySelector('.hero__video');
        var poster = slide.querySelector('.hero__poster');
        if (!video) return;
        video.pause();
        video.classList.remove('is-ready');
        if (poster) poster.classList.remove('is-hidden');
    }

    function show(n) {
        pauseVideo(slides[current]);
        slides[current].classList.remove('is-active');
        dots[current].classList.remove('is-active');
        current = (n + slides.length) % slides.length;
        slides[current].classList.add('is-active');
        dots[current].classList.add('is-active');
        playVideo(slides[current]);
        progress.style.animation = 'none';
        void progress.offsetWidth;
        progress.style.animation = 'heroProgress ' + DURATION + 'ms linear';
    }
    function go(n) { show(n); restart(); }
    function next() { show(current + 1); }
    function prev() { show(current - 1); }
    function restart() { clearInterval(timer); timer = setInterval(next, DURATION); }

    hero.querySelector('.hero__nav--next').addEventListener('click', function () { next(); restart(); });
    hero.querySelector('.hero__nav--prev').addEventListener('click', function () { prev(); restart(); });

    playVideo(slides[0]);
    restart();
})();
