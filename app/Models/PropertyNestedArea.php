<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class PropertyNestedArea extends Model
{
    
    protected $table = "property_nested_areas";
    protected $guarded = [];

    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $translations = $this->translations->where('lang', $lang)->first();
        return $translations != null ? $translations->$field : $this->$field;
    }
    
    public function translations(){
        return $this->hasMany(PropertyNestedAreaTranslation::class,'ref');
    }


    public function country(){
       
        $country = $this->area && $this->area->city && $this->area->city->state && $this->area->city->state->country ? $this->area->city->state->country : null;
        return $country;
    }

    public function state(){
       
        $state = $this->area && $this->area->city && $this->area->city->state ? $this->area->city->state : null;
        return $state;        
    }

    public function city(){
       
        $city = $this->area && $this->area->city ? $this->area->city : null ;
        return $city;        
    }

    public function area()
    {
        return $this->belongsTo(PropertyArea::class,'parent','id');
    }



    public function products(){
    	return $this->hasMany(Product::class, 'nested_area_id');
    }

     public function publish() {
        return $this->products()->where('published', 1);
    }
       
}