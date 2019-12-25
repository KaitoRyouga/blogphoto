<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\conceptregister;

class AdminConceptRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'CONCEPT PROMOTION';
        $conceptpromotionInfo = DB::table('conceptregister')
            ->select('price', 'title')
            ->paginate(10);

        $this->data['listconceptpromotion'] = $conceptpromotionInfo;
        return view('admin.conceptregister.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title'] = 'Add new concept promotion';
        return view('admin.conceptregister.create', $this->data);
    }

    public function store(Request $request)
    {
        $rule = [
            'price' => 'required',
            'title' => 'required',
        ];
        $validator = Validator::make(Request::all(), $rule);
        if ($validator->fails())
        {
            return Redirect::to('admin/conceptregister/create')
                ->withErrors($validator);
        } else {
            $concept = new conceptregister;
            $concept->price = Request::get('price');
            $concept->title = Request::get('title');
            $concept->save();
            Session::flash('message', "Successfully created concept promotion");
            return Redirect::to('admin/conceptregister');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $concept = conceptregister::where('title', "$id")->first();
        $this->data['title'] = 'Edit concept';
        $this->data['concept'] = $concept;
        return view('admin.conceptregister.edit', $this->data);
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
            'price' => 'required',
            'title' => 'required',        ];
        $validator = Validator::make(Request::all(), $rule);
        if ($validator->fails())
        {
            return Redirect::to('admin/conceptregister/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            $concept = conceptregister::where('title', "$id")->first();
            $concept->price = Request::get('price');
            $concept->title = Request::get('title');
            $concept->save();
            Session::flash('message', "Successfully edited concept");
            return Redirect::to('admin/conceptregister');
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
        $concept = conceptregister::where('title', "$id")->first();
        $concept->delete();
        Session::flash('message', "Successfully delete category");
        return Redirect::to('admin/conceptregister');
    }
}
