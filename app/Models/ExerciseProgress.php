<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class ExerciseProgress extends Model
{
  use HasFactory, SoftDeletes, HasUlids;

  protected $fillable = [
    'id',
    'user_id',
    'exercise_id',
    'status',
    'attempts',
    'score',
    'completed',
    'last_accessed',
  ];

  public function student(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function exercise(): BelongsTo
  {
    return $this->belongsTo(Exercise::class, 'exercise_id');
  }

  public function casts(): array
  {
    return [
      
    ];
  }
}
