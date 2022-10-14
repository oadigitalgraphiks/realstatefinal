<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App;

class PropertyReport extends Model
{
    protected $table = "property_reports";
    protected $guarded = [];

    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $property_report_translation = $this->property_report_translations->where('lang', $lang)->first();
        return $property_report_translation != null ? $property_report_translation->$field : $this->$field;
    }

    public function property_report_translations(){
    	return $this->hasMany(PropertyReportTranslation::class);
    }

    public function property()
    {
        return $this->belongsTo(Product::class,'property_id','id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class,'agent_id','id');
    }
    
}