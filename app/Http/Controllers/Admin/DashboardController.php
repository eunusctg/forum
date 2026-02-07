<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'metrics' => [
                'users' => User::count(),
                'threads' => Thread::count(),
                'openReports' => Report::where('status', 'open')->count(),
            ],
            'latestReports' => Report::latest()->limit(10)->get(),
        ]);
    }
}
