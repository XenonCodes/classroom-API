<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LectureStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получаем все ID лекций и студентов
        $lectureIds = DB::table('lectures')->pluck('id');
        $studentIds = DB::table('students')->pluck('id');

        // Заполняем промежуточную таблицу
        foreach ($lectureIds as $lectureId) {
            $randomStudentId = $studentIds->random();

            DB::table('lecture_student')->insert([
                'lecture_id' => $lectureId,
                'student_id' => $randomStudentId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
