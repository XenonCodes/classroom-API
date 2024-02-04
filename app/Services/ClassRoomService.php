<?php

namespace App\Services;

use App\Models\ClassRoom;
use Illuminate\Database\Eloquent\Collection;

class ClassRoomService
{
    /**
     * Получить список всех классов.
     *
     * @return Collection
     */
    public function getAllClassRooms(): Collection
    {
        return ClassRoom::all();
    }

    /**
     * Получить информацию о конкретном классе.
     *
     * @param int $id
     * @return array
     */
    public function getClassInfo(int $id): array
    {
        $classRoom = ClassRoom::findOrFail($id);

        return [
            'name' => $classRoom->name,
            'students' => $classRoom->students,
        ];
    }

    /**
     * Получить учебный план (список лекций).
     *
     * @param int $id
     * @return Collection
     */
    public function getPlan(int $id): Collection
    {
        $classRoom = ClassRoom::findOrFail($id);

        return $classRoom->lectures;
    }

    /**
     * Создать/обновить учебный план для конкретного класса.
     *
     * @param int $id
     * @param array $data
     * @return Collection
     */
    public function createOrUpdatePlan(int $id, array $data): Collection
    {
        $classRoom = ClassRoom::findOrFail($id);

        // Удаление текущих лекций учебного плана
        $classRoom->lectures()->detach();


        // Извлечение уникальных лекций из запроса
        $uniqueLectures = collect($data['lectures'])
            ->unique('lecture_id')
            ->values()
            ->all();

        // Добавление новых лекций в учебный план
        foreach ($uniqueLectures as $lectureData) {
            $lectureId = $lectureData['lecture_id'];

            $classRoom->lectures()->attach($lectureId);
        }

        return $classRoom->lectures;
    }

    /**
     * Создать новый учебный класс.
     *
     * @param array $data
     * @return ClassRoom
     */
    public function createClass(array $data): ClassRoom
    {
        return ClassRoom::create($data);
    }

    /**
     * Обновить информацию об учебном классе.
     *
     * @param int $id
     * @param array $data
     * @return ClassRoom
     */
    public function updateClass(int $id, array $data): ClassRoom
    {
        $classRoom = ClassRoom::findorFail($id);
        $classRoom->update($data);

        return $classRoom;
    }

    /**
     * Удалить учебный класс.
     *
     * @param int $id
     * @return void
     */
    public function deleteClass(int $id): void
    {
        $classRoom = ClassRoom::findOrFail($id);

        // Получение всех студентов, принадлежащих к удаляемому классу
        $students = $classRoom->students;

        // Обновление поля classRoomId у всех студентов
        foreach ($students as $student) {
            $student->update(['class_room_id' => null]);
        }

        // Удаление всех связанных студентов
        $classRoom->students()->delete();

        $classRoom->delete();
    }
}
