<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class searchtitle extends Model
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
       'urlservices',
       'image_name',
   ];

   // 
   protected $table='services';
}