<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $table = 'items';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'price', 'discount_price', 'preparation_time', 'image', 'restaurant_id');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order','order_details')
        ->withTimestamps()
        ->withPivot('qty','item_price','total_price','add_special');
    }

}
