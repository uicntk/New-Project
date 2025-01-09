<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    /**
     * Create a new policy instance.
     */
    public function authen(User $user)
    {
        return $user->email === 'liztblood20@gmail.com';
    }
}