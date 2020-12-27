<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SmsTry extends Model
{
    protected $table = "sms_try";
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

