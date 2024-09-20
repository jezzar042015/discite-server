<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource as JsonJsonResource;

class LessonResource extends JsonJsonResource
{
  public function toArray(Request $lesson): array
  {
    return [
      'data' => [
          'id' => $this->id,
          'title' => $this->title,
          'content' => $this->content,
          'overview'=> $this->overview,
          'module_id' => $this->module_id,
          'author_id' => $this->author_id,
          'order' => $this->order,
          'author' => $this->author,
          'module' => $this->module,
          'exercises' => $this->exercises,
          'comments' => $this->comments,
          'is_premium' => $this->is_premium,
          'publish' => $this->publish,
          'created_at' => $this->created_at,
          'updated_at' => $this->updated_at,
      ],
    ];
  }
}
