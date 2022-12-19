<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Shanmuga\LaravelEntrust\Models\EntrustRole;

class Role extends EntrustRole
{
    use HasFactory;
    protected $fillable=['name','display_name','description'];
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission' ,'permission_role');
    }
    public function users()
    {
        return $this->belongsToMany('App\Models\User','role_user' );
    }
   
}
