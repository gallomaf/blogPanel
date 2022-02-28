<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\InteractWithModals;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination, InteractWithModals;

    //standard
    public $model_id;
    public bool $isDialogOpen   = false;
    public $search              = '';
    public $className           = "";

    public  $title, $subtitle, $content, $state;

    public function render()
    {
        return view('livewire.posts', [
            'items'     => Post::where('title','like',"%$this->search%")->orderBy('id', 'desc')->paginate(25),
        ]);
    }

    private function resetCreateForm(){



        $this->model_id     = null;
        $this->title        = null;
        $this->subtitle     = null;
        $this->content      = null;

        $this->state        = null;
    }

    public function store()
    {


        $this->validate([
            'title'         => 'required|string',
            'subtitle'      => 'nullable|string',
            'content'       => 'nullable|integer',
            'state'         => 'nullable|integer',
        ]);


        Post::updateOrCreate(['id' => $this->model_id], [
            'title'         => $this->title,
            'subtitle'      => $this->subtitle,
            'content'       => $this->content,
            'state'         => $this->state,
        ]);



        session()->flash('message', $this->model_id ? "$this->className aggiornato!" : "$this->className creato!");

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $oggetto = Post::findOrFail($id);
        $this->model_id     = $id;

        $this->title        = $oggetto->title;
        $this->subtitle     = $oggetto->subtitle;
        $this->content      = $oggetto->content;

        $this->state        = $oggetto->state;

        $this->openModalPopover();
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', "$this->nomeClasse cancellato!");
    }
}
