<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectResource extends Pivot
{
    public $timestamps = false;
    
    protected $table = 'project_resource';
}
