<?php

namespace App\Livewire;

use App\Models\LuponCase as LuponCaseModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class LuponCase extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('refresh-list')]
    public function refresh() {}

    public function delete($id)
    {
        $luponCase = LuponCaseModel::find($id);
        
        if ($luponCase) {
            // Check if there are any associated assets (resolution files)
            foreach ($luponCase->assets as $asset) {
                if (file_exists(storage_path('app/public/' . $asset->path))) {
                    // Delete the resolution file from storage
                    unlink(storage_path('app/public/' . $asset->path));
                }
            }
            
            // Delete the associated assets from the database
            $luponCase->assets()->delete();  // Delete related assets records
            
            // Now delete the case
            $luponCase->delete();  // Delete the LuponCase record itself
            
            session()->flash('message', 'Case deleted successfully.');
        } else {
            session()->flash('error', 'Case not found.');
        }
    }
    



    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('livewire.lupon-case.listing', [
            'luponCases' => LuponCaseModel::orderBy('date', 'desc')->paginate(10),
        ]);
    }
}
