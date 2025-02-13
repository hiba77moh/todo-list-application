<div>
    <div id="content" class="mx-auto" style="max-width:500px;">
        {{--  calling the sections  --}}
            @include('Livewire.includes.create-box')
            @include('Livewire.includes.search-box')
            @foreach ($todo as $todos)
            @include('Livewire.includes.todo-cards')
            @endforeach
            {{--  pagination  --}}
        <div class="my-2">
            {{$todo->links()}}
        </div>
    </div>
   
</div>
