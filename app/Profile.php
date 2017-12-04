<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
    'first_name',
    'last_name',
    'phone_no',
    'mobile_no',
    'address',
    'city',
    'state',
    'zip',
    'profile_pic'
    ];
}
