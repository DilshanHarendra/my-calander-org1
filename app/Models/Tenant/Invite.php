<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invite extends Model
{
    use Notifiable;


    protected $fillable = [
        'email',
        'token',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
