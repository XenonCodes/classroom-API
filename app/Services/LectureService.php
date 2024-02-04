<?php

namespace App\Services;

use App\Models\Lecture;
use Illuminate\Database\Eloquent\Collection;

class LectureService
{
    /**
     * Получить список всех лекций.
     *
     * @return Collection
     */
    public function getAllLectures(): Collection
    {
        return Lecture::all();
    }

    /**
     * Получить информацию о конкретной лекции.
     *
     * @param int $id
     * @return array
     */
    public function getLectureInfo(int $id): array
    {
        $lecture = Lecture::findOrFail($id);

        return [
            'name' => $lecture->topic,
            'description' => $lecture->description,
            'classRooms' => $lecture->classRooms,
            'students' => $lecture->students,
        ];
    }

    /**
     * Создать новую лекцию.
     *
     * @param array $data
     * @return Lecture
     */
    public function createLecture(array $data): Lecture
    {
        return Lecture::create($data);
    }

    /**
     * Обновить информацию о лекции.
     *
     * @param int $id
     * @param array $data
     * @return Lecture
     */
    public function updateLecture(int $id, array $data): Lecture
    {
        $lecture = Lecture::findorFail($id);
        $lecture->update($data);

        return $lecture;
    }

    /**
     * Удалить лекцию.
     *
     * @param int $id
     * @return void
     */
    public function deleteLecture(int $id): void
    {
        $lecture = Lecture::findOrFail($id);

        $lecture->delete();
    }
}
