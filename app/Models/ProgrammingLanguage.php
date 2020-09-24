<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammingLanguage extends Model
{
    protected $guarded=[];
    use HasFactory;

    protected static function booted()
    {
        static::created(function () {
            (new Section)->makeSection(ProgrammingLanguage::find(1));
        });
    }

    public function resources()
    {
        return $this->morphMany(Resource::class,'resourceable');
    }
}
