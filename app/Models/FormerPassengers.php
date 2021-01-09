<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class FormerPassengers extends Model
{
    protected $table = "former_passengers";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'first_name_fa',
        'Last_name_fa',
        'first_name_en',
        'last_name_en',
        'social_code',
        'mobile',
        'passport_number',
        'country_passport',
        'expire_date_passport',
        'gender',
        'birthday'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}
