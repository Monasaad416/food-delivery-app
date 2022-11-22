<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'body', 'is_read','order_id');

    public function notifiable()
    {
        return $this->morphTo();
    }


    public function order(){
        $this->belongsTo('App\Models\Order');
    }

}
