<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('lesson_updates', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('user_id', length: 50);
      $table->string('lesson_id', length: 50);
      $table->timestamp('created_at');
      $table->json('changes');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('lesson_updates');
  }
};
