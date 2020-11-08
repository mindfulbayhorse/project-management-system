<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectPolicy
{
    use HandlesAuthorization;
    
    public function update(User $user, Project $project){
        
        return $user->is($project->manager);
    }
    
    public function show(User $user, Project $project){
        
        return true;
    }
    
    public function create(User $user, Project $project){
        
        return true;
    }
}
