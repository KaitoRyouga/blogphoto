<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\services;
use App\searchtitle;

class HomeSearchController extends Controller
{
   public function searchFullText(Request $request)
   {
      if ($request->search != '') {
          $data = searchtitle::FullTextSearch('urlservices', $request->search)->get();
          return view('admin.services.search')->with('Listsearch', $data);
      }
   }
}
