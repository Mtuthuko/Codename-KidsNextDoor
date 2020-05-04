<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookings;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function save(Request $req)
    {
      // code...
      //print_r($req->input());
      //SQL CODE TO UPLOAD TO DB
      $user = new Bookings;
      $user->title = $req->title;
      $user->course = $req->course;
      $user->discription = $req->discription;
      $user->vanue = $req->vanue;
      $user->paperno = $req->paperno;
      $user->startTime = $req->startTime;
      $user->endTime = $req->endTime;
      $user->tabletype = $req->tabletype;

      $user->save();
      return view('home');


    }
}
