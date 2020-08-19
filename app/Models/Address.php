<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'floor',
        'full_address',
        'street_number',
        'street',
        'city',
        'province',
        'country',
        'longitude',
        'latitude',
        'postal_code',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }



}
