<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  use HasFactory, SoftDeletes, HasUlids;

  protected $fillable = [
    'id',
    'title',
    'description',
    'level',
    'is_premium',
    'publish',
    'author_id',
  ];

  public function author(): BelongsTo
  {
    return $this->belongsTo(User::class, 'author_id');
  }

  public function modules(): HasMany
  {
    return $this->hasMany(Module::class, 'course_id')->orderBy('order', 'asc');
  }

  public function getStudentsCountAttribute()
  {
    return 0;
  }
  
  public function getModulesCountAttribute()
  {
    return $this->modules()->count();
  }

  public function casts(): array
  {
    return [
      'created_at' => 'datetime',
      'updated_at' => 'datetime',
      'is_premium' => 'boolean',
      'publish' => 'boolean',
    ];
  }
}
