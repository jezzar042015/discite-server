<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('lesson_comments', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('user_id', length: 50);
      $table->string('lesson_id', length: 50);
      $table->string('parent_id', length: 50)->nullable();
      $table->text('content');
      $table->timestamps();
      $table->softDeletes();
    });
  }
  
  public function down(): void
  {
    Schema::dropIfExists('lesson_comments');
  }
};
