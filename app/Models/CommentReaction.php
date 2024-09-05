<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class CommentReaction extends Model
{
  use HasFactory, SoftDeletes, HasUlids;

  protected $fillable = [
    'id',
    'user_id',
    'comment_id',
    'reaction',
  ];

  public function reactor(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function comment(): BelongsTo
  {
    return $this->belongsTo(LessonComment::class, 'comment_id');
  }

  public function casts(): array
  {
    return [
      //
    ];
  }
}
