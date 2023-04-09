<?php

namespace App\Features;

use App\Models\User;
class GithubFeed
{
    /**
     * Resolve the feature's initial value.
     */
    public function resolve(User $user): mixed
    {
        return true;
    }
}
