<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassRoomRequest;
use App\Http\Requests\CreateOrUpdateStudyPlanRequest;
use App\Services\ClassRoomService;
use Illuminate\Http\JsonResponse;

class ClassRoomController extends Controller
{
    protected $classRoomService;

    public function __construct(ClassRoomService $classRoomService)
    {
        $this->classRoomService = $classRoomService;
    }

    /**
     * Получить список всех классов.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $classRooms = $this->classRoomService->getAllClassRooms();
        return response()->json($classRooms);
    }

    /**
     * Получить информацию о классе.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $classRoom = $this->classRoomService->getClassInfo($id);
        return response()->json($classRoom);
    }

    /**
     * Получить  учебный план (список лекций).
     *
     * @return JsonResponse
     */
    public function getPlan(int $id): JsonResponse
    {
        $studyPlan = $this->classRoomService->getPlan($id);

        return response()->json($studyPlan);
    }

    /**
     * Создать/обновить учебный план для конкретного класса.
     *
     * @param CreateOrUpdateStudyPlanRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function createOrUpdatePlan(CreateOrUpdateStudyPlanRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $studyPlan = $this->classRoomService->createOrUpdatePlan($id, $data);

        return response()->json($studyPlan);
    }

    /**
     * Создать новый учебный класс.
     *
     * @param ClassRoomRequest $request
     * @return JsonResponse
     */
    public function store(ClassRoomRequest $request): JsonResponse
    {
        $data = $request->validated();
        $classRoom = $this->classRoomService->createClass($data);
        return response()->json($classRoom, 201);
    }

    /**
     * Обновить информацию об учебном классе.
     *
     * @param ClassRoomRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ClassRoomRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();
        $classRoom = $this->classRoomService->updateClass($id, $data);
        return response()->json($classRoom);
    }

    /**
     * Удалить класса.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->classRoomService->deleteClass($id);
        return response()->json(['message' => 'Class room deleted successfully']);
    }
}
