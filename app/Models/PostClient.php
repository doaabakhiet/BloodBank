<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostClient extends Model 
{

    protected $table = 'post_client';
    protected $fillable=['post_id','client_id'];

}