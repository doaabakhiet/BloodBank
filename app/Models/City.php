<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model 
{

    protected $table = 'cities';
    protected $fillable=['name','governate_id'];
    public function governates()
    {
        return $this->belongsTo('App\Models\Governate', 'governate_id');
    }

    public function clients()
    {
        return $this->hasMany('App\Models\Client');
    }

    public function donation_requests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

}