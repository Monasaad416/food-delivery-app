<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'password', 'region_id','pin_code');

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function notificationTokens()
    {
        return $this->morphMany('App\Models\NotificationToken', 'notification_tokenable');
    }

}
