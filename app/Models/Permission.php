<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Shanmuga\LaravelEntrust\Models\EntrustPermission;

class Permission extends EntrustPermission
{
    use HasFactory;
    protected $fillable=['name','display_name','description'];
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role' ,'permission_role');
    }
}
