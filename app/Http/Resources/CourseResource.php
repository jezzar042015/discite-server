<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource as JsonJsonResource;

class CourseResource extends JsonJsonResource
{
  public function toArray(Request $course): array
  {
    return [
      'data' => [
        'id' => $this->id,
        'title' => $this->title,
        'description' => $this->description,
        'level' => $this->level,
        'is_premium' => $this->is_premium,
        'publish' => $this->publish,
        'author_id' => $this->author_id,
        'author' => $this->author,
        'modules' => $this->modules,
        'students_count' => $this->students_count,
        'created_at' => $this->created_at->format('Y-m-d'),
        'updated_at' => $this->updated_at->format('Y-m-d'),
      ],
    ];
  }
}
