<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }
    
    public function allowTo($permission)
    {
        $this->permissions()->syncWithoutDetaching($permission->id);
    }

    public function disablePermission($permission)
    {
        $this->permissions()->detach($permission);
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
