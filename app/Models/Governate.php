<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governate extends Model 
{

    protected $table = 'governates';
    protected $fillable=['name'];

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

}