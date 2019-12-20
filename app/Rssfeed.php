<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rssfeed extends Model
{
      //table name
    protected $table = 'rss_feeds';
    
    //primary key field
    protected $primaryKey = 'id';
    
    protected $guarded = [];
}
