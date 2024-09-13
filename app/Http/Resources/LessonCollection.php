<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection as JsonResourceCollection;

class LessonCollection extends JsonResourceCollection
{
  public function toArray(Request $request): array
  {
    return [
      'data' => $this->collection->map(function ($lesson) {
        return [
          'id' => $lesson->id,
          'title' => $lesson->title,
          'content' => $lesson->content,
          'overview'=> $lesson->overview,
          'module_id' => $lesson->module_id,
          'author_id' => $lesson->author_id,
          'order' => $lesson->order,
          'author' => $lesson->author,
          'module' => $lesson->module,
          'exercises' => $lesson->exercises,
          'comments' => $lesson->comments,
          'is_premium' => $lesson->is_premium,
          'publish' => $lesson->publish,
          'created_at' => $lesson->created_at->format('Y-m-d'),
          'updated_at' => $lesson->updated_at->format('Y-m-d'),
        ];
      })
    ];
  }
}
