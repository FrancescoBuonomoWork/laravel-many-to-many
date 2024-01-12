<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule as ValidationRule;
use App\Models\Type;
use App\Models\Technology;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.project.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required|max:150|string|unique:projects',
            'type_id' => 'nullable|exists:types,id',
            'technologies.*' => 'exists:technologies,id',
            'image'=> 'nullable|image|max:255',
        ]);

        $data = $request->all();

        // logica per recuperare l immagine 
        $imagePath = Storage::put('uploads', $request->image);

        $data['image'] = $imagePath;

        //fine lofica per recuperare l immagine

        // dd($request->technologies);
        $new_project = Project::create($data);

        if ($request->has('technologies')) {
            $new_project->technologies()->attach($request->get('technologies'));
        } else{
            $new_project->technologies()->detach(0);
        }

        return redirect()->route('admin.project.store', $new_project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {

        return view('admin.project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {

        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.project.edit', compact('project', 'types','technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        /*
        dd($request->validate([
            'name' => ['required','max:255','string',ValidationRule::unique('projects')->ignore($project->id)],
            'type_id' => ['nullable|exists:types,id']
           
        ]));
        */
        $project->update($request->validated());
        // dd($request->technologies);
        if ($request->has('technologies')) {
                $project->technologies()->sync($request->get('technologies'));      
         } else{
            $project->technologies()->detach();
         }

        return redirect()->route('admin.project.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.project.index');
    }
}
