<?php

namespace App\Http\Controllers\API;

use App\Models\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseCollection;

class CourseController extends Controller
{
  public function index()
  {
    return new CourseCollection(
      Course::orderBy('id')->get()
    );
  }

  public function show($id)
  {
    try {
      $course = Course::findOrFail($id);

      return new CourseResource($course);
    } catch (\Exception $error) {
      return response()->json(['error' => 'Server error', 'message' => $error->getMessage()], 500);
    }
  }

  public function create(StoreCourseRequest $request)
  {
    $course = $request->all();
    $createdCourse = Course::create($course);
    return new CourseResource($createdCourse);
  }

  public function update(UpdateCourseRequest $request, $id)
  {
    try {
      $course = Course::findOrFail($id);
      $course->update([
        'title' => $request->title,
        'description' => $request->description,
        'level' => $request->level,
        'is_premium' => $request->is_premium,
        'publish' => $request->publish,
        'author_id' => $request->author_id,
      ]);

      return new CourseResource($course);
    } catch (\Exception $e) {

      return response()->json(['error' => $e->getMessage()], 500);
    }
  }

  public function destroy(Course $course)
  {
    try {
      $course->delete();
      return [
        'message' => 'deleted!'
      ];
    } catch (\Exception $error) {
      return response([
        'message' => 'none'
      ], 404);
    }
  }
}
