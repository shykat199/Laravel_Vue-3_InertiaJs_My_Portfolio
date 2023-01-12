<?php

namespace App\Http\Controllers;

use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $skills = SkillResource::collection(Skill::all());
        return Inertia::render('skills/index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('skills/create');
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
            'name' => ['required', 'min:3'],
            'image' => ['image', 'image'],
        ]);

        if ($request->has('image')) {
            $image = $request->file('image')->store('skills');
            Skill::create([
                'name' => $request->name,
                'image' => $image
            ]);
            return Redirect::route('skills.index')->with('success','Project Deleted Successfully');
        }
        return Redirect::back()->with('danger','Some Thing Wrong');
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
     * @param Skill $skill
     * @return Response
     */
    public function edit(Skill $skill): Response
    {
        return Inertia::render('skills/edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Skill $skill
     * @return RedirectResponse
     */
    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $image = $skill->image;
        $request->validate([
            'name' => ['required', 'min:3']
        ]);
        if ($request->hasFile('image')) {
            Storage::delete($skill->image);
            $image = $request->file('image')->store('skills');
        }

        $skill->update([
            'name' => $request->name,
            'image' => $image
        ]);

        return to_route('skills.index')->with('success','Project Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Skill $skill
     * @return RedirectResponse
     */
    public function destroy(Skill $skill): RedirectResponse
    {
        Storage::delete($skill->image);
        $skill->delete();
        return Redirect::back()->with('danger','Skill Deleted Successfully');
    }
}
