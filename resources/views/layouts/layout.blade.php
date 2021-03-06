<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Wits-ExamScheduler</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="/css/main.css" rel="stylesheet">
        <link href="/css/dashboard.css" rel="stylesheet">

    </head>
  <main class="py-4">
        @yield('content')
        <footer>
            copyright 2020 - CodeName: Kids Nextdoor
        </footer>
    </main>
</html>
