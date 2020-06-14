@extends('layouts.app')

@section('content')


<title>Dashboard EGO</title>
<link rel="stylesheet" href="/css/home.css">

<h1 style="text-align: center;color:white">
    Dashboard EGO
</h1>


<div class="dash_main_body">
    <h1 style="margin-top: 10px;color: rgba(0, 0, 0, 0.9)" >View Clashes</h1>
    <div class="dash_grid">
        <div class="grid_item" id="clashes">
            <div class="grid-item-heading">
                <h2>Unresolved</h2>
            </div>
        
            <div class="clashes-container">
            @foreach ($clashes as $item)
             @if ($item['clash_status'] == "1")
                <div class="clash-item" draggable="true" id="clash" ondragstart="drag(event)">
                    <div class="clash-detials">
                        <div id='clash_id' style="display: inline-block; visibility: collapse">{{{$item['id']}}}</div>
                        <p> {{{$item['details']}}}</p>

                        <p class="clash-date">
                            Created on: {{{$item['clash_created']}}}
                        </p>
                    </div>
                <div class="btn-view-clash"><a href="/home/clash/{{{$item['id']}}}/edit"> View details<a> </div>
                </div>
             @endif
            
            @endforeach
           
            <div class="clash-item" id="clash" draggable="true" id="clash" ondragstart="drag(event)" ondragstart="dragStart(event)">
                <div class="clash-detials">
                    <p>Details</p>
                    <p class="clash-date">
                        Created on:
                    </p>
                </div>
                <div class="btn-view-clash"> View details</div>
            </div>
            
            </div>

        </div> 
        <div class="grid_item resolved">
            <div class="grid-item-heading">
                <h2>Resolved</h2>
            </div>

            <div class="clashes-container"  id="resolved" ondragover="allowDrop(event)" ondrop="drop(event)">
            @foreach ($clashes as $item)
                @if($item['clash_status'] == "0")
                    
                    <div class="clash-item-resolved" draggable="true" id="clash" ondragstart="drag(event)">
                        <div class="clash-detials">
                            
                            <div id='clash_id' style="display: inline-block; visibility: collapse">{{{$item['id']}}}</div>
                            <p> {{{$item['details']}}}</p>

                            <p class="clash-date">
                                Created on: {{{$item['clash_created']}}}
                            </p>
                        </div>
                        <div class="btn-view-clash"><a href="/home/clashes/{{{$item['id']}}}/edit"> View details<a> </div>
                    </div>
                @endif  
            @endforeach
            </div>
        </div>
    </div>
<div class="optionMenu" >
    <div class="dash_body">
        <div class="dash_option">
        <a href="./exambooking"> View Bookings</a>
        </div>
    </div>
    <div class="dash_body">
        <div class="dash_option">
        <a href="">Generate Exam timetable</a>
        </div>
    </div>
</div>
</div>
@endsection

<script type="text/javascript" src="/js/ego_dashboard.js"></script>