<?php

namespace App\Calendar;

use App\Calendar;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $table = 'calendar_subscribers';

    protected $fillable = [
        'email',
        'permission',
    ];

    protected $dates = [
        'subscribed_at'
    ];

    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }
}

