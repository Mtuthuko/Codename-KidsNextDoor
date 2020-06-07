<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookings;
use App\Student;
use App\SearchDB;


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

    //Fetch data from DB
    public function list($value='')
    {
      // code...
      $courses = Student::all()->toArray();
      return view('exambookings.dashboard',compact('courses'));
    }


    //post data to database
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

    //Search Data on database
    public function search(Request $request)
    {
      $search = $request->get('search');
      $posts = SearchDB::where('code', 'like', '%'.$search.'%')->paginate(50);

      return view('exambookings.dashboard',compact('posts'));

    }
}
