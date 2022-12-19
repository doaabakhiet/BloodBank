<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationGovernate extends Model 
{

    protected $table = 'client_governate';
    protected $fillable=['client_id','governate_id'];

}