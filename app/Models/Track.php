<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Track extends Model
{
    protected $fillable=[
        'name',
        'description',
        'image',
        'video_url'
    ];

    use HasFactory , AsSource;

    protected static function booted()
    {
        static::created(function () {
            (new Section)->makeSection(Track::find(1));
        });
    }

    public function resources()
    {
        return $this->morphMany(Resource::class,'resourceable');
    }

}
