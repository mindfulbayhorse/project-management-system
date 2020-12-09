<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Suites\RecordsActivity;

class Deliverable extends Model
{
    use RecordsActivity, HasFactory;

    
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
        
        //return $this->projectWBS->project->path()."/deliverables/{$this->id}";
        return route('projects.deliverables.show', [
            'project' => $this->projectWBS->project, 
            'deliverable' => $this
        ]);
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
