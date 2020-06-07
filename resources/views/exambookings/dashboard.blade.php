@extends('layouts.app')

  <!-- Testing Code for new dashboard view -->
@section('content')
  <!-- Lookup function Form
      "Look up a course in the data base"
-->


  <div class="topnav">
    <br>
      <h1 align="center">Exam Bookings </h1>
    <br>

    <form class="lookup-form" action="exambooking" method="get">
      <div class="input-group">
        <label >Enter CourseCode</label>
        <input type="search" name="search" class="form-control" placeholder="Enter Course Code">
        <span class="input-group-prepend">
          <button type="submit" class="btn btn-primary">+</button>
        </span>
      </div>




    </form>

  </div>




  <br />
  <!-- Fetch Data From DB
      "Show CourseCode with the number of students registered for the course"
-->
  <div class="row">
    <div class="col-md-12">
      <br />
      <h2 align="center">Courses Data</h1>
      <br />

      <table class="table table-bordered">
        <tr>
          <th>id</th>
          <th>Cousecode</th>
          <th>Course Name</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>

        @foreach($posts as $post)
          <tr>
            <td>{{$post['id']}}</td>
            <td>{{$post['code']}}</td>
            <td>{{$post['name']}}</td>
            <td></td>
            <td></td>
          </tr>
        @endforeach
      </table>


    </div>

  </div>







@endsection
