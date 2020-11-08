<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Activity;
use App\Suites\RecordsActivity;

class Deliverable extends Model
{
    use RecordsActivity;
    
    protected $guarded = [];
    
    protected $touches = ['projectWBS'];
    
    protected $casts = [
        'package' => 'boolean',
        'milestone' => 'boolean'
    ];
    
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
    
    public function makeAsPackage()
    {
    
        $this->update(['package' => true]);
    }
    
    public function makeAsNotPackage()
    {
        
        $this->update(['package' => false]);
    }
    
    public function makeAsMilestone()
    {
        
        $this->update(['milestone' => true]);
    }
    
    public function makeAsNotMilestone()
    {
        
        $this->update(['milestone' => false]);
    }
    
        
    public function activities()
    {
        return $this->morphMany(Activity::class, "subject");
    }
}
