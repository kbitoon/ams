<?php

namespace App\Livewire;

use App\Models\DisasterEvent;
use App\Models\DisasterMonitoringLog;
use App\Models\DisasterAlert;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DisasterMonitoring extends Component
{
    public ?DisasterEvent $selectedEvent = null;
    public string $eventFilter = '';

    public function selectEvent($eventId)
    {
        $this->selectedEvent = DisasterEvent::with([
            'disasterType',
            'monitoringLogs.loggedBy',
            'alerts.issuedBy',
            'resources',
            'recoveryActivities'
        ])->find($eventId);
        $this->eventFilter = $eventId;
    }

    public function clearSelection()
    {
        $this->selectedEvent = null;
        $this->eventFilter = '';
    }

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $activeEvents = DisasterEvent::where('status', 'active')
            ->with(['disasterType'])
            ->orderBy('start_date', 'desc')
            ->get();

        $recentAlerts = DisasterAlert::active()
            ->with(['disasterEvent', 'issuedBy'])
            ->orderBy('issued_at', 'desc')
            ->limit(5)
            ->get();

        $recentLogs = DisasterMonitoringLog::with(['disasterEvent', 'loggedBy'])
            ->orderBy('logged_at', 'desc')
            ->limit(10)
            ->get();

        return view('livewire.disaster-monitoring.dashboard', [
            'activeEvents' => $activeEvents,
            'recentAlerts' => $recentAlerts,
            'recentLogs' => $recentLogs,
        ]);
    }
}
