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
        for($index=0;$index<3;$index++){
            $workout[] = [
                'user_id' => $index+1,
                'exercise_id' => 1,
                'counts' => rand(10,100),
                'time' => rand(1,10)
            ];

        }
        for($index=0;$index<3;$index++){
            $workout[] = [
                'user_id' => $index+1,
                'exercise_id' => 2,
                'counts' => rand(10,100),
                'time' => rand(1,10)
            ];

        }
        for($index=0;$index<3;$index++){
            $workout[] = [
                'user_id' => $index+1,
                'exercise_id' => 3,
                'counts' => rand(10,100),
                'time' => rand(1,10)
            ];

        }
        for($index=0;$index<3;$index++){
            $workout[] = [
                'user_id' => $index+1,
                'exercise_id' => 4,
                'counts' => rand(10,100),
                'time' => rand(1,10)
            ];

        }
        // dd($workout);
        DB::table('workout')->insert($workout);
    }
}
