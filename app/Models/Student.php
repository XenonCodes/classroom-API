<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'email', 'class_room_id'];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function lectures()
    {
        return $this->belongsToMany(Lecture::class);
    }
}
