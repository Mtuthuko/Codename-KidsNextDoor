<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\Bookings;
use App\Exams;
use App\Venue;
use App\Clashes;
use App\Student;
use App\SearchDB;

class StudentController extends Controller
{
  //edit Database
  public function editData($id)
  {

    $student = SearchDB::find($id);

    if(strlen($student) > 0)
    {
        return view('exambookings.edit',compact('student','id'));
    }
    else
    {
        return view('exambookings.dashboard');

    }


  }

  //Update database
  public function updateData(Request $request, $id)
  {
    $this->validate($request,[
      'size'=>'required',
      'special_request_table'=>'required'
    ]);

    $student = SearchDB::find($id);
    $student->size=$request->get('size');
    $student->time=$request->get('time');
    $student->duration=$request->get('duration');
    $student->paperno=$request->get('paperno');
    $student->special_request_table=$request->get('special_request_table');
    $student->special_request_vanue=$request->get('special_request_vanue');
    $student->save();
   return redirect('/home')->with('success','Data Updated');
  }

  //Delete from Database
  public function destroyData($id)
  {
    $student = SearchDB::find($id);
    $student->delete();
    return redirect('/home')->with('success','Data Successfully Deleted');
  }
}
