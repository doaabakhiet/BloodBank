<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientGovernate extends Model
{
    use HasFactory;
    protected $table = 'client_governates';
    protected $fillable=['client_id','governate_id'];
}
