<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Database\Events\StatementPrepared;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $projects = ProjectResource::collection(Project::with('skill')->get());
        return Inertia::render('projects/index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        $skills = Skill::all();
        return Inertia::render('projects/create', compact('skills'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required'],
            'image' => ['required', 'image'],
            'skill_id' => ['required'],

        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('projects');
            Project::create([
                'skill_id' => $request->skill_id,
                'name' => $request->name,
                'image' => $image,
                'project_url' => $request->project_url
            ]);

            return to_route('projects.index')->with('success', 'Created Successfully');
        }

        return Redirect::back();


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return Response
     */
    public function edit(Project $project): Response
    {
        $skills=Skill::all();
        return Inertia::render('projects/edit',compact('project','skills'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Project $project
     * @return RedirectResponse
     */
    public function update(Request $request, Project $project)
    {
        $image=$project->image;
        $request->validate([
            'name' => ['required'],
            'skill_id' => ['required'],
        ]);
        if ($request->hasFile('image')){
            Storage::delete($project->image);
            $image=$request->file('image')->store('projects');
        }
        $project->update([
            'skill_id' => $request->skill_id,
            'name' => $request->name,
            'image' => $image,
            'project_url' => $request->project_url
        ]);

        return to_route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return RedirectResponse
     */
    public function destroy(Project $project): RedirectResponse
    {
        Storage::delete($project->image);
        $project->delete();
        return Redirect::back()->with('danger','Project Deleted Successfully');
    }
}
