<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\SupplyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supply extends Pivot
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $guarded = [];
    
    protected $table = 'supplies';
    
    
    
}
