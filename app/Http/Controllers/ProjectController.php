<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Resources\PaginatedResource;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index()
    {
        $projects = Project::with('user')->paginate();

        return new JsonResponse(
            new PaginatedResource(ProjectResource::collection($projects))
        );
    }

    /**
     * Display the specified project.
     */
    public function show(Project $project): JsonResponse
    {
        return new JsonResponse(new ProjectResource($project));
    }

    /**
     * Store a newly created project in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProjectRequest $request)
    {
        $project = Project::create([
            'title' => $request->validated('title'),
            'description' => $request->validated('description', null),
            'user_id' => $request->validated('userId'),
            'is_active' => $request->validated('isActive', true),
        ]);

        return new JsonResponse(new ProjectResource($project), JsonResponse::HTTP_CREATED);
    }

    /**
     * Update the specified project in storage.
     */
    public function update(StoreProjectRequest $request, Project $project): JsonResponse
    {
        $project->update([
            'title' => $request->validated('title'),
            'description' => $request->validated('description', $project->description),
            'user_id' => $request->validated('userId'),
            'is_active' => $request->validated('isActive', $project->is_active),
        ]);

        return new JsonResponse(new ProjectResource($project));
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project): JsonResponse
    {
        $project->delete();

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
