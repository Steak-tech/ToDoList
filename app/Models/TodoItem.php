<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoItem extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    protected $fillable = ['todo_list_id', 'title', 'description', 'is_completed'];

    public function todoList()
    {
        return $this->belongsTo(TodoList::class);
    }

    public function markAsCompleted()
    {
        $this->is_completed = true;
        $this->save();
    }
}
