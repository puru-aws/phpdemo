<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyGallery extends Model
{
    protected $table = 'property_gallery';

    protected $fillable = ['property_id','image_name'];

   
    public $timestamps = false;
	 
}
