<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassRoomLectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получаем все ID классов и лекций
        $classRoomIds = DB::table('class_rooms')->pluck('id');
        $lectureIds = DB::table('lectures')->pluck('id');

        $shuffledLectures = $lectureIds->shuffle();
        
        // Заполняем промежуточную таблицу
        foreach ($classRoomIds as $classRoomId) {
            foreach ($shuffledLectures as $lectureId) {
                DB::table('class_room_lecture')->insert([
                    'class_room_id' => $classRoomId,
                    'lecture_id' => $lectureId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            $shuffledLectures = $shuffledLectures->shuffle();
        }
    }
}
