<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
    protected $guarded = [];
    
    public function wbs()
    {
        return $this->hasMany(WorkBreakdownStructure::class);
    }   
    
    public function getWBS($wbsId)
    {
        return $this->wbs()->where('id', $wbsId);
    }
    
    public function status()
    {
        
        return $this->belongsTo(Status::class);
        
    }
    
    public function actualizeWBS(WorkBreakdownStructure $Wbs)
    {
        foreach ($this->wbs()->actual() as $wbsOld){
            $wbsOld->archive();
        }
        
        $Wbs->actualize();
    }
    
}
