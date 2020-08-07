<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
   protected $table = 'tags';

   protected $fillable = [
       'title'
   ];

    public function events()
    {
        return $this->belongsToMany(Event::class,'event_tags');
    }

}
