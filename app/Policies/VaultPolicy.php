<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vault;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class VaultPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny()
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vault  $vault
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Vault $vault)
    {
        return $vault->user()
            ->get()->first()->id === $user->id
            ? Response::allow()
            : Response::deny('This vault is not available.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vault  $vault
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Vault $vault)
    {
        return $vault->user()
            ->get()->first()->id === $user->id
            ? Response::allow()
            : Response::deny('Permission denied.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vault  $vault
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Vault $vault)
    {
        return $vault->user()
            ->get()->first()->id === $user->id
            ? Response::allow()
            : Response::deny('Permission denied.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vault  $vault
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Vault $vault)
    {
        return $vault->user()
            ->get()->first()->id === $user->id
            ? Response::allow()
            : Response::deny('Permission denied.');
    }
}
