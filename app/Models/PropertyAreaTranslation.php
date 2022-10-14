<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PropertyAreaTranslation extends Model
{
    protected $table = "property_area_translations";
    protected $guarded = [];

    public function area(){
        return $this->belongsTo(PropertyArea::class,'ref');
    }

}