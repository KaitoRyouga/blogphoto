<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Category;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    public function index()
    {

        $this->data['title'] = 'List category';
        $listCate = DB::table('categories')
            ->orderBy('id', 'desc')
            ->paginate(10);//phan trang
        $this->data['listCate'] = $listCate;
        return view('admin.category.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title'] = "Add Category";
        $listCate = DB::table('categories')
            ->orderBy('id','desc')->get();
        $this->data['listCate'] = $listCate;
        return view('admin.category.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = [
            'txtName' => 'required'
        ];
        $validator = Validator::make(Request::all(), $rule);
        if ($validator->fails())
        {
            return Redirect::to('admin/category/create')
                ->withErrors($validator);
        } else {
            $category = new Category;
            $category->name = Request::get('txtName');
            $category->slug = Request::get('txtSlug');
            $category->desc = Request::get('txtDesc');
            $category->parent_id = Request::get('parent_id');
            $category->meta_title = Request::get('meta_title');
            $category->meta_keywords = Request::get('meta_keywords');
            $category->meta_description = Request::get('meta_description');
            $category->save();
            Session::flash('message', "Successfully created category");
            return Redirect::to('admin/category');
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
        $category = Category::find($id);
        $this->data['title'] = 'Edit Category';
        $this->data['category'] = $category;
        $this->data['listCate'] = DB::table('categories')
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.category.edit', $this->data);
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
            'txtName' => 'required'
        ];
        $validator = Validator::make(Request::all(), $rule);
        if ($validator->fails())
        {
            return Redirect::to('admin/category/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            $category = Category::find($id);
            $category->name = Request::get('txtName');
            $category->slug = Request::get('txtSlug');
            $category->desc = Request::get('txtDesc');
            $category->parent_id = Request::get('parent_id');
            $category->meta_title = Request::get('meta_title');
            $category->meta_keywords = Request::get('meta_keywords');
            $category->meta_description = Request::get('meta_description');
            $category->save();
            Session::flash('message', "Successfully edited category");
            return Redirect::to('admin/category');
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
        $category = Category::find($id);
        $category->delete();
        Session::flash('message', "Successfully delete category");
        return Redirect::to('admin/category');
    }
}