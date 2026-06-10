<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('start_date', 'desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'partner_name' => 'nullable|string|max:255',
            'partner_logo' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'category'     => 'nullable|string|max:255',
            'tech_stack'   => 'nullable|string|max:500',
            'status'       => 'required|in:completed,ongoing',
        ], [
            'title.required'       => 'Judul project wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'start_date.required'  => 'Tanggal mulai wajib diisi.',
            'partner_logo.image'   => 'Logo harus berupa gambar.',
            'partner_logo.max'     => 'Logo maksimal 2MB.',
        ]);

        $data = $request->except('partner_logo');

        if ($request->hasFile('partner_logo')) {
            $data['partner_logo'] = $request->file('partner_logo')->store('logos', 'public');
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil ditambahkan!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'partner_name' => 'nullable|string|max:255',
            'partner_logo' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'category'     => 'nullable|string|max:255',
            'tech_stack'   => 'nullable|string|max:500',
            'status'       => 'required|in:completed,ongoing',
        ]);

        $data = $request->except(['partner_logo', '_method', '_token']);

        if ($request->hasFile('partner_logo')) {
            // Delete old logo
            if ($project->partner_logo) {
                Storage::disk('public')->delete($project->partner_logo);
            }
            $data['partner_logo'] = $request->file('partner_logo')->store('logos', 'public');
        }

        // Handle logo removal
        if ($request->boolean('remove_logo') && $project->partner_logo) {
            Storage::disk('public')->delete($project->partner_logo);
            $data['partner_logo'] = null;
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy(Project $project)
    {
        if ($project->partner_logo) {
            Storage::disk('public')->delete($project->partner_logo);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil dihapus!');
    }
}
