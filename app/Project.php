<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];
    
    public function deliverables() {
        
        return $this->hasMany(Deliverable::class);
    }
    
    public function addDeliverable($deliverable)
    {
        //dd($deliverable);
        
        $this->deliverables()->create($deliverable);
        
        return back();
    }
}
