<?php

namespace Database\Factories;

use App\Models\Resource;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resource::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $levels=['beginner','advanced','intermediate'];
        return [
            'description'=>$this->faker->paragraph,
            'name'=>$this->faker->text,
            'level'=>$levels[array_rand($levels)]
        ];
    }
}
