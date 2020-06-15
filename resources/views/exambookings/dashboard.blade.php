@extends('layouts.app')

  <!-- Testing Code for new dashboard view -->
@section('content')
<link href="/css/student.css" rel="stylesheet">
  <!-- Lookup function Form
      "Look up a course in the data base"
-->


  <div class="topnav">
    <br>
      <h1 align="center">Exam Bookings </h1>
    <br>

    <form class="lookup-form" action="exambooking" method="get">
      <div class="input-group">
        <label for="search " class="search_label" >Enter CourseCode</label>
        <input type="search" name="search" class="form-control" placeholder="Enter Course Code">
        <span class="input-group-prepend">
          <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="17.49" height="17.49" viewBox="0 0 17.49 17.49">
  <path id="ic_search_24px" d="M15.5,14h-.79l-.28-.27a6.51,6.51,0,1,0-.7.7l.27.28v.79l5,4.99L20.49,19Zm-6,0A4.5,4.5,0,1,1,14,9.5,4.494,4.494,0,0,1,9.5,14Z" transform="translate(-3 -3)"/>
</svg>
</button>
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

      <div style="overflow-x:auto;">

        @if($message = Session::get('success'))
          <div class="alert alert-success">
            <p>{{$message}}</p>
          </div>
        @endif

      <table class="content-table">
        <tr>
          <th>Cousre code</th>
          <th>Course Name</th>
          <th>Size</th>
          <th>Special Req : Table</th>
          <th>Special Req : Venue</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>

        @foreach($posts as $row)
          <tr>
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
