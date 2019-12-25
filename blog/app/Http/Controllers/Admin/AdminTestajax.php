<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\test;
use App\conceptpromotionfree;

class AdminTestajax extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $test = DB::table('test')
            ->select('test')
            ->get();

        $sidebar = DB::table('concept')
                ->select('title')
                ->get();
        $this->data['sidebar'] = $sidebar;
        
        foreach ($test as $key => $value) {
        	$testconcept = $value->test;        
        }

		$conceptpromotionfreeInfo = DB::table('conceptpromotionfree')->where('tag', str_replace(' ', '-', $testconcept))
            ->select('free', 'tag')
            ->get();

        $this->data['test'] = $test;
        $this->data['listconceptpromotionfree'] = $conceptpromotionfreeInfo;
        return view('admin.testajax', $this->data);
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
            $testajax = test::where('test', $id)->first();
            $testajax->test = Request::get('id');
            $testajax->save();
            Session::flash('message', "Successfully edited testajax");
            return Redirect::to('admin/free');
    }
}