<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //public $timestamps = false;
    protected $fillable =  ['user_id', 'firstname', 'middlename','lastname','email','password','address_id','phone'];
}
