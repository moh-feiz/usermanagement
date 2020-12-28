<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class RegisterTry extends Model
{
    protected $table = "signup_try";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip', 'mobile', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}

