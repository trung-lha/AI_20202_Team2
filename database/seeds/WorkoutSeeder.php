<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class WorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =  Faker::create();
        $workout = [];
        for($index=0;$index<10;$index++){
            $workout[] = [
                'user_id' => $index+1,
                'exercise_id' => rand(1,4),
                'counts' => rand(10,100),
                'time' => rand(1,10)
            ];

        }
        // dd($workout);
        DB::table('workout')->insert($workout);
    }
}
