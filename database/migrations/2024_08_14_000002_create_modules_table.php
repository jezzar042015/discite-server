<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('modules', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('title', length: 100);
      $table->text('description');
      $table->string('course_id', length: 50);
      $table->boolean('is_premium')->default(false);
      $table->boolean('publish')->default(false);
      $table->integer('order');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('modules');
  }
};
