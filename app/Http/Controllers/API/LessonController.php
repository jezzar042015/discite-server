<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function modular($module_id)
    {
        try {
            $lesson = Lesson::where('module_id', $module_id)->orderBy('order')->get();
            return response()->json(['lessons' => $lesson]);
        } catch (\Exception $error) {
            return response()->json(['error' => 'Server error', 'message' => $error->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $lesson = Lesson::findOrFail($id);
            return response()->json(['data' => $lesson]);
        } catch (\Exception $error) {
            return response()->json(['error' => 'Server error', 'message' => $error->getMessage()], 500);
        }
    }

    public function create(StoreLessonRequest $request)
    {
        $lesson = $request->all();
        $createdLesson = Lesson::create($lesson);
        return new LessonResource($createdLesson);
    }

    public function update(UpdateLessonRequest $request, $id)
    {
        try {
            $lesson = Lesson::findOrFail($id);
            $lesson->update([
                "title" => $request->title,
                "content" => $request->content,
                "module_id" => $request->module_id,
                "is_premium" => $request->is_premium,
                "order" => $request->order,
            ]);

            return new LessonResource($lesson);
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }
}
