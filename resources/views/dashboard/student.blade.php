@extends('layouts.app')

@section('content')

<link href="/css/student.css" rel="stylesheet">
<title>Dashboard Students</title>


<h1 style="text-align: center">
    EXAMS SCHEDULE
</h1>
  <form class="lookup-form" action="exam" method="get">
      <div class="input-group">
        <label for="search " class="search_label" >Enter CourseCode</label>
        <input type="search" name="search" class="form-control" placeholder="Enter Course Code">
        <span class="input-group-prepend">
          <button type="submit" class="btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="17.49" height="17.49" viewBox="0 0 17.49 17.49">
  <path id="ic_search_24px" d="M15.5,14h-.79l-.28-.27a6.51,6.51,0,1,0-.7.7l.27.28v.79l5,4.99L20.49,19Zm-6,0A4.5,4.5,0,1,1,14,9.5,4.494,4.494,0,0,1,9.5,14Z" transform="translate(-3 -3)"/>
</svg>
</button>
        </span>
      </div>
</form>

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
