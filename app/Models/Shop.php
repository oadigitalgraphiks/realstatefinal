<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{

  protected $with = ['user'];
  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function teams()
  {
      return $this->hasMany(PropertyTeam::class,'agency_id');
  }


}
