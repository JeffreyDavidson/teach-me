<?php

namespace App\Policies;

use App\Enums\UserRoleEnum;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SemesterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role->is(UserRoleEnum::ADMINISTRATOR);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role->is(UserRoleEnum::ADMINISTRATOR);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Semester  $semester
     * @return mixed
     */
    public function update(User $user, Semester $semester)
    {
        return $user->role->is(UserRoleEnum::ADMINISTRATOR);
    }
}
