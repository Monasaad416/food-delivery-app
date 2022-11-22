<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationToken extends Model 
{

    protected $table = 'notification_tokens';
    public $timestamps = true;
    protected $fillable = array('device_token', 'device_type');

    public function notification_tokenable()
    {
        return $this->morphTo();
    }

}