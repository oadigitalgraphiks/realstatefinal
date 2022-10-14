<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{

    use SoftDeletes;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $fillable = [
        'file_original_name', 'file_name', 'user_id', 'extension', 'type', 'file_size',
    ];

     //Add extra attribute
    //  protected $attributes = ['url'];

     //Make it available in the json response
    //  protected $appends = ['url'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    //implement the attribute
    // public function getURLAttribute()
    // {
    //      return asset('public/'.$this->file_name);
    // }



}

