<?php

namespace App\Livewire;

use App\Models\ClearanceInstruction as ClearanceInstructionModel;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ClearanceInstructionEditor extends Component
{
    public string $content = '';

    public function mount(): void
    {
        // Only allow superadmin access
        if (!Auth::user() || !Auth::user()->hasRole('superadmin')) {
            abort(403, 'Unauthorized access');
        }

        $instruction = ClearanceInstructionModel::first();
        $this->content = $instruction ? $instruction->content : '';
    }

    public function save(): void
    {
        // Only allow superadmin access
        if (!Auth::user() || !Auth::user()->hasRole('superadmin')) {
            abort(403, 'Unauthorized access');
        }

        $this->validate([
            'content' => 'required|string',
        ]);

        ClearanceInstructionModel::updateContent($this->content);

        session()->flash('message', 'Instructions updated successfully!');
    }

    public function render()
    {
        return view('livewire.clearance-instruction');
    }
}

