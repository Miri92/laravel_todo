<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';
    protected $fillable = [
        'title',
        'author',
        'description',
        'schedule'
    ];

    /**
     * The users that belong to the role.
     */
    public function Shared()
    {
        return $this->hasMany('App\Shared', 'todo_id', 'id');
    }
}
