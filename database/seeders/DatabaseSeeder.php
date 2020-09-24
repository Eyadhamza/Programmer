<?php

namespace Database\Seeders;

use App\Models\ProgrammingLanguage;
use App\Models\Resource;
use App\Models\Section;
use App\Models\Track;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Track::factory(10)->has(Resource::factory()->count(4))->create();
        ProgrammingLanguage::factory(10)->has(Resource::factory()->count(4))->create();


    }
}
