<?php

namespace App\Models\Tenant;

use App\Models\Calendar\Calendar;
use App\Models\Event\Event;
use App\Traits\Hashidable;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use Hashidable;

    protected $table = 'accounts';

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('role')->withTimestamps();
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
