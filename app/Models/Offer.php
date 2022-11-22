<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model 
{

    protected $table = 'offers';
    public $timestamps = true;
    // protected $dates = ['deleted_at'];
    protected $fillable = array('image', 'name', 'description', 'from_date', 'to_date', 'restaurant_id');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}