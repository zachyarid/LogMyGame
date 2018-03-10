<?php

namespace App\Policies;

use App\User;
use App\GameLocation;
use Illuminate\Auth\Access\HandlesAuthorization;

class GameLocationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the gameLocation.
     *
     * @param  \App\User  $user
     * @param  \App\GameLocation  $gameLocation
     * @return mixed
     */
    public function view(User $user, GameLocation $gameLocation)
    {
        return $user->id === $gameLocation->user_id;
    }

    /**
     * Determine whether the user can create gameLocations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the gameLocation.
     *
     * @param  \App\User  $user
     * @param  \App\GameLocation  $gameLocation
     * @return mixed
     */
    public function update(User $user, GameLocation $gameLocation)
    {
        return $user->id === $gameLocation->user_id;
    }

    /**
     * Determine whether the user can delete the gameLocation.
     *
     * @param  \App\User  $user
     * @param  \App\GameLocation  $gameLocation
     * @return mixed
     */
    public function delete(User $user, GameLocation $gameLocation)
    {
        return $user->id === $gameLocation->user_id;
    }
}
