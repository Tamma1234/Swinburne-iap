<?php

namespace App\Policies;

use App\Models\EventSwin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EventSwin  $eventSwin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, EventSwin $eventSwin)
    {
        return $user->checkRolePermisson(config('permissions.access.events.view_event'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->checkRolePermisson(config('permissions.access.events.add_event'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EventSwin  $eventSwin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, EventSwin $eventSwin)
    {
        return $user->checkRolePermisson(config('permissions.access.events.edit_event'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EventSwin  $eventSwin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, EventSwin $eventSwin)
    {
        return $user->checkRolePermisson(config('permissions.access.events.delete_event'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EventSwin  $eventSwin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, EventSwin $eventSwin)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EventSwin  $eventSwin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, EventSwin $eventSwin)
    {
        //
    }
}
