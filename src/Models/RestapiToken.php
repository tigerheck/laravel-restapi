<?php

namespace TigerHeck\RestApi\Models;

use Illuminate\Database\Eloquent\Model;

class RestapiToken extends Model
{

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'access_token',
        'token_type',
        'scope',
        'expires_in',
    ];
    
}