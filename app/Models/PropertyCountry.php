<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App;

class PropertyCountry extends Model
{

    protected $table = "property_countries";
    protected $guarded = [];

    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $translations = $this->translations->where('lang', $lang)->first();
        return $translations != null ? $translations->$field : $this->$field;
    }
    
    public function translations(){
        return $this->hasMany(PropertyCountryTranslation::class,'ref');
    }


    //
    public function products(){
    	return $this->hasMany(Product::class, 'country_id');
    }

    public function publish() {
        return $this->products()->where('published', 1);
    }

    public function states(){
    	return $this->hasMany(PropertyState::class, 'country_id');
    }
}
