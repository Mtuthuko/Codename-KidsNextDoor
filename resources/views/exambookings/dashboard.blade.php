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
          <button type="submit" class="btn btn-primary">Search</button>
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

      <div style="background-color: #0B3865;color:white;border: 1px solid black; padding:5px;border:2px solid white">

        @if($message = Session::get('success'))
          <div class="alert alert-success">
            <p>{{$message}}</p>
          </div>
        @endif

      <table class="table table-bordered">
        <tr>
          <th>id</th>
          <th>Cousecode</th>
          <th>Course Name</th>
          <th>Size</th>
          <th>Special Req : Table</th>
          <th>Special Req : Vanue</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>

        @foreach($posts as $row)
          <tr>
            <td>{{$row['id']}}</td>
            <td>{{$row['code']}}</td>
            <td>{{$row['name']}}</td>
            <td>{{$row['size']}}</td>
            <td>{{$row['special_request_table']}}</td>
            <td>{{$row['special_request_vanue']}}</td>
            <td><a href="{{route('editpage',$row['id'])}}"><button>Edit</button></a></td>
            <td>
              <form class="pull-right" action="{{route('deletionpage',$row['id'])}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="DELETE" />
                <button type="submit" class="btn btn-danger">Delete</button>

              </form>
            </td>
          </tr>
        @endforeach
      </table>
  </div>

    </div>

  </div>







@endsection
