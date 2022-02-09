<?php

namespace App\Observers;

use App\Models\ResourceType;
use Illuminate\Support\Str;

class ResourceTypeObserver
{
    
    public function creating(ResourceType $resourceType)
    {
        
        $resourceType->slug = $resourceType->createUniqueSlug($resourceType->name);
        
    }
    
    public function updating(ResourceType $resourceType)
    {
        $resourceType->slug = Str::slug($resourceType->name);
    }
    
    /**
     * Handle the ResourceType "created" event.
     *
     * @param  \App\Models\ResourceType  $resourceType
     * @return void
     */
    public function created(ResourceType $resourceType)
    {
        //
    }

    /**
     * Handle the ResourceType "updated" event.
     *
     * @param  \App\Models\ResourceType  $resourceType
     * @return void
     */
    public function updated(ResourceType $resourceType)
    {
        //
    }

    /**
     * Handle the ResourceType "deleted" event.
     *
     * @param  \App\Models\ResourceType  $resourceType
     * @return void
     */
    public function deleted(ResourceType $resourceType)
    {
        //
    }

    /**
     * Handle the ResourceType "restored" event.
     *
     * @param  \App\Models\ResourceType  $resourceType
     * @return void
     */
    public function restored(ResourceType $resourceType)
    {
        //
    }

    /**
     * Handle the ResourceType "force deleted" event.
     *
     * @param  \App\Models\ResourceType  $resourceType
     * @return void
     */
    public function forceDeleted(ResourceType $resourceType)
    {
        //
    }
}
