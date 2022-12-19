<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\UserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Shanmuga\LaravelEntrust\Traits\LaravelEntrustRoleTrait;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,LaravelEntrustRoleTrait,UserTrait;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    public function setPasswordAttribute($value){
        $this->attributes['password']=bcrypt($value);
    }
    protected $appends=['roles_list'];
    public function getRolesListAttribute(){
        return $this->roles()->pluck('id')->toArray();
    }
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role' );
    }
    // public function hasRole($name){
    //     return Auth::user()->roles()->where();
    // }
    // public function hasPermission($permission) {
    //     $r=$permission->roles;
    //     dd($r);
    // }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
