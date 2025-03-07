<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('lessons', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('title', length: 100);
      $table->text('overview');
      $table->json('content')->nullable();
      $table->string('module_id', length: 50);
      $table->string('author_id', length: 50)->nullable();
      $table->boolean('is_premium')->default(false);
      $table->boolean('publish')->default(false);
      $table->integer('order');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('lessons');
  }
};
