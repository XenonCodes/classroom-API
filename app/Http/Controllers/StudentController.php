<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentCreateRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Services\StudentService;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * Получить список всех студентов.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $students = $this->studentService->getAllStudents();
        return response()->json($students);
    }

    /**
     * Получить информацию о студенте.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $student = $this->studentService->getStudentInfo($id);
        return response()->json($student);
    }

    /**
     * Создать нового студента.
     *
     * @param StudentCreateRequest $request
     * @return JsonResponse
     */
    public function store(StudentCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $student = $this->studentService->createStudent($data);
        return response()->json($student, 201);
    }

    /**
     * Обновить информацию о студенте.
     *
     * @param StudentUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(StudentUpdateRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();
        $student = $this->studentService->updateStudent($id, $data);
        return response()->json($student);
    }

    /**
     * Удалить студента.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->studentService->deleteStudent($id);
        return response()->json(['message' => 'Student deleted successfully']);
    }
}
