<?php

namespace App\Policies;

use App\Models\Deliverable;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeliverablePolicy
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
        return true;
    }
    
    
    public function before(User $user, $ability)
    {
        
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Deliverable  $deliverable
     * @return mixed
     */
    public function view(User $user, Deliverable $deliverable)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isManager();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Deliverable  $deliverable
     * @return mixed
     */
    public function update(User $user, Deliverable $deliverable)
    {
        return $user->isManager();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Deliverable  $deliverable
     * @return mixed
     */
    public function delete(User $user, Deliverable $deliverable)
    {
        return $user->isManager();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Deliverable  $deliverable
     * @return mixed
     */
    public function restore(User $user, Deliverable $deliverable)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Deliverable  $deliverable
     * @return mixed
     */
    public function forceDelete(User $user, Deliverable $deliverable)
    {
        //
    }
}
