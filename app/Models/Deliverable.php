<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Suites\RecordsActivity;
use Carbon\Carbon;
use App\Macros\DateFormatting;

class Deliverable extends Model
{
    use RecordsActivity, HasFactory;

    protected $guarded = [];
    
    protected $touches = ['wbs'];
    
    protected $casts = [
        'package' => 'boolean',
        'milestone' => 'boolean'
    ];
    
    /*
    * Get the project to which all deliverables are linked
    */
    public function wbs()
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
  
        return route('deliverable', [
            'project' => $this->wbs->project,
            'deliverable' => $this,
        ], false);
    }
    
    public function makeAsPackage($flag = true)
    {
    
        $this->update(['package' => $flag]);

    }
    
    public function makeAsMilestone($flag = true)
    {
        
        $this->update(['milestone' => $flag]);
    }
    
    
    public function activities()
    {
        return $this->morphMany(Activity::class, "subject");
    }
    
    public function getStartDate()
    {

        Carbon::mixin(new DateFormatting());
        
        return $this->start_date->formatForUser();
    }
    
    /*
     * Checking out attribute for new value
     * @param string  - attribute name
     */
    public function hasChanged(string $attr): bool
    {
     
        if ($this->$attr !== $this->getOriginal($attr)) return true;
        
        return false;
    }
    
    
    public function scopeFilterDeliverables($query, $filters)
    {

        return 
            $query
            ->when($filters['start_date'] ?? false, function ($query, $startDate) {
                
                return $query->where('start_date', '>=', Carbon::createFromTimestamp($startDate));
            })
            ->when($filters['end_date'] ?? false, function ($query, $endDate) {
                
                return $query->where('end_date', '<=', Carbon::createFromTimestamp($endDate));
            })
            ->get();
        
    }
}
