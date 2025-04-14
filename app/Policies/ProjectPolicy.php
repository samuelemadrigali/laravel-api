<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    /**
     * Determine whether the user can view any projects.
     */
    public function view(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
    }

    /**
     * Determine whether the user can update the project.
     */
    public function update(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
    }

    /**
     * Determine whether the user can delete projects.
     */
    public function delete(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
    }
}
