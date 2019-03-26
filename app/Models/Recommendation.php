<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recommendation extends Model
{
    use SoftDeletes;
    use UuidOnBoot;

    const UUID = 'uuid';
    const USER_ID = 'user_id';
    const USER_RATING = 'user_rating';
    const REQUEST = 'request';
    const RESPONSE = 'response';
    const TITLE = 'title';
    const LIKE = 'like';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::UUID,
        self::USER_ID,
        self::USER_RATING,
        self::REQUEST,
        self::RESPONSE,
        self::TITLE,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        self::REQUEST => 'array',
        self::RESPONSE => 'array',
        self::LIKE => 'int',
        self::USER_RATING => 'int',
    ];

    /**
     * Get the user that owns the route.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Get the feedback of this route.
     */
//    public function feedback()
//    {
//        return $this->hasMany(\App\Models\Feedback::class);
//    }

}
