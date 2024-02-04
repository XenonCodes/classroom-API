<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
            $table->string('topic')->unique();
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('class_room_lecture', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_room_id')->constrained();
            $table->foreignId('lecture_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectures');
        Schema::dropIfExists('class_room_lecture');
    }
};
