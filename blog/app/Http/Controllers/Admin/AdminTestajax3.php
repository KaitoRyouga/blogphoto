<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\test3;
use App\conceptregister;

class Admintestajax3 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $test3 = DB::table('test3')
            ->select('test3')
            ->get();

        $conceptregister = DB::table('conceptregister')
                ->select('price', 'title')
                ->get();

        $this->data['conceptregister'] = $conceptregister;
        // 
        foreach ($test3 as $key => $value) {
        	$test3concept = $value->test3;        
        }

        $conceptpromotioninfo = DB::table('conceptregisterpromotion')->where('tag', str_replace(' ', '-', $test3concept))
            ->select('promo', 'tag')
            ->get();

        $this->data['test3'] = $test3;
        $this->data['listconceptpromotion'] = $conceptpromotioninfo;
        return view('admin.testajax3', $this->data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $test3ajax = test3::where('test3', "$id")->first();
        $this->data['title'] = 'Edit test3';
        $this->data['test3'] = $test3ajax;
        return view('admin.testajax3', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $test3ajax = test3::where('test3', $id)->first();
        $test3ajax->test3 = Request::get('id');
        $test3ajax->save();
        Session::flash('message', "Successfully edited test3ajax");
        return Redirect::to('admin/registerpromotion');
    }
}