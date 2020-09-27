<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Blog extends Model
{
    protected $fillable=[
        'author_id',
        'body',
        'title',
        'image',
        'address_url',
    ];
    use HasFactory,AsSource;

}
