<?php

namespace App\Models\Tenant;

use App\Models\Calendar\Calendar;
use App\Models\Event\Event;
use App\Traits\Hashidable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class Account extends Model
{
    use Hashidable;
    use Billable;


    protected $table = 'accounts';


    protected $fillable = [
        'name',
        'account_type',
        'stripe_id',
        'card_brand',
        'card_last_four',
        'trial_ends_at',
        'billing_email',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

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
