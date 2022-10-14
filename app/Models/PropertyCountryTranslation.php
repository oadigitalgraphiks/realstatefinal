<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class PropertyCountryTranslation extends Model
{
    protected $table = "property_country_translations";
    protected $guarded = [];

   

    public function country(){
        return $this->belongsTo(PropertyCountry::class,'ref');
      }
}
