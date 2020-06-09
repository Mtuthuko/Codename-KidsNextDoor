@extends('layouts.app')

@section('content')


<title>Dashboard EGO</title>
<link rel="stylesheet" href="css/home.css">

<h1 style="text-align: center">
    Dashboard EGO
</h1>


<div class="dash_main_body">
    <h1 class="h-30" >View Clashes</h1>
    <div class="dash_grid">
        <div class="grid_item">
            <h2>Same day clashes</h2>
        </div>
        <div class="grid_item">
            <h2>Next day clashes</h2>
        </div>   
        <div class="grid_item">
            <h2>Other</h2>
            
        </div>
    </div>
<div class="optionMenu" >
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
</div>

@endsection
