<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public $wbsLimit = 2;
    
    protected $dateFormat = 'Y-m-d';
    
    public function path()
    {
        return "/projects/".$this->id;
    }
    
    public function wbs()
    {
        return $this->hasMany(WorkBreakdownStructure::class, 'project_id', 'id');
    }   
    
    public function status()
    {     
        return $this->belongsTo(Status::class);   
    }
    
    public function manager()
    {
    	return $this->belongsTo(User::class,'user_id');
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

        return $this->wbs()->$method($wbs);
        
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
    
    public function createWBS(){
        
        $wbs = new WorkBreakdownStructure();
        $this->initializeWBS($wbs);
        $this->actualizeWBS($wbs);
    }
    
    public function team()
    {
        return $this->belongsToMany(User::class, 'project_team');
    }
    
    public function addMember(User $user)
    {
        $this->team()->save($user);
    }
    
}
