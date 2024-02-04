<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $fillable = ['topic', 'description'];

    public function classRooms()
    {
        return $this->belongsToMany(ClassRoom::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
