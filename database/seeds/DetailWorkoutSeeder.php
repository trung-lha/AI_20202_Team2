<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DetailWorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =  Faker::create();
        $detaiWorkout = [];
        for($index=0;$index<10;$index++){
            $detaiWorkout[] = [
                'user_id' => $index+1,
                'exercise_id' => rand(1,4),
                'count' => rand(10,100),
                'time' => rand(600,1800),
                'date' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null)->format("Y-m-d"),
            ];

        }
        // dd($detaiWorkout);
        DB::table('detai_workout')->insert($detaiWorkout);
    }
}
