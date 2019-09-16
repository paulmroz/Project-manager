<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        if(auth()->user()->isNot($project->owner)){
            abort(403);
        }

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title'=>'required',
            'description'=>'required|max:255',
            'notes' => 'min:3'
        ]);


        $project = auth()->user()->projects()->create($attributes);

        return redirect($project->path());
    }

    public function update(Project $project)
    {
        $this->authorize('update', $project);
//        if(auth()->user()->isNot($project->owner)){
//            abort(403);
//        }

        $project->update([
            'notes'=> request('notes')
        ]);

        return redirect($project->path());
    }
}
