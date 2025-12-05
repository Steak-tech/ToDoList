<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TodoItem;
use App\Models\TodoList;

class TodoItemFactory extends Factory
{
    protected $model = TodoItem::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'todo_list_id' => TodoList::factory(), // génère une liste si pas fournie
            'description' => $this->faker->sentence(4),
            'is_completed' => $this->faker->boolean(30), // 30% de chances d’être coché
        ];
    }
}
