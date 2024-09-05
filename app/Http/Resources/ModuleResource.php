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
      ],
    ];
  }
}
