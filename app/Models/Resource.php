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
    	/*$query->with(['valued' => function (MorphTo $morphTo) {
    	        $morphTo->morphWith([
    	            Equipment::class => ['valuable']
    	        ]);
    	    }]);*/
	      
        $query->when($filter['type'] ?? false, fn($query, $slug)=>
            
            $query->whereHasMorph('valued', $type, fn($query) =>
	            $query->whereExists(fn($query)=>
	                $query->select('id')
	                    ->from('resource_types')
	                    ->where('resource_types.slug', '=',$slug)
	                    ->whereColumn('resource_types.id', '=','resources.type_id')
	                )
                /*->with(['valued' => function (MorphTo $morphTo) {
	                    $morphTo->morphWith([
	                        Equipment::class => ['valuable']
	                    ]);
	                }])*/
                )
            
        );
        
        //dd($filter); 
	    /*
	    $query->when($filter['type'] ?? false, function ($query, $resourceType) use ($type){

	        $query->whereHasMorph('valued', $type, function($query) use ($type, $resourceType){
                
                $query->where('type_id', $resourceType);
            });
	    });

        $query->when($filter['type'] ?? false, fn ($query, $resourceSlug)=>(
            $query->whereExists(function ($query) {
                var_dump($resourceSlug);
                $query->select()
                ->from('resource_types')
                ->whereColumn('resource_types.slug', $resourceSlug);
            })
        ));*/
 
	    
	    /*$query->when($filter['name'] ?? false, function ($query, $name) use ($type){

	        $query->whereHasMorph('valued', $type, function($query) use ($type, $name){
    	        
               $column = $type === Equipment::class ? 'model' : 'name';
               
               $query->where($column, 'like', '%'.$name.'%');
    	    });
	    });*/
	    
	    /*$query->with(['valued' => function (MorphTo $morphTo) {
	            $morphTo->morphWith([
	                Equipment::class => ['valuable']
	            ]);
	        }]);*/
        
        /*$query->with(['valued' => fn ($morphTo)=>
            $morphTo->morphWith([
                Equipment::class => ['valuable']
            ])
        ]);*/
	}

}
