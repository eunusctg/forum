<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ModerationController extends Controller
{
    public function index(): View
    {
        return view('admin.moderation', [
            'reports' => Report::with('reporter')->latest()->paginate(25),
        ]);
    }

    public function update(Request $request, Report $moderation): RedirectResponse
    {
        $moderation->update($request->validate(['status' => 'required|in:open,reviewing,resolved,dismissed']));
        return back()->with('status', 'Report updated.');
    }
}
