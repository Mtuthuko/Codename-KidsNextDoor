<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;
class Students extends Controller
{
    //
    public function list($value='')
    {
      // code...
      return Student::all();
    }
}
