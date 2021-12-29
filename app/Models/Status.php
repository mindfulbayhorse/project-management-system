<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $table = 'statuses';
    
    public function path(){
        
        return '/'.$this->table.'/'.$this->id;
    }
    
    public function projects(){
        return $this->hasMany(Project::class);
    }
    
}
