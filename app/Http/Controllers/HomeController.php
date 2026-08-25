<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $projects     = Project::orderBy('start_date', 'desc')->get();
        $certificates = Certificate::orderBy('sort_order', 'asc')->orderBy('issued_date', 'desc')->get();
        $clients      = Project::whereNotNull('partner_logo')
            ->whereNotNull('partner_name')
            ->select('partner_name', 'partner_logo')
            ->distinct()
            ->get();

        // Pre-process project data for JS modal (avoid complex Blade @json expressions)
        $projectsJson = $projects->map(function ($p) {
            return [
                'id'           => $p->id,
                'title'        => $p->title,
                'description'  => $p->description,
                'date'         => $p->start_date->format('M Y') . ($p->end_date ? ' – ' . $p->end_date->format('M Y') : ' – Sekarang'),
                'partner_name' => $p->partner_name,
                'partner_logo' => $p->partner_logo ? asset('storage/' . $p->partner_logo) : null,
                'tech_stack'   => $p->tech_stack ? array_map('trim', explode(',', $p->tech_stack)) : [],
                'category'     => $p->category,
                'status'       => $p->status,
            ];
        });

        return view('home', compact('projects', 'certificates', 'clients', 'projectsJson'));
    }
}
