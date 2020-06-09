<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Bookings;
use App\Venue;

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
        /**
         * Get the user's role and display's the appropraite dashboard
         * 
         * returns an integer 
         * 1 = student, 2 = faculty staff, 3 = ego staff
         * 
         */
        $user_role = auth()->user()->user_role;

        if($user_role == '1')  //student
        {
            return view('dashboard.student');
        }
        elseif($user_role == '2')   //faculty staff
        {
                   
            //This fetches all the venues from the database
            $venues = Venue::all();

            //We return a view with venues
            return view('home',['venues' => $venues]);
        }
        elseif($user_role == '3')   //EGO staff
        {
            return view('dashboard.ego');
        }
        
    }

    public function dashboard()
    { 



        //echo $user_role;
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
      $user->vanue = $req->venue;
      $user->paperno = $req->paperno;
      $user->startTime = $req->startTime;
      $user->endTime = $req->endTime;
      $user->tabletype = $req->tabletype;

      $user->save();

    // Redirecting the page to the home route defined in web.php ...
    return redirect()->route('home');

    }
}
