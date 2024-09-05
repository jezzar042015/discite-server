<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('student_progress', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('user_id', length: 50);
      $table->string('lesson_id', length: 50);
      $table->json('progress');
      $table->boolean('completed');
      $table->timestamp('last_accessed');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('student_progress');
  }
};
