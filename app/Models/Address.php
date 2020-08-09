<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'full_address',
        'street_1',
        'street_2',
        'city',
        'province',
        'country',
        'longitude',
        'latitude',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }
}
