<?php

namespace App\Policies;

use App\Models\Golds;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GoldPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Golds  $golds
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Golds $golds)
    {
        return $user->checkRolePermisson(config('permissions.access.gold.view_gold'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->checkRolePermisson(config('permissions.access.gold.add_gold'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Golds  $golds
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Golds $golds)
    {
        return $user->checkRolePermisson(config('permissions.access.gold.edit_gold'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Golds  $golds
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Golds $golds)
    {
        return $user->checkRolePermisson(config('permissions.access.gold.delete_gold'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Golds  $golds
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Golds $golds)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Golds  $golds
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Golds $golds)
    {
        //
    }
}
