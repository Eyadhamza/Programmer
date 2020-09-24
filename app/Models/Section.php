<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Section extends Model
{
    use AsSource;

    protected $fillable=[
        'name',
        'description',
        'image'
    ];
    use HasFactory;

    public function makeSection($model)
    {
        Section::firstOrCreate([
            'name'=>class_basename($model),
            'description'=>$model->description,
            'image'=>$model->image
        ]);
        return $this;
    }
}
