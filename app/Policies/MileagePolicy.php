<?php

namespace App\Policies;

use App\User;
use App\Mileage;
use Illuminate\Auth\Access\HandlesAuthorization;

class MileagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the mileage.
     *
     * @param  \App\User  $user
     * @param  \App\Mileage  $mileage
     * @return mixed
     */
    public function view(User $user, Mileage $mileage)
    {
        return $user->id === $mileage->user_id;
    }

    /**
     * Determine whether the user can create mileages.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the mileage.
     *
     * @param  \App\User  $user
     * @param  \App\Mileage  $mileage
     * @return mixed
     */
    public function update(User $user, Mileage $mileage)
    {
        return $user->id === $mileage->user_id;
    }

    /**
     * Determine whether the user can delete the mileage.
     *
     * @param  \App\User  $user
     * @param  \App\Mileage  $mileage
     * @return mixed
     */
    public function delete(User $user, Mileage $mileage)
    {
        return $user->id === $mileage->user_id;
    }
}
