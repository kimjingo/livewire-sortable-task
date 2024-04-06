<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\Task;
use Livewire\Component;

class TaskManager extends Component
{
    public $project=1;

    public function render()
    {
        // dd($this->project);
        $tasks = Task::where('project_id', $this->project)->get();
        return view('livewire.task-manager', [
            'projects' => Project::all(),
            'tasks' => $tasks
        ]);
    }
}
