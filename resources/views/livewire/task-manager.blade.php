<div class="my-auto">
    <h2 class="text-3xl my-5 bg-slate-300">Tasks with priority - {{ $selectedProjectId }}</h2>
    <div class="border mb-2">
        <select name="project" 
            wire:model.live='selectedProjectId'
            id="project"
            class="w-full p-2 mb-2"
        >
            <option value=>Select a project</option>
            @foreach(App\Models\Project::all() as $proj)
            <option value={{ $proj->id }}>{{ $proj->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="border-t">
        <form 
            class="flex justify-between mb-1"
            wire:submit.prevent="addTask"
        >
            <input type="text" wire:model="newTask" class="grow" name="newtask">
            <button class="border px-3">add</button>
        </form>
        <ul wire:sortable="reorder"
            class="overflow-hidden rounded shadow-sm"
        >
            @foreach($tasks as $task)
                <li wire:key="task-{{ $task->id }}" 
                    wire:sortable.item="{{ $task->id }}"
                    class="flex justify-between border p-2"
                >
                    <div>
                        {{ $task->name }}
                    </div>
                    <div wire:click="delete({{ $task->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>