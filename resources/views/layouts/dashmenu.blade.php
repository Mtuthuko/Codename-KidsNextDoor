<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="/css/main.css" rel="stylesheet">
        <link href="/css/home.css" rel="stylesheet">

    </head>

    <div class="menu-dash" >
        <div class="dash_body">
            <div class="dash_option">
            <a href="?myBookings"> View Bookings</a>
            </div>
        </div>
        <div class="dash_body">
            <div class="dash_option">
                <a href="?viewTimetable">Generate Exam timetable</a>
            </div>
        </div>
    </div>
</html>
