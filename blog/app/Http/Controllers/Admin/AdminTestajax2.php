<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\test2;
use App\conceptpromotionother;

class Admintestajax2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $test2 = DB::table('test2')
            ->select('test2')
            ->get();

        $sidebar = DB::table('concept')
                ->select('title')
                ->get();

        $this->data['sidebar'] = $sidebar;
        // 
        foreach ($test2 as $key => $value) {
        	$test2concept = $value->test2;        
        }

		$conceptpromotionotherinfo = DB::table('conceptpromotionother')->where('tag', str_replace(' ', '-', $test2concept))
            ->select('other', 'name', 'tag')
            ->get();

        $this->data['test2'] = $test2;
        $this->data['listconceptpromotionother'] = $conceptpromotionotherinfo;
        return view('admin.testajax2', $this->data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $test2ajax = test2::where('test2', "$id")->first();
        $this->data['title'] = 'Edit test2';
        $this->data['test2'] = $test2ajax;
        $sidebar = DB::table('concept')
                ->select('title')
                ->get();
        $this->data['sidebar'] = $sidebar;
        return view('admin.testajax2', $this->data);
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
        $test2ajax = test2::where('test2', $id)->first();
        $test2ajax->test2 = Request::get('id');
        $test2ajax->save();
        Session::flash('message', "Successfully edited test2ajax");
        return Redirect::to('admin/other');
    }
}