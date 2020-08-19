<?php

namespace App\Models\Event;

use App\Models\Address;
use App\Models\Calendar\Calendar;
use App\Models\Category;
use App\Models\File;
use App\Models\Tag;
use App\Services\SaveBase64ToFileService;
use App\Traits\Hashidable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\CalendarLinks\Link;
use DateTime;

class Event extends Model
{
    use Hashidable;
    protected $table = "events";

//    protected static function boot()
//    {
//       self::deleting(function($model){
//           $model->address()->delete();
//       });
//    }

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

    public function setStartAtAttribute($date)
    {
        $this->attributes['start_at'] = Carbon::createFromFormat('Y-m-d H:i',$date,$this->timezone)->tz(config('app.timezone'));
    }

    public function setEndAtAttribute($date)
    {
        $this->attributes['end_at'] = Carbon::createFromFormat('Y-m-d H:i',$date,$this->timezone)->tz(config('app.timezone'));
    }

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

    public function address()
    {
        return $this->morphOne(Address::class,'addressable');
    }

    public function getAddToProviderLink($provider, SaveBase64ToFileService $base64ToFileService)
    {
        try {

            $from = Carbon::createFromFormat('Y-m-d H:i:s',  $this->start_at)->setTimezone($this->timezone);
            $to = Carbon::createFromFormat('Y-m-d H:i:s',  $this->end_at)->setTimezone($this->timezone);

            $link = Link::create($this->title, $from, $to, $this->all_day)
                ->description($this->description);

            if($this->address != null)
            {
                $link->address($this->address->full_address);
            }
        }
        catch(\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }

        switch($provider)
        {
            case "google":
                return $link->google();
                break;
            case "yahoo":
                return $link->yahoo();
                break;
            case "webOutloook":
                return $link->webOutlook();
                break;
            case "outlook":
            case "apple":

                $base64ToFileService->setData($link->ics());
                $base64ToFileService->setExtension('ics');

                try{

                    return $base64ToFileService->save('ical/events/' .$this->id.'/'.date_create()->getTimestamp().'.ical');

                }
                catch(\Exception $exception)
                {
                    throw new \Exception($exception->getMessage());
                }

                break;
            default:
                throw new \Exception("Undefined provider");
        }
    }


}
