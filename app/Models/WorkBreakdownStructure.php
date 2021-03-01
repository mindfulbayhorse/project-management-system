<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Suites\RecordsActivity;

class WorkBreakdownStructure extends Model
{
    use RecordsActivity, HasFactory;
    
    protected $guarded = [];
    
    protected $touches = ['project'];
    
    protected $table = 'wbs';
    
    protected static $recordableEvents = ['created'];
    
    public $old = [];
    
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
    
    public function add(Array $deliverable)
    {
        $deliverable['wbs_id'] = $this->id;
        
        return $this->deliverables()->save(new Deliverable($deliverable));
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
    
    public function activities(){
        return $this->morphMany(Activity::class, 'subject')->latest();
    }
    
    public function activityRecords(){
        return $this->hasMany(Activity::class,'wbs_id')->oldest()->limit(15);
    }
    
    public function activityDescription($event){
        
        return $event;
    }
    
}
