<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model 
{

    protected $table = 'reviews';
    public $timestamps = true;
    protected $fillable = array('client_id', 'restaurant_id', 'comment', 'rating');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function retaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}