@extends('layouts.app')

@section('content')

<link href="/css/student.css" rel="stylesheet">
<title>Dashboard Students</title>


<h1 style="text-align: center">
    SUMMATIVE ASSESSMENT SCHEDULE
</h1>

<div style="overflow-x:auto;">
<table class="content-table">
  <thead>
    <tr>
      <th>ASSESSMENT CODE</th>
      <th>COURSE DISCRIPTION</th>
      <th>ASSESSMENNT TYPE</th>
      <th>VENUE</th>
      <th>ASSESSMENT DATE</th>
      <th>ASSESSMENT TIME</th>
      <th>DURATION</th>
      <th>CONCURRENT ASSESSMENT</th>
      <th>FACULTY</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>COMS</td>
      <td>WRIITEN</td>
      <td>EXAM</td>
      <td>22 DEC 2020</td>
      <td>9AM</td>
      <td>3HRS</td>
      <td>CAM</td>
      <td>SCIENCE</td>
  
    </tr>
  </tbody>
</table>
  </div>
@endsection