<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\Task;
use Livewire\Component;

class TaskManager extends Component
{
    public $project=1;
    public $newTask = '';

    public function reorder($orderIds){
        // dd($orderIds);
        foreach($orderIds as $order => $task_id){
            Task::where('project_id', $this->project)
                ->where('id', $task_id)
                ->update([ 'priority' => $order ] );
        }

        // Task::where('project_id', $project)->update
    }

    public function render()
    {
        // dd($this->project);
        $tasks = Task::orderBy('priority')->where('project_id', $this->project)->get();
        return view('livewire.task-manager', [
            'projects' => Project::all(),
            'tasks' => $tasks
        ]);
    }

    public function add(){
        $max = Task::where('project_id', $this->project)->max('priority');
        Task::create([
            'name' => $this->newTask,
            'priority' => $max+1,
            'project_id' => $this->project
        ]);
        $this->newTask='';
    }

    public function delete($id){
        Task::where('project_id', $this->project)->where('id', $id)->delete();
    }
}
