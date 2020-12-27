<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class LoginTry extends Model
{
    protected $table = "login_try";
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

