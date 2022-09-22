<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';

    protected $fillable = ['slider_title','slider_text2','slider_text2','image_name'];

 
	
	 public $timestamps = false;
    
}
