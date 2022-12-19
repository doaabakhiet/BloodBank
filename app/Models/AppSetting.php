<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppSetting extends Model 
{

    protected $table = 'app_settings';
    protected $fillable=['phone','email','facebook','instagram','youtube','about_app','twitter'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];



}