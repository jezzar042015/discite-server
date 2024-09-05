<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::factory()
            ->count(10)
            ->has(
                Module::factory()
                    ->count(15)
                    ->has(Lesson::factory()->count(10)),
                'modules' // Define the relation name here
            )
            ->create();
    }


    // php artisan db:seed
    // php artisan db:seed --class=CourseSeeder
}
