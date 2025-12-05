<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TodoItem;
use App\Models\TodoList;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'aze',
            'email' => 'test@example.com',
            'password' => 'aze',
        ]);

        ToDoList::factory()->create([
            'title' => 'Personal Tasks',
            'user_id' => 1,
            'id' => 1,
            'description' => 'Tasks for personal organization',
        ]);
        TodoItem::factory()->create([
            'todo_list_id' => 1,
            'description' => 'Buy groceries',
            'is_completed' => false,
            'title' => 'Grocery Shopping',
        ]);
        TodoItem::factory()->create([
            'todo_list_id' => 1,
            'description' => 'Call the bank to discuss account options',
            'is_completed' => true,
            'title' => 'Bank Call',
        ]);

        ToDoList::factory()->create([
            'title' => 'Work Tasks',
            'user_id' => 1,
            'id' => 2,
            'description' => 'Tasks related to work projects',
        ]);
        TodoItem::factory()->create([
            'todo_list_id' => 2,
            'description' => 'Finish the quarterly report',
            'is_completed' => false,
            'title' => 'Quarterly Report',
        ]);
        TodoItem::factory()->create([
            'todo_list_id' => 2,
            'description' => 'Prepare slides for the upcoming presentation',
            'is_completed' => false,
            'title' => 'Presentation Slides',
        ]);

        //generate one more set of data
        ToDoList::factory()->create([
            'title' => 'Shopping List',
            'user_id' => 1,
            'id' => 3,
            'description' => 'Items to buy this weekend',
        ]);
        TodoItem::factory()->create([
            'todo_list_id' => 3,
            'description' => 'Buy a new laptop',
            'is_completed' => false,
            'title' => 'New Laptop',
        ]);
        TodoItem::factory()->create([
            'todo_list_id' => 3,
            'description' => 'Get groceries for the week',
            'is_completed' => true,
            'title' => 'Weekly Groceries',
        ]); 
        TodoItem::factory()->create([
            'todo_list_id' => 3,
            'description' => 'Purchase birthday gift for Sarah',
            'is_completed' => false,
            'title' => 'Birthday Gift',
        ]);
        ToDoItem::factory()->create([
            'todo_list_id' => 3,
            'description' => 'Buy new running shoes',
            'is_completed' => false,
            'title' => 'Running Shoes',
        ]);

        //one more set of data
        ToDoList::factory()->create([
            'title' => 'Home Improvement',
            'user_id' => 1,
            'id' => 4,
            'description' => 'Tasks for renovating the house',
        ]);
        TodoItem::factory()->create([
            'todo_list_id' => 4,
            'description' => 'Paint the living room',
            'is_completed' => false,
            'title' => 'Living Room Paint',
        ]);
        TodoItem::factory()->create([
            'todo_list_id' => 4,
            'description' => 'Fix the leaking faucet in the kitchen',
            'is_completed' => true,
            'title' => 'Fix Kitchen Faucet',
        ]); 
    }
}
