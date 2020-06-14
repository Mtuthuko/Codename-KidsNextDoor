<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clashes;

class ClashesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clashes = Clashes::all();

        return view('dashboard.ego',['clashes' => $clashes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // /echo $id;
        //
        //
        $clashes = Clashes::where('id','=', $id)->get();
        if($clashes != "")
        {
            return view('dashboard.clash.edit',['clashes' => $clashes]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        //
        // code...
        //print_r($req->input());
        //SQL CODE TO UPLOAD TO DB
        $clash = new Clashes;
        $clash->clash_status = $req->get('status');

        $clash->clash_status;
        //$clash->resolved_date= \;

        //$clash->update;

            
        return redirect()->route('home') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
