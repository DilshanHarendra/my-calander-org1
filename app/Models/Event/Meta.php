<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $table = 'event_metas';

    protected $fillable = [
        'key',
        'value',
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }

}
