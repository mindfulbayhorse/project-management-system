<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Suites\Sluggable;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    use HasFactory, Sluggable;
    
    protected $guarded = [];
    
    public $wbsLimit = 2;
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function path()
    {
        return "/projects/".$this->slug;
    }
    
    public function wbs()
    {
        return $this->hasMany(WorkBreakdownStructure::class, 'project_id', 'id');
    }   
    
    public function status()
    {     
        return $this->belongsTo(Status::class)->withDefault();;   
    }
    
    public function manager()
    {
        return $this->belongsTo(User::class,'manager_id')->withDefault();;
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
    
    public function scopeResourceTypes(Builder $query)
    {
        $resourceTypes ='select project_id, type_id, count(valuable_id) from resources group by project_id, type_id';

        return $query->leftJoinSub($resourceTypes, 'resources', 'id', 'resources.project_id')
                ->leftJoin('resource_types', 'type_id', '=', 'resource_types.id')->get();
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
        $this->team()->attach($user);
    }
    
    /*public function resources()
    {
        return $this->hasMany(Resource::class);
    }*/
    
    public function equipment()
    {
        return $this->morphedByMany(Equipment::class, 'valuable','resources','project_id','id');
    }
    
    
    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['status'] ?? false, fn ($query, $status) =>
            $query->whereHas('status',fn($query) => 
                $query->where('status_id', $status)
        ));
        
        $query->when($filter['title'] ?? false, fn ($query, $title) =>
            $query->where('title','like','%'.$title.'%')
        );
    }
    
}
