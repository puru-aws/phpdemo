<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    protected $table = 'properties';

    protected $fillable = ['user_id','property_name','property_type','property_purpose','sale_price','rent_price','address','map_latitude','map_longitude','bathrooms','bedrooms','area','description','featured_image'];
    
    public static function getPropertyInfo($id) 
    { 
        return Properties::find($id);
    }
    
	public function scopeSearchByKeyword($query, $keyword,$purpose,$type)
    { 
			 
            if($keyword!='' and $purpose!='' and $type!='')
            {
                $query->where(function ($query) use ($keyword,$purpose,$type) {
                $query->where("status", "1")
                    ->where("property_purpose", "$purpose")
                    ->where("property_type", "$type")
                    ->orWhere("address", 'like', '%' .$keyword. '%')
                    ->orWhere("property_name", 'like', '%' .$keyword. '%');                      
                });
            }
            elseif ($purpose!='' and $type!='') 
            {
                        $query->where(function ($query) use ($keyword,$purpose,$type) {
                        $query->where("status", "1")
                            ->where("property_purpose", "$purpose")
                            ->where("property_type", "$type");                      
                        });
            }
            elseif ($purpose!='') 
            {
                        $query->where(function ($query) use ($keyword,$purpose,$type) {
                        $query->where("status", "1")->where("property_purpose", "$purpose");                      
                        });
            }
            elseif ($type!='') 
            {
                        $query->where(function ($query) use ($keyword,$purpose,$type) {
                        $query->where("status", "1")->where("property_type", "$type");                      
                        });
            }                                   
            else
            {
                $query->where(function ($query) use ($keyword,$purpose,$type) {
                $query->where("status", "1")
                    ->where("address", 'like', '%' .$keyword. '%')
                    ->orWhere("property_name", 'like', '%' .$keyword. '%');                      
                });
            }
 
        return $query;
    }		 
    
}
