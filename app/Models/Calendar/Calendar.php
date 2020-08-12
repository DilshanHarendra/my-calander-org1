<?php

namespace App\Models\Calendar;

use App\Models\Event\Event;
use App\Models\Tenant\Account;
use App\Traits\Hashidable;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use Hashidable;
    protected $table = 'calendars';

    protected $fillable = [
        'title',
        'description',
        'time_zone',
        'first_day',
        'owner_email',
        'type',
        'accounts_id',

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
