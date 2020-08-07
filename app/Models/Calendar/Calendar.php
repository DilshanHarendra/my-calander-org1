<?php

namespace App;

use App\Calendar\Subscriber;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendars';

    protected $fillable = [
        'title',
        'description',
        'time_zone',
        'first_day',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function events(){
        return $this->hasMany(Event::class);
    }

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function subscribers(){
        return $this->hasMany(Subscriber::class);
    }

}
