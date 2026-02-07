<?php

namespace App\Livewire\Admin;

use App\Models\Report;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AnalyticsCards extends Component
{
    public function render(): View
    {
        return view('livewire.admin.analytics-cards', [
            'users' => User::count(),
            'threads' => Thread::count(),
            'reports' => Report::where('status', 'open')->count(),
        ]);
    }
}
