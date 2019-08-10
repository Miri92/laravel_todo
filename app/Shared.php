<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shared extends Model
{
    protected $table = 'shareds';
    protected $fillable = [
        'todo_id',
        'shared_with',
    ];

    /**
     * The users that belong to the role.
     */
    public function todos()
    {
        return $this->hasMany('App\Todo', 'id', 'todo_id');
    }

    public function getUserNameAttribute() {
        $details = User::where('id', $this->attributes['shared_with'])->first();

        if ($details){
            return $details->name;
        }

    }
}
