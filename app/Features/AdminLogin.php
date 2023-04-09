<?php

namespace App\Features;

use App\Models\User;

class AdminLogin
{
    /**
     * Resolve the feature's initial value.
     */
    public function resolve(User $user): bool
    {
        return true;
    }
}
