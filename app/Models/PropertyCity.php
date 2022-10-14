<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;
class PropertyCity extends Model
{

    protected $table = "property_cities";
    protected $guarded = [];

    public function getTranslation($field = '', $lang = false){

        $lang = $lang == false ? App::getLocale() : $lang;
        $translations = $this->translations->where('lang', $lang)->first();
        return $translations != null ? $translations->$field : $this->$field;
    }
    
    public function translations(){
        return $this->hasMany(PropertyCityTranslation::class,'ref');
    }

    public function country(){
       
        $country = $this->state && $this->state->country ? $this->state->country : null;
        return $country;
    }
 
    public function state()
    {
        return $this->belongsTo(PropertyState::class,'state_id','id');
    }

    public function area()
    {
        return $this->hasMany(PropertyArea::class,'city_id','id');
    }

    public function products(){
    	return $this->hasMany(Product::class, 'city_id');
    }

    public function publish() {
        return $this->products()->where('published', 1);
    }
    
}