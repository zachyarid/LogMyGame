<?php

namespace App\Policies;

use App\User;
use App\GameType;
use Illuminate\Auth\Access\HandlesAuthorization;

class GameTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the gameType.
     *
     * @param  \App\User  $user
     * @param  \App\GameType  $gameType
     * @return mixed
     */
    public function view(User $user, GameType $gameType)
    {
        return $user->id === $gameType->user_id;
    }

    /**
     * Determine whether the user can create gameTypes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the gameType.
     *
     * @param  \App\User  $user
     * @param  \App\GameType  $gameType
     * @return mixed
     */
    public function update(User $user, GameType $gameType)
    {
        return $user->id === $gameType->user_id;
    }

    /**
     * Determine whether the user can delete the gameType.
     *
     * @param  \App\User  $user
     * @param  \App\GameType  $gameType
     * @return mixed
     */
    public function delete(User $user, GameType $gameType)
    {
        return $user->id === $gameType->user_id;
    }
}
