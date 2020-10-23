<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Deliverable;

class WorkBreakdownStructure extends Model
{
    protected $guarded = [];
    
    protected $touches = ['project'];
    
    protected $table = 'wbs';
    
    public function path()
    {
        return $this->project->path().'/wbs/'.$this->id;
    }
    
    public function deliverables()
    {
        return $this->hasMany(Deliverable::class,'wbs_id')->orderby('order');
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
    public function add(Deliverable $deliverable)
    {
        $deliverable->wbs_id = $this->id;
        return $this->deliverables()->save($deliverable);
    }
    
    public function discard(Deliverable $deliverable)
    {
    	$this->deliverables()->where('id', $deliverable->id)->delete();
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
    
    public function scopeArchived($query)
    {
        return $query->where('actual', false)->get();
    }
    
}
