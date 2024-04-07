<?php
namespace App\Livewire;

use App\Models\Project;
use App\Models\Task;
use Livewire\Component;

class TaskManager extends Component
{
    public $selectedProjectId;
    public $newTask;

    public function render()
    {
        return view('livewire.task-manager', [
            'tasks' => Task::orderBy('priority')
                ->where('project_id', $this->selectedProjectId)
                ->get()
        ]);
    }

    public function reorder($list)
    {
        foreach ($list as $order) {
            Task::find($order['value'])->update([
                'priority' => $order['order']
            ]);
        }
    }

    public function addTask(){
        $max = Task::where('project_id', $this->selectedProjectId)->max('priority');
        Task::create([
            'name' => $this->newTask,
            'priority' => $max+1,
            'project_id' => $this->selectedProjectId
        ]);
        $this->newTask='';
    }

    public function addProject($newProject){
        Project::create([
            'name' => $newProject,
        ]);
        // $this->newTask='';
    }

    public function removeTask($id){
        Task::where('project_id', $this->selectedProjectId)->where('id', $id)->delete();
    }

    public function removeProject($id){
        Project::where('id', $id)->delete();
    }

}
