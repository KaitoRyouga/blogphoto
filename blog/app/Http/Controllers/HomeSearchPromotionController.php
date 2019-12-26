<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\conceptregister;
use App\searchpromotiontitle;

class HomeSearchPromotionController extends Controller
{
   public function searchFullText(Request $request)
   {
      if ($request->search != '') {
          $data = searchpromotiontitle::FullTextSearch('title', $request->search)->get();
          return view('admin.conceptregister.search')->with('Listsearch', $data);
      }
   }
}
