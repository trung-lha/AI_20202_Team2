<?php

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
        $this->call([
            ExercisesSeeder::class,
            UsersSeeder::class,
            WorkoutSeeder::class,
            DetaiWorkoutSeeder::class,
        ]);
    }
}
