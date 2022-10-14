<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App;

class PropertyState extends Model
{

    protected $table = "property_states";
    protected $guarded = [];
    
    public function getTranslation($field = '', $lang = false){

        $lang = $lang == false ? App::getLocale() : $lang;
        $translations = $this->translations->where('lang', $lang)->first();
        return $translations != null ? $translations->$field : $this->$field;
    }
    
    public function translations(){
        return $this->hasMany(PropertyStateTranslation::class,'ref');
    }

    public function city()
    {
        return $this->hasMany(PropertyCity::class,'state_id','id');
    }

    public function country(){
        return $this->belongsTo(PropertyCountry::class, 'country_id', 'id');
    }

    public function products(){
    	return $this->hasMany(Product::class, 'state_id');
    }

    public function publish() {
        return $this->products()->where('published', 1);
    }

}