<?php

namespace App\Models\Tenant;

use App\Models\Calendar\Calendar;
use App\Models\Event\Event;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function calendars()
    {
        return $this->hasMany(Calendar::class);
    }

    public function events()
    {
        return $this->hasManyThrough(Event::class,Calendar::class);
    }

}
