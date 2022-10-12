<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Resource extends MorphPivot 
{
    use HasFactory;
    
	protected $table = 'resources';
	protected $guarded = [];
	public $timestamps = false;
	public $incrementing = true;
	
	public function resourceType()
	{
	    return $this->belongsTo(ResourceType::class, 'id', 'type_id');
	}
	
	public function project()
	{
	    return $this->belongsTo(Project::class);
	}

	public function valued()
	{
	    
	    return $this->morphTo('valuable');
	}
	
	public function scopeFilter($query, $type, $filter = [])
	{
	
	    $query->whereHasMorph('valued', $type);
	      
        $query->when($filter['type'] ?? false, fn($query, $slug)=>
            
            $query->whereHasMorph('valued', $type, fn($query) =>
	            $query->whereExists(fn($query)=>
	                $query->select('id')
	                    ->from('resource_types')
	                    ->where('resource_types.slug', '=',$slug)
	                    ->whereColumn('resource_types.id', '=','resources.type_id')
	                )
                )
            
        );
        
        
        $query->when($filter['model'] ?? false, function ($query, $name) use ($type) {
            
            $query->whereHasMorph('valued', $type, function($query) use ($type, $name){
                
                $column = $type === Equipment::class ? 'model' : 'name';
                
                $query->where($column, 'like', '%'.$name.'%');
            });
        });
        
       
	}

}
