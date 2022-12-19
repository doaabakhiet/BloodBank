<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model 
{

    protected $table = 'contacts';
    protected $fillable=['client_id','title','content'];
    public function clients()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }
    public function getCreatedAtAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('l').' '.Carbon::parse($timestamp)->toDateString();
    }

}