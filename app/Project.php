<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
    protected $guarded = [];
    
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
    
}
