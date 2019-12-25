<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\conceptpromotionfree;
use App\test;

class AdminConceptPromotionFreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->data['title'] = 'CONCEPT PROMOTION FREE';
        $conceptpromotionfreeInfo = DB::table('conceptpromotionfree')
            ->select('free', 'tag')
            ->get();

        $test = DB::table('test')
            ->select('test')
            ->get();

        $sidebar = DB::table('concept')
                ->select('title')
                ->get();
        $this->data['sidebar'] = $sidebar;
        $query = str_replace(' ', '-', $request::query('concept'));
        $this->data['query'] = $query;
        $this->data['test'] = $test;
        $this->data['listconceptpromotionfree'] = $conceptpromotionfreeInfo;
        return view('admin.testajax', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->data['title'] = 'Add new concept promotion free';
        $conceptInfo = DB::table('concept')
                    ->select('urlconcept', 'title')
                    ->get();

        $test = DB::table('test')
            ->select('test')
            ->get();

        $sidebar = DB::table('concept')
                ->select('title')
                ->get();
        $this->data['sidebar'] = $sidebar;
        $this->data['test'] = $test;


        $this->data['listconceptInfo'] = $conceptInfo;
        return view('admin.conceptpromotion.free.create', $this->data);
    }

    public function store(Request $request)
    {
        $rule = [
            'conceptInfo' => 'required',
            'free' => 'required',
        ];
        $validator = Validator::make(Request::all(), $rule);
        if ($validator->fails())
        {
            return Redirect::to('admin/conceptpromotionfree/create')
                ->withErrors($validator);
        } else {
            $concept = new conceptpromotionfree;
            $conceptInfo = str_replace(' ', '-', Request::get('conceptInfo'));
            $concept->tag = $conceptInfo;
            $concept->free = Request::get('free');
            $concept->save();
            Session::flash('message', "Successfully created free promotion");
            // return Redirect::to('admin/free');
            return back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $concept = conceptpromotionfree::where('free', "$id")->first();
        // var_dump($concept->free);
        $this->data['title'] = 'Edit Concept Promotion Free';
        $this->data['concept'] = $concept;

        $test = DB::table('test')
            ->select('test')
            ->get();

        $sidebar = DB::table('concept')
                ->select('title')
                ->get();
        $this->data['sidebar'] = $sidebar;
        $query = str_replace(' ', '-', $request::query('concept'));
        $this->data['query'] = $query;
        $this->data['test'] = $test;

        return view('admin.conceptpromotion.free.edit', $this->data);
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
        $rule = [
            'txtName' => 'required',
        ];
        $validator = Validator::make(Request::all(), $rule);
        if ($validator->fails())
        {
            return Redirect::to('admin/conceptpromotionfree/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            $concept = conceptpromotionfree::where('free', "$id")->first();
            $concept->free = Request::get('txtName');
            $concept->save();
            Session::flash('message', "Successfully edited free promotion");
            return Redirect::to('admin/free');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $concept = conceptpromotionfree::where('free', "$id")->first();
        $concept->delete();
        Session::flash('message', "Successfully delete free promotion");
        return Redirect::to('admin/free');
    }
}
