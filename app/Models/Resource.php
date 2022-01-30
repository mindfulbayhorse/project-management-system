<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


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

	public function resource()
	{
	    
	    return $this->morphTo('valuable');
	}
	
	public function scopeFilter($query, $type, $filter)
	{
	
	    $query->whereHasMorph('resource', $type);

	    $query->when($filter['type'] ?? false, function ($query, $resourceType) use ($type){
	        
	        $query->where('type_id', $resourceType)
	            ->whereHasMorph('resource', $type);
	    });
	    
	    $query->when($filter['name'] ?? false, function ($query, $name) use ($type){

	        $query->whereHasMorph('resource', $type, function($query) use ($type, $name){
    	        
               $column = $type === Equipment::class ? 'name' : 'name';
               
               $query->where($column, 'like', '%'.$name.'%');
    	    });
	    });
	}

}
