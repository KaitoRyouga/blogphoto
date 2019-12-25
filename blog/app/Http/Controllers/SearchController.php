<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\concept;
use App\services;

class SearchController extends Controller
{
	public function searchByName(Request $request)
	{
	    $SearchConcept = concept::where('title', 'like', '%' . $request->q . '%')->get();
	    echo $SearchConcept;
	    $SearchServices = services::where('content', '%' . $request->q . '%')->get();
	    return response()->json($SearchConcept); 
	}
}
