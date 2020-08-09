<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaTemplate extends Model
{
    protected $table = 'meta_templates';

    protected $fillable = [
        'key',
        'value',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
