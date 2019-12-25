<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\concept;

class AdminconceptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'CONCEPT';
        $conceptInfo = DB::table('concept')
            ->select('image_name', 'urlconcept', 'title', 'content')
            ->paginate(10);

        $sidebar = DB::table('concept')
                ->select('title')
                ->get();
        $this->data['sidebar'] = $sidebar;

        $this->data['listconcept'] = $conceptInfo;
        return view('admin.concept.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title'] = 'Add new concept';
        $sidebar = DB::table('concept')
                ->select('title')
                ->get();
        $this->data['sidebar'] = $sidebar;
        // $listconcept = DB::table('concept')->select('image_name', 'urlconcept')->get();
        // $this->data['listconcept'] = $listconcept;
        return view('admin.concept.create', $this->data);
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
            return Redirect::to('admin/concept/create')
                ->withErrors($validator);
        } else {
            $concept = new concept;
            $url_concept = str_replace(' ', '-', Request::get('txtName'));
            $concept->urlconcept = $url_concept;
            $concept->image_name = Request::get('filename');
            $concept->title = Request::get('title');
            $concept->content = Request::get('content');
            $concept->save();
            Session::flash('message', "Successfully created concept");
            return Redirect::to('admin/concept');
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
        return view('admin.concept.edit', $this->data);
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
            return Redirect::to('admin/concept');
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
        return Redirect::to('admin/concept');
    }
}
