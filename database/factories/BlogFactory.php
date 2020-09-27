<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->title,
            'image'=>'https://randomuser.me/api/portraits/med/men/'.$this->faker->numberBetween(0,100).'.jpg',
            'address_url'=>'url of video',
            'body'=>$this->faker->paragraph,
        ];
    }
}
