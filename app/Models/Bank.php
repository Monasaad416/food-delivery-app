<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model 
{

    protected $table = 'banks';
    public $timestamps = true;
    protected $fillable = array('name', 'account_no');

    public function paidCommessions()
    {
        return $this->hasMany('App\Models\PaidCommession');
    }

}