<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\conceptpromotionother;

class AdminConceptPromotionOtherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->data['title'] = 'CONCEPT PROMOTION OTHER';
        $conceptpromotionotherInfo = DB::table('other')
            ->select('name', 'tag')
            ->get();

        $sidebar = DB::table('concept')
                ->select('title')
                ->get();
        $this->data['sidebar'] = $sidebar;
        $query = str_replace(' ', '-', $request::query('concept'));
        $this->data['query'] = $query;

        $this->data['listconceptpromotionother'] = $conceptpromotionotherInfo;
        return view('admin.conceptpromotion.other.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->data['title'] = 'Add new concept promotion other';
        $conceptInfo = DB::table('concept')
                    ->select('urlconcept', 'title')
                    ->get();

        $sidebar = DB::table('concept')
                ->select('title')
                ->get();
        $test2 = DB::table('test2')
            ->select('test2')
            ->get();
        $this->data['sidebar'] = $sidebar;
        $this->data['test2'] = $test2;
        $query = str_replace(' ', '-', $request::query('concept'));
        $fullurl = $request::fullurl();
        $this->data['query'] = $query;
        $this->data['fullurl'] = $fullurl;


        $this->data['listconceptInfo'] = $conceptInfo;
        return view('admin.conceptpromotion.other.create', $this->data);
    }

    public function store(Request $request)
    {
        $rule = [
            'conceptInfo' => 'required',
            'other' => 'required',
            'name' => 'required',
        ];
        $validator = Validator::make(Request::all(), $rule);
        if ($validator->fails())
        {
            return Redirect::to('admin/conceptpromotionother/create')
                ->withErrors($validator);
        } else {
            $concept = new conceptpromotionother;
            $conceptInfo = str_replace(' ', '-', Request::get('conceptInfo'));
            $concept->tag = $conceptInfo;
            $concept->other = Request::get('other');
            $concept->name = Request::get('name');
            $concept->save();
            Session::flash('message', "Successfully created concept promotion");
            // return Redirect::to('admin/conceptpromotionother');
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
        $concept = conceptpromotionother::where('name', "$id")->first();
        // var_dump($concept->other);
        $this->data['title'] = 'Edit Concept Promotion Other';
        $this->data['concept'] = $concept;

        $sidebar = DB::table('concept')
                ->select('title')
                ->get();
        $this->data['sidebar'] = $sidebar;
        $query = str_replace(' ', '-', $request::query('concept'));
        $this->data['query'] = $query;

        return view('admin.conceptpromotion.other.edit', $this->data);
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
            return Redirect::to('admin/conceptpromotionother/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            $concept = conceptpromotionother::where('name', "$id")->first();
            $concept->name = Request::get('txtName');
            $concept->save();
            Session::flash('message', "Successfully edited concept");
            return Redirect::to('admin/conceptpromotionother?concept=' . $concept->tag);
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
        $concept = conceptpromotionother::where('name', "$id")->first();
        $concept->delete();
        Session::flash('message', "Successfully delete category");
        return Redirect::to('admin/conceptpromotionother?concept=' . $concept->tag);
    }
}
