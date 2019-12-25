<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\services;
use App\searchtitle;

class HomeSearchController extends Controller
{

   public function search()
   {
       return view('layouts.testck');
   }

   public function searchFullText(Request $request)
   {
      if ($request->search != '') {
          $data = searchtitle::FullTextSearch('title', $request->search)->get();
          foreach ($data as $key => $value) {
              echo '<a href="/admin/services/'.$value->urlservices.'/edit"><p style="color: red;font-size: 1em;background: cyan;padding: 0.1em;">' . $value->title . '</p></a>';
              // dd($value->title);
          }
          // return redirect('admin/services')->with('listServices', $data);
      }
   }
}
