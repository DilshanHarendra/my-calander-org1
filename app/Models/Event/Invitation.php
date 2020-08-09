<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $table = "event_invitations";

    protected $fillable = [
        'email',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
