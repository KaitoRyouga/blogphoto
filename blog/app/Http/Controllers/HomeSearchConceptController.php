<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\concept;
use App\searchconcepttitle;

class HomeSearchConceptController extends Controller
{

   public function search()
   {
       return view('layouts.testck');
   }

   public function searchFullText(Request $request)
   {
      if ($request->search != '') {
          $data = searchconcepttitle::FullTextSearch('title', $request->search)->get();
          foreach ($data as $key => $value) {
              echo '<a href="/admin/concept/'.$value->urlconcept.'/edit"><p style="color: red;font-size: 1em;background: cyan;padding: 0.1em;">' . $value->title . '</p></a>';
              // dd($value->title);
          }
          // return redirect('admin/concept')->with('listconcept', $data);
      }
   }
}
