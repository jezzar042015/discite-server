<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
  use HasFactory, SoftDeletes, HasUlids;

  protected $fillable = [
    'id',
    'title',
    'description',
    'course_id',
    'is_premium',
    'order',
  ];

  public function course(): BelongsTo
  {
    return $this->belongsTo(Course::class, 'course_id');
  }


  public function lessons(): HasMany
  {
    return $this->hasMany(Lesson::class, 'lesson_id');
  }

  public function casts(): array
  {
    return [
      'created_at' => 'datetime:Y-m-d',
      'updated_at' => 'datetime:Y-m-d',
    ];
  }
}
