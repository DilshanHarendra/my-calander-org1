<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'path',
        'title',
        'type',
    ];

}
