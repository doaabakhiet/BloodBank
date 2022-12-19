<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodtypeClient extends Model 
{

    protected $table = 'bloodtype_clients';
    protected $fillable=['client_id','bloodtype_id'];

}