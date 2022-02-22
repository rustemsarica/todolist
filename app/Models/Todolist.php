<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    use HasFactory;
    protected $table = 'todolist';
    public $timestamps = true;
    protected $fillable = [
        'task',
        'status',
        'is_deleted'
    ];

    public function add_task($input)
    {
        return Todolist::insert([
            'task' => $input['task'],
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
