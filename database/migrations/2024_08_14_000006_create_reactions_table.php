<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('comment_reactions', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('user_id', length: 50);
      $table->string('comment_id', length: 50);
      $table->enum('reaction', ['HEART', 'BULB', 'LIKE', 'WOW', 'DISLIKE'])->nullable();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('comment_reactions');
  }
};
