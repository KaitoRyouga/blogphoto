<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class searchpromotiontitle extends Model
{
   use traits\FullTextSearch;

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
   		'price',
       'title'
   ];

   // 
   protected $table='conceptregister';
}