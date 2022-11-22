<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class Restaurant extends Authenticatable
{
    use HasApiTokens;

    const OPENED = 1;
    const CLOSED = 2;

    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password', 'region_id', 'min_order_charge', 'delivery_fees', 'whats_app_url', 'phone', 'image', 'availability','pin_code');

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }

    public function commission()
    {
        return $this->hasMany('App\Models\PaidCommession');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category')->withTimestamps();
    }

    public function notificationTokens()
    {
        return $this->morphMany('App\Models\NotificationToken', 'notification_tokenable');
    }

}
