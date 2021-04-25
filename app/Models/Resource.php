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
	    return $this->belongsTo(ResourceType::class, 'id', 'resource_type_id');
	}
	
	
	public function project()
	{
	    return $this->belongsTo(Project::class);
	}
	
	
	public function resources()
	{
	    
	    return $this->morphTo('valuable');
	}

}
