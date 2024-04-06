<div class="my-auto">
    <h2>Tasks with priority - {{ $project }}</h2>
    <select name="project" wire:model.live='project' id="project" class="p-2 mb-2">
        <option value=>Select a project</option>
        @foreach($projects as $project)
        <option value={{ $project->id }}>{{ $project->name }}</option>
        @endforeach
    </select>
    <form wire:submit="add" class="flex justify-between mb-3">
        <input type="text" wire:model="newTask" class="shrink-0">
        <button class="border px-2">add</button>
    </form>
    <div>
        <ul drag-root="reorder"
            class="overflow-hidden rounded shadow-sm">
            @foreach($tasks as $task)
                <li
                    class="flex justify-between border p-2"
                    wire:key="{{ $task->id }}"
                    drag-item="{{ $task->id }}"
                    draggable="true"
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
<script>
    let root = document.querySelector('[drag-root]')
    root.querySelectorAll('[drag-item]').forEach(el => {
        el.addEventListener('dragstart', e => {
            console.log("Drag starts")
            e.target.setAttribute('dragging', true)
            
        })
        el.addEventListener('drop', e => {
            console.log("Drops")
            e.target.classList.remove('bg-yellow-100')
            let draggingEl = root.querySelector('[dragging]')
            e.target.before(draggingEl)

            // refresh the livewire
            let component = Livewire.find(
                e.target.closest('[wire\\:id]').getAttribute('wire:id')
            )
            let orderIds = Array.from(root.querySelectorAll('[drag-item]'))
                .map(itemEl => itemEl.getAttribute('drag-item') )

            let method = root.getAttribute('drag-root')

            component.call(method, orderIds)

        })

        el.addEventListener('dragenter', e => {
            console.log("Drag enters")
            e.target.classList.add('bg-yellow-100')
            e.preventDefault();
        })

        el.addEventListener('dragover', e => {
            console.log("Drag over")
            e.preventDefault();
        })

        el.addEventListener('dragleave', e => {
            e.target.classList.remove('bg-yellow-100')
            console.log("Drag leaves")
        })

        el.addEventListener('dragend', e => {
            console.log("Drag ends")
            e.target.removeAttribute('dragging')
        })

    })
</script>
