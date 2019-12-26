<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\concept;
use App\searchconcepttitle;

class HomeSearchConceptController extends Controller
{

   public function searchFullText(Request $request)
   {
      if ($request->search != '') {
          $data = searchconcepttitle::FullTextSearch('title', $request->search)->get();
          return view('admin.concept.search')->with('Listsearch', $data);
      }
   }

}
