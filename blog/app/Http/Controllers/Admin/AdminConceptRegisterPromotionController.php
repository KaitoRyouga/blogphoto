<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\conceptregisterpromotion;
use App\test33;

class AdminConceptRegisterPromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->data['title'] = 'CONCEPT PROMOTION FREE';
        $conceptpromotionfreeInfo = DB::table('conceptregisterpromotion')
            ->select('promo', 'tag')
            ->get();

        $test3 = DB::table('test3')
            ->select('test3')
            ->get();

        $register = DB::table('conceptregister')
                ->select('title')
                ->get();
        $this->data['register'] = $register;
        $this->data['test3'] = $test3;
        $this->data['listconceptpromotionfree'] = $conceptpromotionfreeInfo;
        return view('admin.testajax3', $this->data);
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

        $test3 = DB::table('test3')
            ->select('test3')
            ->get();

        $sidebar = DB::table('conceptregister')
                ->select('title')
                ->get();
        $this->data['sidebar'] = $sidebar;
        $this->data['test3'] = $test3;


        $this->data['listconceptInfo'] = $conceptInfo;
        return view('admin.conceptpromotion.create', $this->data);
    }

    public function store(Request $request)
    {
        $rule = [
            'conceptInfo' => 'required',
            'promo' => 'required',
        ];
        $validator = Validator::make(Request::all(), $rule);
        if ($validator->fails())
        {
            return Redirect::to('admin/conceptpromotion/create')
                ->withErrors($validator);
        } else {
            $concept = new conceptregisterpromotion;
            $conceptInfo = str_replace(' ', '-', Request::get('conceptInfo'));
            $concept->tag = $conceptInfo;
            $concept->promo = Request::get('promo');
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
        $concept = conceptregisterpromotion::where('promo', "$id")->first();
        // var_dump($concept->free);
        $this->data['title'] = 'Edit Concept Promotion Free';
        $this->data['concept'] = $concept;

        $test3 = DB::table('test3')
            ->select('test3')
            ->get();
        $this->data['test3'] = $test3;
        return view('admin.conceptpromotion.edit', $this->data);
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
            return Redirect::to('admin/conceptpromotion/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            $concept = conceptregisterpromotion::where('promo', "$id")->first();
            $concept->promo = Request::get('txtName');
            $concept->save();
            Session::flash('message', "Successfully edited free promotion");
            return Redirect::to('admin/registerpromotion');
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
        $concept = conceptregisterpromotion::where('promo', "$id")->first();
        $concept->delete();
        Session::flash('message', "Successfully delete free promotion");
        return Redirect::to('admin/registerpromotion');
    }
}
