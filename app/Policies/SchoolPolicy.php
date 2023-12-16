<?php

namespace App\Policies;

use App\Models\School;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SchoolPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // return in_array($user->role, ['system_admin', 'admin']);
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, School $school): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['system_admin']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, School $school): bool
    {
        return in_array($user->role, ['system_admin', 'admin']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, School $school): bool
    {
        return in_array($user->role, ['system_admin', 'admin']);
    }
}
