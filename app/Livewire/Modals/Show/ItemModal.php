<?php

namespace App\Livewire\Modals\Show;

use App\Models\Item;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class ItemModal extends ModalComponent
{
    public ?Item $item = null;

    /**
     * @param Item|null $information
     */
    public function mount(Item $item = null): void
    {
        if ($item && $item->exists) {
            $this->item = $item;
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render()
    {
        return view('livewire.item.view', [
            'item' => $this->item,
        ]);
    }
}
