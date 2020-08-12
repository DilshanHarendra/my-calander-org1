<?php

namespace App\Models;

use App\Models\Event\Event;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   protected $table = 'categories';

   protected $fillable = [
       'title'
   ];

   public function meta_templates()
   {
       return $this->hasMany(MetaTemplate::class);
   }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
