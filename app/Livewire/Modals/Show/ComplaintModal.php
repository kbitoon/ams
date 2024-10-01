<?php

namespace App\Livewire\Modals\Show;

use App\Models\Complaint;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class ComplaintModal extends ModalComponent
{
    public ?Complaint $complaint = null;

    /**
     * @param Complaint|null $complaint
     */
    public function mount(Complaint $complaint = null): void
    {
        if ($complaint && $complaint->exists) {
            $this->complaint = $complaint;
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render()
    {
        return view('livewire.complaint.view', [
            'complaint' => $this->complaint,
            'comments' => $this->complaint->comments ?? [],
        ]);
    }
}
