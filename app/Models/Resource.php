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
	
	
	public function resourceful()
	{
	    return $this->morphTo();
	}

}
