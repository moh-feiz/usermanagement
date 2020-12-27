<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class BlockList extends Model
{
    protected $table = "block_list";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip' , 'mobile' ,

    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}

