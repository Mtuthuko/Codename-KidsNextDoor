<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Bookings;
use App\Exams;
use App\Venue;
use App\Clashes;
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
            $bookings = Exams::all();
            return view('dashboard.student',['bookings' => $bookings]);
        }
        elseif($user_role == '2')   //faculty staff
        {

            //This fetches all the venues from the database
            //$venues = Venue::all();

            //We return a view with venues
            return redirect('exambooking');
        }
        elseif($user_role == '3')   //EGO staff
        {
            $clashes = Clashes::all();

            return view('dashboard.ego',['clashes' => $clashes]);
            $home = new HomeController();
            //$this->egoDashboard();
        }

    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function egoDashboard()
    {
        $clashes = Clashes::all();
        if($clashes != "")
        {
            return view('dashboard.ego',['clashes' => $clashes]);
        }

        return view('dashboard.ego',['clashes' => $clashes]);
        //echo $user_role;
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
      $user->vanue = $req->venue;
      $user->paperno = $req->paperno;
      $user->startTime = $req->startTime;
      $user->endTime = $req->endTime;
      $user->tabletype = $req->tabletype;

      $user->save();

    // Redirecting the page to the home route defined in web.php ...
    return redirect()->route('home');

    }

    //Search Data on database
    public function search(Request $request)
    {

        $search = $request->get('search');

        $posts = SearchDB::where('code', 'like', '%'.$search.'%')->paginate(50);

        //return view('layouts.addcourses',compact('posts'));
       return view('exambookings.dashboard',compact('posts'));



    }

    //edit Database

}
