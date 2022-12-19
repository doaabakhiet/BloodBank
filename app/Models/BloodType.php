<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model 
{

    protected $table = 'blood_types';
    protected $fillable = array('name');

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client', 'bloodtype_client');
    }

    public function getclients()
    {
        return $this->hasMany('App\Models\Client');
    }

    public function notifications()
    {
        return $this->belongsTo('App\Models\Notification');
    }
    public function donationRequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

}