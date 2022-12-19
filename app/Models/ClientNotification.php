<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientNotification extends Model
{

    protected $table = 'client_notification';
    protected $fillable = ['client_id', 'isread', 'notification_id'];

}
