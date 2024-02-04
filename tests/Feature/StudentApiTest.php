<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentApiTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Тест для метода API, возвращающего список всех студентов.
     */
    public function testGetAllStudents(): void
    {
        $response = $this->get('/api/students');

        $response->assertStatus(200); // Проверка успешного ответа
    }

    /**
     * Тест для метода API, возвращающего информацию о студенте.
     */
    public function testGetStudent(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'class_room_id' => 1,
        ];

        $response = $this->postJson('/api/students', $data); // создали студента

        $createdStudentData = $response->json(); // получили данные о созданом студенте

        $response = $this->get('/api/students/' . $createdStudentData['id']);

        $response->assertStatus(200); // Проверка успешного ответа
        $response->assertJson([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'lectures' => [],
            'classRoom' => 'Class A',
        ]); // Проверяет, что JSON-ответ соответствует ожидаемой структуре.

    }

    /**
     * Тест для создания нового студента через API.
     */
    public function testCreateStudent(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'class_room_id' => 1,
        ];

        $response = $this->postJson('/api/students', $data); // создали студента

        $response->assertStatus(201); // Проверка успешного ответа
        $this->assertDatabaseHas('students', ['name' => 'John Doe', 'email' => 'john@example.com']); // проверяем сохранение в БД
    }

    /**
     * Тест для обновления информации о студенте через API.
     */
    public function testUpdateStudent(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'class_room_id' => 1,
        ];

        $response = $this->postJson('/api/students', $data); // создали студента

        $createdStudentData = $response->json(); // получили данные о созданом студенте

        $data = [
            'name' => 'Victor Doe',
            'email' => '555@example.com',
            'class_room_id' => 2,
        ];

        $response = $this->putJson('/api/students/' . $createdStudentData['id'], $data); // обновляем студента

        $response->assertStatus(200);
        $this->assertDatabaseHas('students', ['name' => 'Victor Doe', 'email' => '555@example.com']); // проверяем сохранение в БД
    }

    /**
     * Тест для удаления студенте через API.
     */
    public function testDeleteStudent(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'class_room_id' => 1,
        ];

        $response = $this->postJson('/api/students', $data); // создали студента

        $createdStudentData = $response->json(); // получили данные о созданом студенте

        $response = $this->delete('/api/students/' . $createdStudentData['id']);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('students', ['id' => $createdStudentData['id']]);
    }
}
