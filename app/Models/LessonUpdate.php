<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonUpdate extends Model
{
  use HasFactory, SoftDeletes, HasUlids;

  protected $fillable = [
    'id',
    'user_id',
    'lesson_id',
    'created_at',
    'changes',
  ];

  public function modifier(): BelongsTo
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
