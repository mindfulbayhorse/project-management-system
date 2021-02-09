<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Supplies extends Pivot
{
    public $timestamps = false;
    
    protected $guarded = [];
    
    protected $table = 'supplies';
}
