<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Suites\Resourcefulness;

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

    public function suppliers()
    {
        return $this->morphToMany(Supplier::class, 'supplied','supplies');
    }
    
    public function scopeFilter($query, array $filter)
    {
       
        $query->when($filter['search'] ?? false, fn($query, $search)=>
           $query->where(fn($query) =>
               $query->where('model','like', '%'.$search.'%')
                   ->orWhere('manufacturer','like', '%'.$search.'%')
            )
        );
    }
   
   
}
