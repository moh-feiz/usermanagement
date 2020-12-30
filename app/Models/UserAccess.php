<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserAccess extends Model
{
    use SoftDeletes;
    protected $table = "user_access";

    protected $fillable = [
        'name', 'parent_id'
    ];

}

