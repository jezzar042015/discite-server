<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('exercises', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->enum('type', ['CHOICES', 'FILLBLANKS', 'FINDMATCH']);
      $table->string('question');
      $table->string('lesson_id', length: 50);
      $table->json('options');
      $table->json('answer');
      $table->integer('seconds_limit');
      $table->string('author_id', length: 50);
      $table->boolean('is_premium')->default(false);
      $table->integer('order');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('exercises');
  }
};
