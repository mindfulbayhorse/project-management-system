<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProjectResource;


class Project extends Model
{
    protected $guarded = [];
    
    public $wbsLimit = 2;
    
    public function path()
    {
        return "/projects/".$this->id;
    }
    
    public function wbs()
    {
        return $this->hasMany(WorkBreakdownStructure::class, 'project_id', 'id');
    }   
    
    public function getWBS($wbsId)
    {
        return $this->wbs()->where('id', $wbsId);
    }
    
    public function status()
    {
        
        return $this->belongsTo(Status::class);
        
    }
    
    public function actualizeWBS(WorkBreakdownStructure $wbs)
    {
        foreach ($this->wbs()->actual() as $wbsOld){
            $wbsOld->archive();
        }
        
        $wbs->actualize();
    }
    
    
    public function initializeWBS($wbs)
    {
        
    	$this->guardAgainsTooManyWBS($wbs);
        
        $method = $wbs instanceOf WorkBreakdownStructure ? 'save' : 'saveMany';

        $this->wbs()->$method($wbs);
        
    }
    
    private function guardAgainsTooManyWBS($wbs)
    {
    	$newWBSCount = $wbs instanceOf WorkBreakdownStructure ? 1 : count($wbs);
    	
    	if ($this->wbs->count() + $newWBSCount > $this->wbsLimit){
            throw new \Exception;
        }
    }
    
    public function scopeLastUpdated($query){
    	
        $query->orderBy('updated_at', 'desc');    
    }
    
}
