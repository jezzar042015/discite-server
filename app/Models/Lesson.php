<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
  use HasFactory, SoftDeletes, HasUlids;

  protected $fillable = [
    'id',
    'title',
    'content',
    'module_id',
    'author_id',
    'order',
    'is_premium',
    'publish',
  ];

  public function author(): BelongsTo
  {
    return $this->belongsTo(User::class, 'author_id');
  }

  public function module(): BelongsTo
  {
    return $this->belongsTo(Module::class, 'lesson_id');
  }

  public function exercises(): HasMany
  {
    return $this->hasMany(Exercise::class, 'lesson_id');
  }

  public function comments(): HasMany
  {
    return $this->hasMany(LessonComment::class, 'lesson_id');
  }

  public function students(): HasMany
  {
    return $this->hasMany(User::class);
  }

  public function casts(): array
  {
    return [
      'created_at' => 'datetime:Y-m-d',
      'updated_at' => 'datetime:Y-m-d',
      'is_premium' => 'boolean',
      'publish' => 'boolean',
    ];
  }
}
