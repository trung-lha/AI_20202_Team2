<?php

use Illuminate\Database\Seeder;

class ExercisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exs = [];
        $exs[0] = [
            'name' => "Crunch",
            'description' => "The crunch is one of the most popular abdominal exercises. When performed properly, it engages all the abdominal muscles but primarily it works the rectus abdominis muscle and the obliques. It allows both building six-pack abs, and tightening the belly. Crunches use the exerciser's own body weight to tone muscle, and are recommended as a low-cost exercise that can be performed at home.",
        ];
        $exs[1] = [
            'name' => "Lift Weights",
            'description' => "Weight training is a common type of strength training for developing the strength and size of skeletal muscles. It utilizes the force of gravity in the form of weighted bars, dumbbells or weight stacks in order to oppose the force generated by muscle through concentric or eccentric contraction. Weight training uses a variety of specialized equipment to target specific muscle groups and types of movement.",
        ];
        $exs[2] = [
            'name' => "Squat",
            'description' => "A squat is a strength exercise in which the trainee lowers their hips from a standing position and then stands back up. During the descent of a squat, the hip and knee joints flex while the ankle joint dorsiflexes; conversely the hip and knee joints extend and the ankle joint plantarflexes when standing up.",
        ];
        $exs[3] = [
            'name' => "Push-up",
            'description' => "A push-up (sometimes called a press-up in British English) is a common calisthenics exercise beginning from the prone position. By raising and lowering the body using the arms, push-ups exercise the pectoral muscles, triceps, and anterior deltoids, with ancillary benefits to the rest of the deltoids, serratus anterior, coracobrachialis and the midsection as a whole. Push-ups are a basic exercise used in civilian athletic training or physical education and commonly in military physical training. They are also a common form of punishment used in the military, school sport, and some martial arts disciplines.",
        ];
        DB::table('exercises')->insert($exs);
    }
}
