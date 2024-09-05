<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasFactory, SoftDeletes, HasUlids, Notifiable, HasApiTokens;

  protected $fillable = [
    'id',
    'name',
    'email',
    'email_verified_at',
    'type',
    'password',
    'remember_token',
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  public function lesson_comments(): HasMany
  {
    return $this->hasMany(Lesson::class, 'user_id');
  }

  public function lessons(): HasMany
  {
    return $this->hasMany(StudentProgress::class, 'user_id');
  }

  public function exercises(): HasMany
  {
    return $this->hasMany(ExerciseProgress::class, 'user_id');
  }

  public function bookmarks(): HasMany
  {
    return $this->hasMany(Bookmark::class, 'user_id');
  }

  public function courses(): HasMany
  {
    return $this->hasMany(StudentProgress::class, 'user_id');
  }

  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }
}
