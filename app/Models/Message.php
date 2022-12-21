<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{

    protected $table = 'messages';
    public $timestamps = true;

    use SoftDeletes;

    const COMPLAIN = 1;
    const SUGGESTION = 2;
    const INQUIRY = 3;

    public function label()
    {
        return match($this->type)
        {
            self::COMPLAIN => 'شكوي',
            self::SUGGESTION => 'إقتراح',
            self::INQUIRY => 'إستعلام',

            default => 'unknown',
        };
    }

    public static function types(){
        return [self::COMPLAIN,self::SUGGESTION,self::INQUIRY];
    }


    protected $dates = ['deleted_at'];
    protected $fillable = array('email', 'phone', 'content', 'type', 'name');

    protected $casts = [
        'type' => 'int',
    ];

}
