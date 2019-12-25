<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\services;

class AdminServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'DỊCH VỤ';
        $servicesInfo = DB::table('services')
            ->select('image_name', 'urlservices', 'title', 'content')
            ->paginate(10);
        $this->data['listServices'] = $servicesInfo;
        $sidebar = DB::table('concept')
                ->select('title')
                ->get();
        $this->data['sidebar'] = $sidebar;
        return view('admin.services.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title'] = 'Add new services';
        $sidebar = DB::table('concept')
                ->select('title')
                ->get();
        $this->data['sidebar'] = $sidebar;
        // $listservices = DB::table('services')->select('image_name', 'urlservices')->get();
        // $this->data['listservices'] = $listservices;
        return view('admin.services.create', $this->data);
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
            return Redirect::to('admin/services/create')
                ->withErrors($validator);
        } else {
            $services = new services;
            $url_services = str_replace(' ', '-', Request::get('txtName'));
            $services->urlservices = $url_services;
            $services->image_name = Request::get('filename');
            $services->title = Request::get('title');
            $services->content = Request::get('content');
            $services->save();
            Session::flash('message', "Successfully created services");
            return Redirect::to('admin/services');
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
        $services = services::where('urlservices', "$id")->first();
        $this->data['title'] = 'Edit services';
        $this->data['services'] = $services;
        $sidebar = DB::table('concept')
                ->select('title')
                ->get();
        $this->data['sidebar'] = $sidebar;
        return view('admin.services.edit', $this->data);
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
            return Redirect::to('admin/services/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            $services = services::where('urlservices', "$id")->first();
            $services->urlservices = Request::get('txtName');
            $services->image_name = Request::get('filename');
            $services->title = Request::get('title');
            $services->content = Request::get('content');
            $services->save();
            Session::flash('message', "Successfully edited services");
            return Redirect::to('admin/services');
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
        $services = services::where('urlservices', "$id")->first();
        $services->delete();
        Session::flash('message', "Successfully delete category");
        return Redirect::to('admin/services');
    }
}
