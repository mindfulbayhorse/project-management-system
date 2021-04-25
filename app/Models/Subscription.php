<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Suites\Resourcefulness;

class Subscription extends Model
{
    use HasFactory, Resourcefulness;
    
    public $timestamps = false;
}
