<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Resource extends Model
{
    use HasFactory;
    
	protected $table = 'resources';
	protected $guarded = [];
	public $timestamps = false;
	
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
	   
	    $query->when($filter['type'] ?? false, function ($query, $resourceType) use ($type){
	        
	        //$query->where('type_id', $resourceType)
	        //    ->whereHasMorph('valued', $type);
	        
	        $query->whereHasMorph('valued', $type, function($query) use ($type, $resourceType){
                
                //$column = $type === Equipment::class ? 'name' : 'name';
                
                $query->where('type_id', $resourceType);
            });
	    });

	    
	    $query->when($filter['name'] ?? false, function ($query, $name) use ($type){

	        $query->whereHasMorph('valued', $type, function($query) use ($type, $name){
    	        
               $column = $type === Equipment::class ? 'name' : 'name';
               
               $query->where($column, 'like', '%'.$name.'%');
    	    });
	    });
	    
	    $query->with(['valued' => function (MorphTo $morphTo) {
	            $morphTo->morphWith([
	                Equipment::class => ['valuable']
	            ]);
	        }]);
	}

}
