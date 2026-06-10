<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProjects = Project::count();
        $totalCertificates = Certificate::count();
        $totalClients = Project::whereNotNull('partner_logo')->distinct('partner_name')->count();
        $recentProjects = Project::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProjects',
            'totalCertificates',
            'totalClients',
            'recentProjects'
        ));
    }
}
