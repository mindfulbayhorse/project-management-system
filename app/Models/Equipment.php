<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Suites\Resourcefulness;
use App\Models\Supplier;

class Equipment extends Model
{
    use HasFactory, Resourcefulness;
    
    protected $table = 'equipment';
    
    protected $casts = [
        'products_range' => 'array',
    ];
    
    protected $guarded = [];
    
    public function path(){
        return '/equipment/'.$this->id;
    }
    
    public function type()
    {
        return $this->hasOne(ResourceType::class, 'id');
    }
    
    public function suppliers()
    {
        return $this->morphToMany(Supplier::class, 'supply', 'supplies','supply_id', 'supplier_id');
    }
    
    public function resourceful()
    {

        return $this->morphMany(Resource::class,'valuable', 'valuable_type', 'valuable_id', 'id');
    }
    
    public function assignTo(Project $project)
    {
        //dd($this->resourceful);
        $this->resourceful()->updateOrCreate(['project_id'=>$project->id]);
    }
}
