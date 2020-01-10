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
    
    
    /*
     * Get the parent deliverable
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
    
    
    /*
     * Get the child deliverables
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
    
    
}
