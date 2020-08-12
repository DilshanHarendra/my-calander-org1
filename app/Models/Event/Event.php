<?php

namespace App\Models\Event;

use App\Models\Calendar\Calendar;
use App\Models\Category;
use App\Models\File;
use App\Models\Tag;
use App\Traits\Hashidable;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use Hashidable;
    protected $table = "events";

    protected $fillable = [
        'title',
        'description',
        'timezone',
        'start_at',
        'end_at',
        'creator_email',
        'calendar_id',
        'category_id',
        'all_day',
    ];

    protected $dates = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    protected $casts = [
        'all_day' => 'boolean',
        'remindable' => 'boolean',
        'is_canceled' => 'boolean',
        'is_draft' => 'boolean',
        'is_online' => 'boolean',
        'is_recurring' => 'boolean',
        'is_public' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function metas()
    {
        return $this->hasMany(Meta::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'event_tags');
    }

    public function files()
    {
        return $this->morphMany(File::class,'attachables');
    }

    public function coverImage(){ //check this

        return $this->files->where('type','cover_image')->first();

    }

}
