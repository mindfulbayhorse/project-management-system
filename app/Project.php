<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];
    public $wbs = [];
    
    public function wbs()
    {
        return $this->hasMany(WorkBreakdownStructure::class);
    }   
    
    public function deliverables()
    {
        return $this->hasManyThrough(Deliverable::class, 
                        WorkBreakdownStructure::class, 
                        'project_id',
                        'wbs_id');
    }
    
    public function status() {
        
        return $this->belongsTo(Status::class);
        
    }
    
}
