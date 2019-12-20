<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];
    
    protected $table = 'projects';
    
    protected $primaryKey = 'id';
    
    public function deliverables() {
        
        return $this->hasMany(Deliverable::class);
    }
}
