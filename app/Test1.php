<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test1 extends Model
{
    use SoftDeletes;
    protected $fillable =[
        'name','name_bangla','description','image','deleted_at',
    ];
}
