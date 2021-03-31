<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResourceType extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function path($append){
        
        return route('resources_types.index').'/'.$this->id. ($append ? '/'.$append : '');
        
    }
}
