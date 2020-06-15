@extends('layouts.app')

  <!-- Testing Code for new dashboard view -->
@section('content')
  <div style="background-color: #0B3865;color:white;border: 1px solid black; padding:5px;border:2px solid white">
    <div class="col-md-15">
      <br />
      <h3>Edit Number of Students and Special Requests</h3>
      <br />
       @if(count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{$error}}</li>

            @endforeach
          </ul>

        </div>

      @endif

      <form class="" action="{{route('updatepage',$id)}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PATCH" />
        <div class="form-group">
          <label >Edit Number of Students</label>
          <input type="text" name="size" class="form-control" value="{{$student->size}}" placeholder="Enter Correct Number of Students" />

        </div>

        <div class="form-group">
          <label >Special Request Slot AM/PM</label>

              <select  name="time"  id ="time">
                    <option  value="Any Available slot" ></option>
                    <option value="AM">AM</option>
                    <option value="PM">PM</option>

                </select>

        </div>

        <div class="form-group">
          <label >Duration</label>

              <select  name="duration"  id ="duration">
                    <option  value="1H" >1H</option>
                    <option value="2H">2H</option>
                    <option value="3H">3H</option>
                    <option value="4H">4H</option>
                    <option value="5H">5H</option>
                    <option value="6H">6H</option>
                    <option value="7H">7H</option>
                    <option value="8H">8H</option>
                </select>

        </div>

        <div class="form-group">
          <label >Paper Number</label>

              <select  name="paperno"  id ="paperno">
                    <option  value="1" ></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>

        </div>

        <div class="form-group">
          <label >Type Of Table</label>

              <select  name="special_request_table"  id ="special_request_table">
                    <option  value="None" ></option>
                    <option value="Single Desk">Single Desk</option>
                    <option value="Double Desk">Double Desk</option>
                    <option value="Drawing Desk">Drawing Desk</option>
                </select>

        </div>

        <div class="form-group">
          <label >Venue Request</label>
          <input type="text" name="special_request_vanue" class="form-control" value="{{$student->special_request_vanue}}" placeholder="Enter Name of vanue or Type None if no special vanue is required" />

        </div>




        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Edit" />

        </div>

      </form>

    </div>





  </div>
@endsection
