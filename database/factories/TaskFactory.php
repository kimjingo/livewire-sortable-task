<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Task;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            // 'project_id' => Project::factory(),
            'project_id' => $this->faker->randomElement(Project::all()),
            'priority' => $this->faker->randomNumber(),
        ];
    }
}
