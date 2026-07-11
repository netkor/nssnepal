<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $search = $request->query('search');
        
        $query = Project::active();
        
        if ($status === 'ongoing') {
            $query->ongoing();
        } elseif ($status === 'completed') {
            $query->completed();
        }

        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }
        
        $projects = $query->paginate(6)->withQueryString();

        return view('pages.projects.index', compact('projects', 'status', 'search'));
    }

    public function show(Project $project)
    {
        if (!$project->is_active) {
            abort(404);
        }
        
        return view('pages.projects.show', compact('project'));
    }
}
