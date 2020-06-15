@extends('layouts.app')

@section('content')


<title>Dashboard EGO</title>
<link rel="stylesheet" href="/css/home.css">

<h1 style="text-align: center;color:white">
    Dashboard EGO
</h1>


<div class="dash_main_body">
    <h1 style="margin-top: 10px;color: rgba(0, 0, 0, 0.9)" >Clash Detials</h1>

    @foreach ($clashes as $item)
<form action="{{route('updateclash',$item['id'])}}"  method="post" class="form-clash"> 
    {{csrf_field()}}
        <input type="hidden" name="_method" value="PATCH" />
    <div class="edit-clash">

                <div class="clash-detials">
                    <h1>Detials:</h1>
                   <h3> {{{$item['details']}}} <h3>
                </div>
    
                <div class="clash-dates">
                    <h4>Dates:</h4>
                    <p> Date created: {{{$item['clash_created']}}}</p>
                    <p> Date resolved: {{{$item['resolved_date']}}}</p>       
                </div>
                <div class="clash-controls" >
                    <label for="Selector"><h1 class="black-font">Change status:</h1></label>
                    <select  class="clash-selector" name="status">
                    <option value="{{{$item['clash_status']}}}">STATUS</option>
                        <option value="1">Unresolved</option>
                        <option value="0">Resolved</option>
                        </select>>
                </div>
                @endforeach 
                
            <div class="clash-status">
                <h2>Current Status:<h2>
                @if ($item['clash_status'] == "0")
                   <h2 class="statusOn">Resolved</h2>
                @else
                <h2 class="statusOff">Unresolved</h2>
                @endif
            </div>

            <div>
            <input type ="submit" value="UPDATE" class="dash_option btn-clash">
            </div>
            <div class="btn-back dash_option btn-clash ">
                <a href="/home">Back</a>
            </div>
            </div>

        </form>
        
</div>
@endsection
