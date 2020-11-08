<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Resource extends Model
{
    use HasFactory;
    
	protected $table = 'resources';
	protected $guarded = [];
	public $timestamps = false;
	
	public function type(){
		$this->hasOne(ResourceType::class, 'type_id');
	}
}
