<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded=[];
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
