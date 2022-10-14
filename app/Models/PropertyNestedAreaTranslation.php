<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PropertyNestedAreaTranslation extends Model
{
    
    protected $table = "property_nested_area_translations";
    protected $guarded = [];

    public function nested_area(){
        return $this->belongsTo(PropertyNestedArea::class,'ref');
    }

}