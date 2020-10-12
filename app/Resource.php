<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\ResourceType;


class Resource extends Model
{
	protected $table = 'resources';
	protected $guarded = [];
	public $timestamps = false;
	
	public function type(){
		$this->hasOne(ResourceType::class, 'type_id');
	}
}
