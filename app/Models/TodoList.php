<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    protected $fillable = ['title', 'description', 'is_completed'];

    public function items()
    {
        return $this->hasMany(TodoItem::class);
    }

    public function markAsCompleted()
    {
        $this->is_completed = true;
        $this->save();
    }
}
