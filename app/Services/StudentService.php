<?php

namespace App\Services;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;

class StudentService
{
    /**
     * Получить список всех студентов.
     *
     * @return Collection
     */
    public function getAllStudents(): Collection
    {
        return Student::all();
    }

    /**
     * Получить информацию о конкретном студенте.
     *
     * @param int $id
     * @return array
     */
    public function getStudentInfo(int $id): array
    {
        $student = Student::findOrFail($id);

        $info = [
            'name' => $student->name,
            'email' => $student->email,
            'lectures' => $student->lectures->pluck('topic'),
        ];

        if ($student->classRoom) {
            $info['classRoom'] = $student->classRoom->name;
        } else {
            $info['classRoom'] = 'Класс не выбран';
        }

        return $info;
    }

    /**
     * Создать нового студента.
     *
     * @param array $data
     * @return Student
     */
    public function createStudent(array $data): Student
    {
        return Student::create($data);
    }

    /**
     * Обновить информацию о студенте.
     *
     * @param int $id
     * @param array $data
     * @return Student
     */
    public function updateStudent(int $id, array $data): Student
    {
        $student = Student::findOrFail($id);
        $student->update($data);

        return $student;
    }

    /**
     * Удалить студента.
     *
     * @param int $id
     * @return void
     */
    public function deleteStudent(int $id): void
    {
        $student = Student::findOrFail($id);
        $student->delete();
    }
}
