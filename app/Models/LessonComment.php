<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class LessonComment extends Model
{
  use HasFactory, SoftDeletes, HasUlids;

  protected $fillable = [
    'id',
    'user_id',
    'lesson_id',
    'parent_id',
    'content',
  ];

  public function commentor(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function lesson(): BelongsTo
  {
    return $this->belongsTo(Lesson::class, 'lesson_id');
  }

  public function replies(): HasMany
  {
    return $this->hasMany(LessonComment::class, 'parent_id');
  }

  public function parentComment(): BelongsTo
  {
    return $this->belongsTo(LessonComment::class, 'parent_id');
  }

  public function reactions(): HasMany
  {
    return $this->hasMany(CommentReaction::class, 'comment_id');
  }

  public function getReactionsSummaryAttribute()
  {
    return [];
  }

  public function getIsReplyAttribute()
  {
    // access attribute with .is_reply
    return !empty($this->parent_id);
  }

  public function casts(): array
  {
    return [];
  }
}
