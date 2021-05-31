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
            'name' => "Gập bụng",
            'description' => "Trong khi đẩy lưng dưới xuống sàn để làm căng cứng cơ bụng thì bắt đầu nhấc vai khỏi sàn. Tiếp tục đẩy lưng dưới xuống sàn càng mạnh càng tốt khi bạn siết cứng cơ bụng và thở ra",
        ];
        $exs[1] = [
            'name' => "Nâng tạ",
            'description' => "Hai tay nắm thanh tạ thật chắc (tay ngửa, sấp sao cũng được miễn bạn thấy thoải mái), bạn dùng lực ở chân nâng tạ lúc đầu chứ không dùng lực ở lưng, khi tạ lên ngang gối thì bạn kết hợp với lưng và chân để duỗi thẳng lưng. Và khi tạ lên mức cao nhất thì bạn cong nhẹ lưng.",
        ];
        $exs[2] = [
            'name' => "Squat",
            'description' => "Đứng dang 2 chân, mở rộng bằng vai, thả lỏng cơ thể, đặc biệt thư giãn vùng bụng.",
        ];
        $exs[3] = [
            'name' => "Chống đẩy",
            'description' => "Đưa cơ thể vào tư thế nằm sấp, mặt hướng xuống sàn. Giữ hai chân lại sát nhau",
        ];
        DB::table('exercises')->insert($exs);
    }
}
