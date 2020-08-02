<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkBreakdownStructure extends Model
{
    protected $guarded = [];
    protected $table = 'wbs';
    
    public function deliverables()
    {
        return $this->hasMany(Deliverable::class,'wbs_id');
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
    public function add($userInput)
    {
        $fields = array_merge(['wbs_id'=>$this->id], $userInput);
        return Deliverable::create($fields);
    }
    
    public function archive()
    {
        $this->actual=false;
        $this->save();
        
    }
    
    public function actualize()
    {
        $this->actual = true;
        $this->save();

    }
    
    public function scopeActual($query)
    {
        return $query->where('actual', true)->get();
    }
}
