<?php

namespace App\Models;

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
