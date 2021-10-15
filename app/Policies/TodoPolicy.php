<?php

namespace App\Policies;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TodoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todo  $todo
     * @return mixed
     */
    public function view(User $user, Todo $todo)
    {
        return $todo->user_id === $user->getKey();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todo  $todo
     * @return mixed
     */
    public function update(User $user, Todo $todo)
    {
        return $todo->user_id === $user->getKey();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todo  $todo
     * @return mixed
     */
    public function delete(User $user, Todo $todo)
    {
        return $todo->user_id === $user->getKey();
    }
}
