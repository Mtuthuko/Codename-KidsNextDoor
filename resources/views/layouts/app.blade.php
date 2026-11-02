<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Wits-ExamScheduler</title>

    <!-- Scripts (Vue 2 + Bootstrap dropdown; mounts on #app) -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="icon" href="/favicon.svg" type="image/svg+xml">

    <!-- Fonts: Noto Serif Display (display) + Public Sans (working face) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:wght@300..500&family=Public+Sans:wght@400..700&display=swap" rel="stylesheet">

    <!-- Styles: app.css keeps Bootstrap's dropdown; intaglio.css is the design system -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/intaglio.css') }}" rel="stylesheet">
</head>
<body class="ix">
    <a class="ix-skip" href="#content">Skip to content</a>
    <div id="app">
        <header class="ix-appbar">
            <div class="ix-appbar-in">
                <span class="ix-plate-tab"><img src="/images/wits-logo.png" alt="University of the Witwatersrand, Johannesburg" width="150" height="53"></span>
                <span class="ix-appbar-name">Exam Scheduler</span>

                <div class="ix-appbar-end">
                    @guest
                        {{-- Login and Register links stay hidden for guests, as before. --}}
                    @else
                        <div class="dropdown">
                            <a id="navbarDropdown" class="dropdown-toggle ix-usermenu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @include('partials.icon', ['name' => 'user'])
                                <span class="ix-usermenu-name">{{ Auth::user()->username }}</span>
                                @include('partials.icon', ['name' => 'chevron-down', 'class' => 'ix-chev'])
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item ix-menu-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    @include('partials.icon', ['name' => 'sign-out'])
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </header>

        <main id="content" class="ix-page" tabindex="-1" v-pre>
            @yield('content')
        </main>

        <footer class="ix-appfoot">copyright 2020 - CodeName: Kids Nextdoor</footer>
    </div>

    {{-- Scripts sit outside #app: Vue 2 strips <script> tags inside the element it mounts on. --}}
    @stack('scripts')
    @stack('living')
</body>
</html>
