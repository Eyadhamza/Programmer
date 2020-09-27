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


    public function resources()
    {
        return $this->morphMany(Resource::class,'resourceable');
    }

}
