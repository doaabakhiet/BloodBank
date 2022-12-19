<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonationRequest extends Model 
{

    protected $table = 'donation_requests';
    protected $fillable=[
        'client_id',
        'name',
        'bloodtype_id',
        'num_of_bags',
        'city_id',
        'longtitude',
        'latitude',
        'phone',
        'notes',
        'age'
      ];
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public function getCreatedAtAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('l').' '.Carbon::parse($timestamp)->toDateString();
    }
    public function bloodtype()
    {
        return $this->belongsTo('App\Models\BloodType','bloodtype_id');
    }

    public function cities()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public function clients()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

}