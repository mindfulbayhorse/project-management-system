<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliverable extends Model
{
    protected $guarded = [];
    
    protected $table = 'deliverables';
    
    protected $primaryKey = 'id';
    
    /*
    * Get the project to which all deliverables are linked
    */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
}
