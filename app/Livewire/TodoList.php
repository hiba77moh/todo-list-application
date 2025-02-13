<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Withpagination;
use Livewire\Attributes\Rule;
use App\Models\todo ;


class TodoList extends Component
{

    use Withpagination ;


    #[Rule(['required', 'min:2'])]

    public $name;
    public $search;


    public function create(){
        $validate=$this->validateOnly('name');
        todo::create($validate);
        $this->reset('name');
        request()->session()->flash('success' ,'created successfully');
    }


    public function render()
    {
        return view('livewire.todo-list',[
            'todo' => todo::latest()->where('name','like',"%{$this->search}%")->paginate(5)
        ]);
    }
}
