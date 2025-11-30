<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Department;

class DepartmentPolicy
{
    /**
     * Determine whether the user can view any departments.
     */
    public function viewAny(User $user): bool
    {
        
        return in_array($user->role, ['administrator', 'manager', 'user']);
    }

    /**
     * Determine whether the user can view a single department.
     */
    public function view(User $user, Department $department): bool
    {
        
        return in_array($user->role, ['administrator', 'manager', 'user']);
    }

    /**
     * Determine whether the user can create departments.
     */
    public function create(User $user): bool
    {
        
        return $user->role === 'administrator';
    }

    /**
     * Determine whether the user can update departments.
     */
    public function update(User $user, Department $department): bool
    {
        
        return in_array($user->role, ['administrator', 'manager']);
    }

    /**
     * Determine whether the user can delete departments.
     */
    public function delete(User $user, Department $department): bool
    {
        
        return $user->role === 'administrator';
    }
}
