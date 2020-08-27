<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliverable extends Model
{
    protected $guarded = [];
    
    /*
    * Get the project to which all deliverables are linked
    */
    public function projectWBS()
    {
        return $this->belongsTo(WorkBreakdownStructure::class);
    }
    
    
    /*
     * Get the parent deliverable
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
    
    
    /*
     * Get the child deliverables
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
    
    
}
