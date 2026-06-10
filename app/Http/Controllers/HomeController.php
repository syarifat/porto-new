<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('start_date', 'desc')->get();
        $certificates = Certificate::orderBy('issued_date', 'desc')->get();
        $clients = Project::whereNotNull('partner_logo')
            ->whereNotNull('partner_name')
            ->select('partner_name', 'partner_logo')
            ->distinct()
            ->get();

        return view('home', compact('projects', 'certificates', 'clients'));
    }
}
