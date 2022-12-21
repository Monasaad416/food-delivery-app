<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;

    use SoftDeletes;

    const PENDING = 1;
    const ACCEBTED = 2;
    const REJECTED = 3;
    const DELIVERED = 4;
    const DECLINED = 5;

    public function label()
    {
        return match($this->status)
        {
            self::PENDING => 'تحت الدراسة',
            self::ACCEBTED => 'تمت الموافقة',
            self::REJECTED => 'مرفوض',
            self::DELIVERED => 'تم الإستلام ',
            self::DECLINED => 'مسترجع',

            default => 'unknown',
        };
    }

    public function style()
    {
        return match($this->status)
        {
            self::PENDING => 'warning',
            self::ACCEBTED => 'info',
            self::REJECTED => 'danger',
            self::DELIVERED => 'success',
            self::DECLINED => 'danger',

            default => 'unknown',
        };
    }

    public static function getStatus(){
        return [
                self::PENDING,
                self::ACCEBTED,
                self::REJECTED,
                self::DELIVERED,
                self::DECLINED
            ];
    }





    protected $dates = ['deleted_at'];
    protected $fillable = array('address', 'payment_method_id', 'notes', 'status', 'order_price', 'delivery_fees', 'total_price', 'commission_fees', 'client_id', 'restaurant_id');

    public function payment_method()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function items()
    {
        return $this->belongsToMany('App\Models\Item','order_details')
        ->withTimestamps()
        ->withPivot('qty','item_price','total_price','add_special');
    }

    public function notifications(){
        $this->hasMany('App\Models\Notification');
    }

}
