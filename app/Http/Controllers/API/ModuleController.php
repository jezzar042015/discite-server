<?php

namespace App\Http\Controllers\API;

use App\Models\Module;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use App\Http\Resources\ModuleResource;
use App\Http\Resources\ModuleCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ModuleController extends Controller
{
  public function index()
  {
    return new ModuleCollection(
      Module::all()
    );
  }

  public function show($id)
  {
    try {
      $module = Module::findOrFail($id);
      return new ModuleResource($module);
    } catch (ModelNotFoundException $error) {
      return response()->json(['error' => 'Module not found.'], 404);
    } catch (\Exception $error) {
      return response()->json(['error' => 'Server error', 'message' => $error->getMessage()], 500);
    }
  }

  public function create(StoreModuleRequest $request)
  {
    $module = $request->all();
    $createdModule = Module::create($module);
    return new ModuleResource($createdModule);
  }

  public function update(UpdateModuleRequest $request, Module $module)
  {
    $module->update(
      [
        'title' => $request->title,
        'description' => $request->description,
        'course_id' => $request->course_id,
        'is_premium' => $request->is_premium,
        'order' => $request->order,
      ]
    );

    return $module;
  }

  public function destroy(Module $module)
  {
    try {
      $module->delete();
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
