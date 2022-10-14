<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    //
    public function products(){
    	return  $this->hasMany(Product::class, 'country_id');
    }
}