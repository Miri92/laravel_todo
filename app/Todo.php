<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
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
        return $this->belongsToMany('App\Shared', 'shareds','shared_with','todo_id');
    }
}
