<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Task;

class TaskRepository
{
    public function forUser (User $user)
    {
        return Task::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public function search (User $user, $searchData)
    {
        return Task::where('user_id',$user->id)->where('name','LIKE','%'.$searchData.'%')
                ->get();
    }
}