<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Client extends Authenticatable
{
    use Notifiable;
    protected $guard = "clients";
    protected $table = 'clients';
    protected $fillable = ['pin_code','name','email','birthdate','bloodtype_id','lastdonation_date','city_id','phone','password','password_confirmation'];
    use SoftDeletes;
    protected $hidden = [
        'password','password_confirmation','api_token'
    ];
    protected $dates = ['deleted_at'];
    public function getCreatedAtAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('l').' '.Carbon::parse($timestamp)->toDateString();
    }
    public function setPasswordAttribute($value){
        $this->attributes['password']=bcrypt($value);
    }
    public function setPasswordConfirmationAttribute($value){
        $this->attributes['password_confirmation']=bcrypt($value);
    }

    public function cities()
    {
        return $this->belongsTo('App\Models\City','city_id');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification')->withPivot('isread');
    }

    public function governates()
    {
        return $this->belongsToMany('App\Models\Governate');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post', 'post_client');
    }

    public function bloodTypes()
    {
        return $this->belongsToMany('App\Models\BloodType', 'bloodtype_clients','client_id','bloodtype_id');
    }

    public function donationRequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }
    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType', 'bloodtype_id','id');
    }

    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }

}