<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
  use HasFactory, HasUlids;

  protected $fillable = [
    'id',
    'user_id',
    'lesson_id',
    'created_at',
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'author_id');
  }

  public function lesson(): HasMany
  {
    return $this->hasMany(Lesson::class, 'lesson_id');
  }

  public function casts(): array
  {
    return [];
  }
}
