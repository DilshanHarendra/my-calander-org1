<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = "event_registrations";

    protected $fillable = [
        'name',
        'email',
        'rsvp',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
