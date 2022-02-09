<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Suites\Sluggable;

class ResourceType extends Model
{
    use HasFactory, Sluggable;
    
    protected $guarded = [];
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function path($append){
        
        return route('resources_types.index').'/'.$this->id. ($append ? '/'.$append : '');
        
    }
    
    public function scopeFilterSlug($query, $slug) {
        
        return $query->where('slug',$slug);
    }
}
