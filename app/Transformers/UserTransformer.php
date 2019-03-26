<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A User transformer.
     *
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->getRouteKey(),
            User::CREATED_AT => $user->{User::CREATED_AT}->toIso8601String(),
        ];
    }
}
