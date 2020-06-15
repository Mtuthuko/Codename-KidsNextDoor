@extends('layouts.layout')
@section('content')





            <div class="content">



              <!-- Styles -->
                <link href="/css/loader.css" rel="stylesheet">


                
                  <div class="loader-wrapper">

                    <ul style="align-self:center;padding:0 2px; font-size: 40px;">

                      <ul>
                    <div style="width: 72% ; padding:45px;background-color:rgba(150, 150, 150, 0.6) ; border-radius:10px">

                      <img  src ="https://www.wits.ac.za/media/wits-university-style-assets/images/wits-logo.png " alt="wits logo">

                    </div>
                    </ul>
                    <div class="title m-b-md" style="font-weight: bold;">
                      Exam Scheduler -
                      @if (Route::has('login'))
                        <!--  <div class="top-right links">-->
                              @auth
                                  <a href="{{ url('/home') }}" style="color:silver;">Home</a>
                              @else
                                  <a href="{{ route('login') }}" style="color:silver;">Login</a>

                                <!--  @if (Route::has('register'))
                                      <a href="{{ route('register') }}">Register</a>
                                  @endif
                                -->
                              @endauth
                        <!--  </div>-->
                      @endif
                    </div>

                          <span class="loader">
                            <span class="loader-inner">

                          </span>

                        </span>

                    </ul>
                  </div>
                  

                  <!--Loading cube-->
                  <script>
                    $(window).on("load",function(){
                      $(".loader-wrapper").fadeOut("slow");
                      });
                  </script>

                  <footer>
                    copyright 2020 - CodeName: Kids Nextdoor
                  </footer>






            </div>
@endsection
