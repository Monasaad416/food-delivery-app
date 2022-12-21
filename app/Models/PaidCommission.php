<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaidCommission extends Model 
{

    protected $table = 'paid_commissions';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('restaurant_id', 'paid', 'payment_date', 'notes', 'bank_id');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function bank()
    {
        return $this->belongsTo('App\Models\Bank');
    }

}