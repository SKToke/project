<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('project');
    }

    public function getList()
    {
        $projects = Project::get();
        return response()->json([
            'list' => $projects,
            'commonStatus' => getCommonStatus()
        ]);
    }

    public function getProjectById($id)
    {
        $project = Project::findOrfail($id);
        return response()->json($project);
    }

    public function createProject(Request $request)
    {
        $request->validate([
            "name" => 'required',
            "description" => 'nullable',
            "status" => 'required|in:active,inactive,blocked'
        ]);

        Project::create([
            'name' => $request->post('name'),
            'description' => $request->post('description'),
            'status' => $request->post('status'),
        ]);

        return response()->json([
            "success" => "Project has been successfully created."
        ]);
    }

    public function updateProject(Request $request, $id)
    {
        $request->validate([
            "name" => 'required',
            "description" => 'nullable',
            "status" => 'required|in:active,inactive,blocked'
        ]);

        $project = Project::findOrfail($id);
        $project->name = $request->get("name");
        $project->description = $request->get("description") ?? NULL;
        $project->status = $request->get("status");
        $project->save();

        return response()->json([
            "success" => "Project has been successfully Updated."
        ]);

    }

    public function deleteProject($id)
    {
        $project = Project::findOrfail($id);
        try {
            $project->delete();
        } catch (\Exception $e) {
            return response()->json([
                "message" => $project->name . " in used"
            ], 422);
        }
        return response()->json([
            "success" => "Project has been successfully Deleted."
        ]);

    }
}
