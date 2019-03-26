<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use UuidOnBoot;

    const UUID = 'uuid';
    const API_TOKEN = 'api_token';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::UUID,
        self::API_TOKEN,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        self::API_TOKEN,
    ];

    /**
     * Get the generated recommendations of this user.
     */
    public function recommendations()
    {
        return $this->hasMany(\App\Models\Recommendation::class);
    }
}
