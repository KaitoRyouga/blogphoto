<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\conceptpromotion;

class AdminConceptPromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'CONCEPT PROMOTION';
        $conceptpromotionInfo = DB::table('conceptpromotion')
            ->select('tag', 'free', 'other', 'registerpromotion')
            ->paginate(10);

        $sidebar = DB::table('concept')
                ->select('title')
                ->get();
        $this->data['sidebar'] = $sidebar;

        $this->data['listconceptpromotion'] = $conceptpromotionInfo;
        return view('admin.conceptpromotion.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title'] = 'Add new concept promotion';
        $conceptInfo = DB::table('concept')
                    ->select('urlconcept', 'title')
                    ->get();
        $this->data['listconceptInfo'] = $conceptInfo;
        $sidebar = DB::table('concept')
                ->select('title')
                ->get();
        $this->data['sidebar'] = $sidebar;
        return view('admin.conceptpromotion.create', $this->data);
    }

    public function store(Request $request)
    {
        $rule = [
            'txtName' => 'required',
            'title' => 'required',
            'content' => 'required',
            'filename' => 'required',
        ];
        $validator = Validator::make(Request::all(), $rule);
        if ($validator->fails())
        {
            return Redirect::to('admin/conceptpromotion/create')
                ->withErrors($validator);
        } else {
            $concept = new concept;
            $url_concept = str_replace(' ', '-', Request::get('txtName'));
            $concept->urlconcept = $url_concept;
            $concept->image_name = Request::get('filename');
            $concept->title = Request::get('title');
            $concept->content = Request::get('content');
            $concept->save();
            Session::flash('message', "Successfully created concept promotion");
            return Redirect::to('admin/conceptpromotion');
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
        $concept = concept::where('urlconcept', "$id")->first();
        $this->data['title'] = 'Edit concept';
        $this->data['concept'] = $concept;
        $sidebar = DB::table('concept')
                ->select('title')
                ->get();
        $this->data['sidebar'] = $sidebar;
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
            'title' => 'required',
            'content' => 'required'
        ];
        $validator = Validator::make(Request::all(), $rule);
        if ($validator->fails())
        {
            return Redirect::to('admin/concept/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            $concept = concept::where('urlconcept', "$id")->first();
            $concept->urlconcept = Request::get('txtName');
            $concept->image_name = Request::get('filename');
            $concept->title = Request::get('title');
            $concept->content = Request::get('content');
            $concept->save();
            Session::flash('message', "Successfully edited concept");
            return Redirect::to('admin/conceptpromotion');
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
        $concept = concept::where('urlconcept', "$id")->first();
        $concept->delete();
        Session::flash('message', "Successfully delete category");
        return Redirect::to('admin/conceptpromotion');
    }
}
