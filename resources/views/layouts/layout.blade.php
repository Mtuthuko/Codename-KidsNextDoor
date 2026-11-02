<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-page="@yield('page')">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Wits-ExamScheduler</title>

    <link rel="icon" href="/favicon.svg" type="image/svg+xml">

    <!-- Fonts: Noto Serif Display (display) + Public Sans (working face) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:wght@300..500&family=Public+Sans:wght@400..700&display=swap" rel="stylesheet">

    <!-- Styles: the Intaglio design system plus the front door (night cover, rosette, login card) -->
    <link href="{{ asset('css/intaglio.css') }}" rel="stylesheet">
    <link href="{{ asset('css/intaglio-front.css') }}" rel="stylesheet">

    <!-- Motion gate: html.motion only when motion is allowed; html.door-intro on the first welcome visit
         of the session. If GSAP has not arrived after 1.5 s, everything shows at rest. -->
    <script>(function(d){try{if(matchMedia('(prefers-reduced-motion: reduce)').matches)return;d.classList.add('motion');
    var seen=false;try{seen=sessionStorage.getItem('ks-door-seen')==='1'}catch(e){}
    if(!seen&&d.getAttribute('data-page')==='welcome')d.classList.add('door-intro');
    setTimeout(function(){if(!window.gsap)d.classList.remove('motion','door-intro')},1500)}catch(e){}})(document.documentElement);</script>
</head>
<body class="ix ix-front">
    <main id="content">
        @yield('content')
    </main>

    <footer class="ix-front-foot">copyright 2020 - CodeName: Kids Nextdoor</footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js" defer></script>
    <script src="/js/living-layer.js" defer></script>
    <script src="/js/front-door.js" defer></script>
</body>
</html>
