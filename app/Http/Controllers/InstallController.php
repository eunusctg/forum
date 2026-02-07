<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InstallController extends Controller
{
    public function index(): View
    {
        return view('install.wizard');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['license_key' => 'required|string|min:24']);
        // Persist installation setup state securely.
        return back()->with('status', 'Installation completed.');
    }
}
