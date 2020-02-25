<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    //
    protected $table = 'resource';
    protected $fillable = ['group_id', 'name', 'description'];
}
