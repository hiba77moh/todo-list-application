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
    public $editingId;

    #[Rule(['required', 'min:2'])]
    public $editingName ; 


    public function create(){
        $validate=$this->validateOnly('name');
        todo::create($validate);
        $this->reset('name');
        request()->session()->flash('success' ,'created successfully');
    }

    public function remove($todoId){
        todo::find($todoId)->delete();

    }

    public function check($todoId){
       $todo=todo::find($todoId);
       $todo->completed =  !$todo->completed ;
       $todo->save();
    }

    public function edit($todoId){
        $this->editingId = $todoId;
        $this->editingName = todo::find($todoId)->name ;
    }

    public function cancelEditing (){
        $this->reset(['editingName' , 'editingId']);
    }

    public function update(){
        $this->validateOnly('editingName');
        todo::find($this->editingId)->update(
            [
                'name' => $this->editingName
            ]);

        $this->cancelEditing();
    }


    public function render()
    {
        return view('livewire.todo-list',[
            'todo' => todo::latest()->where('name','like',"%{$this->search}%")->paginate(5)
        ]);
    }
}
