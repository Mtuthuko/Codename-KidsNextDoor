@extends('layouts.app')

@section('content')

<link href="/css/student.css" rel="stylesheet">
<title>Dashboard Students</title>


<h1 style="text-align: center">
    EXAMS SCHEDULE
</h1>

<div style="overflow-x:auto;">
<table class="content-table">
  <thead>
    <tr>
      <th>COURSE CODE</th>
      <th>COURSE DESCRIPTION</th>
      <th>ASSESSMENNT TYPE</th>
      <th>VENUE</th>
      <th>EXAN DATE</th>
      <th>EXAM TIME</th>
      <th>DURATION</th>
      <th>SIZE</th>
      <th>CONCURRENT EXAMS</th>
    </tr>
  </thead>
  <tbody>
    <!---Populating the table with data from the EXAMS table in the database--->
    @foreach ($bookings as $exam)
    <tr>
      <td>{{{$exam['course_code']}}}</td>
      <td>{{{$exam['description']}}}</td>
      <td>{{{$exam['exam_type']}}}</td>
      <td>{{{$exam['venue']}}}</td>
      <td>{{{$exam['exam_date']}}}  </td>
      <td>{{{$exam['start_time']}}}</td>
      <td>{{{$exam['duration']}}}</td>
      <td>{{{$exam['size']}}}</td>
      <td>{{{$exam['concurrent_exams']}}}</td>
      
  
    </tr> 
   @endforeach
    
  </tbody>
</table>
  </div>
@endsection