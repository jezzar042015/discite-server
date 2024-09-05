<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentProgress extends Model
{
  use HasFactory, HasUlids;

  protected $fillable = [
    'id',
    'user_id',
    'lesson_id',
    'progress',
    'completed',
    'last_accessed',
  ];

  public function student(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function lesson(): BelongsTo
  {
    return $this->belongsTo(Lesson::class, 'lesson_id');
  }

  public function casts(): array
  {
    return [];
  }
}
