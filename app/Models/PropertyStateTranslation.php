<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PropertyStateTranslation extends Model
{
    protected $table = "property_state_translations";
    protected $guarded = [];


    public function state(){
        return $this->belongsTo(PropertyState::class,'ref');
    }

}
