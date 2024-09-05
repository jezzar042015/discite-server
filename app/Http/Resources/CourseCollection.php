<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection as JsonResourceCollection;

class CourseCollection extends JsonResourceCollection
{
  public function toArray(Request $request): array
  {
    return [
      'data' => $this->collection->map(function ($course) {
        return [
          'id' => $course->id,
          'title' => $course->title,
          'description' => $course->description,
          'level' => $course->level,
          'is_premium' => $course->is_premium,
          'publish' => $course->publish,
          'author_id' => $course->author_id,
          'author' => $course->author,
          'modules_count' => $course->modules_count,
          'students_count' => $course->students_count,
          'created_at' => $course->created_at->format('Y-m-d'),
          'updated_at' => $course->updated_at->format('Y-m-d'),
        ];
      })
    ];
  }
}
