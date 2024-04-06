<div class="my-auto">
    <h2>Tasks with priority - {{ $project }}</h2>
    <select name="project" wire:model.live='project' id="project">
        <option value=>Select a project</option>
        @foreach($projects as $project)
        <option value={{ $project->id }}>{{ $project->name }}</option>
        @endforeach
    </select>
    <div>
        <ul drag-root
            class="overflow-hidden rounded shadow-sm">
            @foreach($tasks as $task)
                <li
                    wire:key="{{ $task->id }}"
                    drag-item
                    draggable="true"
                >{{ $task->name }}</li>
            @endforeach
        </ul>
    </div>
</div>
<script>
    let root = document.querySelector('[drag-root]')
    console.log(root)
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
