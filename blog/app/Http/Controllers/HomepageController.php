<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    //
    public function services()
    {
	    $this->data['title1'] = 'DỊCH VỤ';
	    $services_data = DB::table('services')
	    				->select('id', 'image_name', 'urlservices', 'title', 'content')
	    				->get();

	   	$this->data['title2'] = 'CONCEPT';
	    $concept_data = DB::table('concept')
	    				->select('id', 'image_name', 'urlconcept', 'title', 'content')
	    				->get();

	    $this->data['concept'] = $concept_data;
	    $this->data['services'] = $services_data;

	    return view('layouts.home', $this->data);
    }
}

