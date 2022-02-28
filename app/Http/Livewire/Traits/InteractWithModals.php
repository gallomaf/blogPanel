<?php

namespace App\Http\Livewire\Traits;

trait InteractWithModals
{
    public function create($params = null)
    {

        $this->resetCreateForm($params);
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isDialogOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isDialogOpen = false;
    }


}
