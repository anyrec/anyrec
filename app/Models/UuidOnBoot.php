<?php

namespace App\Models;

trait UuidOnBoot
{
    /**
     * This function overwrites the default boot static method of Eloquent models. It will hook
     * the creation event with a simple closure to insert the UUID.
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // Only generate UUID if it wasn't set by already.
            if (! isset($model->attributes[self::UUID])) {
                $model->attributes[self::UUID] = \Ramsey\Uuid\Uuid::uuid4()->toString();
            }
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return self::UUID;
    }
}
