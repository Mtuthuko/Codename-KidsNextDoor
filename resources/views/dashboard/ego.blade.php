@extends('layouts.app')

@section('content')


<title>Dashboard EGO</title>


<h1 style="text-align: center">
    Dashboard EGO
</h1>
<div class="optionMenu" >
    <div class="dash_body">
        <div class="optionItem">
        <a href="?myBookings"> View Bookings</a>
        </div>
    </div>
    <div class="dash_body">
        <div class="optionItem">
            <a href="?viewTimetable">View Exam timetable</a>
        </div>
    </div>
</div>
@endsection
