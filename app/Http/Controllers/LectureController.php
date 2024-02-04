<?php

namespace App\Http\Controllers;

use App\Http\Requests\LectureRequest;
use App\Services\LectureService;
use Illuminate\Http\JsonResponse;

class LectureController extends Controller
{
    protected $lectureService;

    public function __construct(LectureService $lectureService)
    {
        $this->lectureService = $lectureService;
    }

    /**
     * Получить список всех лекций.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $lectures = $this->lectureService->getAllLectures();
        return response()->json($lectures);
    }

    /**
     * Получить информацию о лекции.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $lecture = $this->lectureService->getLectureInfo($id);
        return response()->json($lecture);
    }

    /**
     * Создать новую лекцию.
     *
     * @param LectureRequest $request
     * @return JsonResponse
     */
    public function store(LectureRequest $request): JsonResponse
    {
        $data = $request->validated();
        $lecture = $this->lectureService->createLecture($data);
        return response()->json($lecture, 201);
    }

    /**
     * Обновить информацию о лекции.
     *
     * @param LectureRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(LectureRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();
        $lecture = $this->lectureService->updateLecture($id, $data);
        return response()->json($lecture);
    }

    /**
     * Удалить лекцию.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->lectureService->deleteLecture($id);
        return response()->json(['message' => 'Lecture deleted successfully']);
    }
}
