<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('courses', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('title', length: 100);
      $table->text('description');
      $table->enum('level', ['BEGINNER', 'INTERMEDIATE', 'ADVANCED']);
      $table->boolean('is_premium')->default(false);
      $table->boolean('publish')->default(false);
      $table->string('author_id', length: 50)->nullable();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('courses');
  }
};
