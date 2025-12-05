<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TodoList;
use App\Models\User;

class TodoListFactory extends Factory
{
    protected $model = TodoList::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // génère un utilisateur si pas fourni
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(1),
        ];
    }
}
