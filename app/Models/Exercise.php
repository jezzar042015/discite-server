<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
  use HasFactory, SoftDeletes, HasUlids;

  protected $fillable = [
    'id',
    'type',
    'question',
    'lesson_id',
    'options',
    'answer',
    'seconds_limit',
    'author_id',
    'is_premium',
    'order',
  ];

  public function author(): BelongsTo
  {
    return $this->belongsTo(User::class, 'author_id');
  }

  public function lesson(): BelongsTo
  {
    return $this->belongsTo(Lesson::class, 'lesson_id');
  }

  public function casts(): array
  {
    return [
      
    ];
  }
}
