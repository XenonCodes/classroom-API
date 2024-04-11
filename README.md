# Использование API для учебного класса

## Требования к системе

- PHP 7.4+
- Laravel 8
- MySQL
- Composer
- Docker

## Установка

1. Клонировать этот репозиторий

```
git clone https://github.com/XenonCodes/test-task-API.git my-project
```

2. Создайте файл .env
```
cd my-project/
cp .env.example .env
```

3. Соберите образы и запустите все контейнеры
```
docker-compose up -d
```

3. Установить зависимости проекта
```
composer install
```

4. Создайте ключ проекта Laravel
```
php artisan key:generate
```

5. В открытой консоли директории проекта введите команду для генерации таблиц с фековыми данными
```
php artisan migrate -seed
```

## Студенты (Students)

1. Показать всех студентов

```
GET /api/students
```

2. Создать студента

```
POST /api/students

Тело запроса:
{
  "name": "John Doe",
  "email": "john@example.com",
  "class_room_id": 1
}
```

3. Обновить информацию о студенте

```
PUT /api/students/{id}

Тело запроса:
{
  "name": "Updated Name",
  "email": "updated@example.com",
  "class_room_id": 2
}
```

4. Получить информацию о студенте

```
GET /api/students/{id}
```

5. Удалить студента

```
DELETE /api/students/{id}
```

## Лекции (Lectures)

1. Показать все лекции

```
GET /api/lectures
```

2. Создать лекцию

```
POST /api/lectures

Тело запроса:
{
  "topic": "Introduction to Laravel",
  "description": "A comprehensive introduction to the Laravel framework"
}
```

3. Обновить информацию о лекции

```
PUT /api/lectures/{id}

Тело запроса:
{
  "topic": "Updated Laravel Introduction",
  "description": "An updated introduction to the Laravel framework"
}
```

4. Получить информацию о лекции

```
GET /api/lectures/{id}
```

5. Удалить лекцию

```
DELETE /api/lectures/{id}
```

## Классы (ClassRooms)

1. Показать все классы

```
GET /api/classrooms
```

2. Создать класс 

```
POST /api/classrooms

Тело запроса:
{
  "name": "Class Name"
}
```

3. Обновить информацию о классе

```
PUT /api/classrooms/{id}

Тело запроса:
{
  "name": "Updated Class Name"
}
```

4. Получить информацию о классе

```
GET /api/classrooms/{id}
```

5. Удалить класс

```
DELETE /api/classrooms/{id}
```

## Управление учебным планом

1. Создать/обновить учебный план для конкретного класса

```
POST /api/classrooms/{id}/study-plan

Тело запроса:
{
  "lectures": [
    {"lecture_id": 1},
    {"lecture_id": 2},
    {"lecture_id": 3}
  ]
}
```

2. Получить учебный план для конкретного класса

```
GET /api/classrooms/{id}/study-plan
```

## Тесты

Тесты выполнены частично только для Students

```
php artisan test
```
