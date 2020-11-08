<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deliverable extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    protected $touches = ['projectWBS'];
    
    /*
    * Get the project to which all deliverables are linked
    */
    public function projectWBS()
    {
        return $this->belongsTo(WorkBreakdownStructure::class, 'wbs_id');
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
    
    public function scopeOrdered($query)
    {
        return $query->orderby('order')->get();
    }
    
    public function path()
    {
        
        return "/projects/{$this->projectWBS->project_id}/deliverables/{$this->id}";
    }
    
    
}
