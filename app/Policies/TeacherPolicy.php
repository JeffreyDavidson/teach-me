<?php

namespace App\Policies;

use App\Enums\UserRoleEnum;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeacherPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role->is(UserRoleEnum::ADMINISTRATOR);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Teacher  $teacher
     * @return mixed
     */
    public function view(User $user, Teacher $teacher)
    {
        return $user->role->is(UserRoleEnum::ADMINISTRATOR);
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role->is(UserRoleEnum::ADMINISTRATOR);
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Teacher  $teacher
     * @return mixed
     */
    public function update(User $user, Teacher $teacher)
    {
        return $user->role->is(UserRoleEnum::ADMINISTRATOR);
    }
}
