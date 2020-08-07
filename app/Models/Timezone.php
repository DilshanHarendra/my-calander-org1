<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
    protected $fillable = [
        'zone',
        ];

    public $timestamps = false;

    protected $table = 'timezones';

}
