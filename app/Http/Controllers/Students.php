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
class Students extends Controller
{
    //
    public function list($value='')
    {
      // code...
      return Student::all();
    }

     public function search(Request $request)
    {
      $search = $request->get('search');
      
      $exam = Exams::where('course_code', 'like', '%'.$search.'%')->paginate(50);

      return view('dashboard.student',['bookings' => $exam]);
      //return view('exambookings.dashboard',compact('posts'));

    }
}
