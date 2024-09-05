<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection as JsonResourceCollection;

class ModuleCollection extends JsonResourceCollection
{
  public function toArray(Request $request): array
  {
    return [
      'data' => $this->collection->map(function ($module) {
        return [
          'id' => $module->id,
          'title' => $module->title,
          'description' => $module->description,
          'course_id' => $module->course_id,
          'is_premium' => $module->is_premium,
          'order' => $module->order,
          'course' => $module->course,
          'lessons' => $module->lessons,
          'created_at' => $module->created_at->format('Y-m-d'),
          'updated_at' => $module->updated_at->format('Y-m-d'),
        ];
      })
    ];
  }
}
