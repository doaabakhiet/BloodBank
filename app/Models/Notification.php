<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model 
{

    protected $table = 'notifications';
    protected $fillable=['title','content','donation_request_id'];
    use SoftDeletes;
    protected $appends=array('created_at');
    protected $dates = ['deleted_at'];
    public function getCreatedAtAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('l').' '.Carbon::parse($timestamp)->toDateString();
    }
    public function donationRequests()
    {
        return $this->belongsTo('App\Models\DonationRequest', 'donation_request_id');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client', 'client_notification');
    }

}