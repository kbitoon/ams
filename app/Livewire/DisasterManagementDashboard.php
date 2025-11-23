<?php

namespace App\Livewire;

use App\Models\DisasterEvent;
use App\Models\DisasterAlert;
use App\Models\PreparednessChecklist;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DisasterManagementDashboard extends Component
{
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $activeEventsCount = DisasterEvent::where('status', 'active')->count();
        $activeAlertsCount = DisasterAlert::active()->count();
        $checklistsCount = PreparednessChecklist::where('is_active', true)->count();

        return view('livewire.disaster-management.dashboard', [
            'activeEventsCount' => $activeEventsCount,
            'activeAlertsCount' => $activeAlertsCount,
            'checklistsCount' => $checklistsCount,
        ]);
    }
}

