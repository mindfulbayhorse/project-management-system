<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplyer extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public $timestamps = false;
    
    public function path()
    {
        
        return route('supplyer', ['supplyer' => $this]);

    }
}
