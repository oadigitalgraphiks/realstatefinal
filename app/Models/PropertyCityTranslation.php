<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PropertyCityTranslation extends Model
{

    protected $table = "property_city_translations";
    protected $guarded = [];

    public function state(){
        return $this->belongsTo(PropertyCity::class,'ref');
    }

}
