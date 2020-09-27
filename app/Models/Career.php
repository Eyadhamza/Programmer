<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Career extends Model
{
    protected $fillable=[
        'body',
        'title',
        'url',
        'image',

    ];
    use HasFactory,AsSource;
}
