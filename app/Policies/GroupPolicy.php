<?php

namespace App\Policies;

use App\Models\Fu\Groups;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
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
     * @param  \App\Models\Fu\Groups  $groups
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Groups $groups)
    {
        return $user->checkRolePermisson(config('permissions.access.groups.view_groups'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->checkRolePermisson(config('permissions.access.groups.add_groups'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Fu\Groups  $groups
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Groups $groups)
    {
        return $user->checkRolePermisson(config('permissions.access.groups.edit_groups'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Fu\Groups  $groups
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Groups $groups)
    {
        return $user->checkRolePermisson(config('permissions.access.groups.delete_groups'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Fu\Groups  $groups
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Groups $groups)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Fu\Groups  $groups
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Groups $groups)
    {
        //
    }
}
