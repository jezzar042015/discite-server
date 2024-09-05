<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource as JsonJsonResource;

class ModuleResource extends JsonJsonResource
{
  public function toArray(Request $module): array
  {
    return [
      'data' => [
        'id' => $this->id,
        'title' => $this->title,
        'description' => $this->description,
        'course_id' => $this->course_id,
        'is_premium' => $this->is_premium,
        'publish' => $this->publish,
        'order' => $this->order,
        'course' => $this->course,
        'lessons' => $this->lessons,
        'created_at' => $this->created_at->format('Y-m-d'),
        'updated_at' => $this->updated_at->format('Y-m-d'),
      ],
    ];
  }
}
