<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class searchconcepttitle extends Model
{
   use traits\FullTextSearch;

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'title',
       'content',
       'urlconcept',
       'image_name',
   ];

   // 
   protected $table='concept';
}