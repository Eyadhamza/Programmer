<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Resource extends Model
{
    protected $fillable=[
        'name',
        'description',
        'resource_url',
        'resourceable'
    ];
    use HasFactory,AsSource;
    public function resourceable()
    {
        return $this->morphTo();
    }
}
