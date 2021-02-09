<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipment;

class Supplier extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public $timestamps = false;
    
    protected $casts = [
        'products_range' => 'array',
    ];
    
    public function path()
    {
        
        return route('supplier', ['supplyer' => $this]);

    }
    
    public function equipment()
    {
        return $this->morphedByMany(Equipment::class, 'supplier_resource', 'supplier_resource', 'resource_id');
    }
}
