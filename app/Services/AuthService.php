<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
    /**
     * Get the redirect path based on user role after login.
     *
     * @param User $user
     * @return string
     */
    public function getRedirectPath(User $user): string
    {
        // Currently all roles redirect to the unified /dashboard route.
        // This service layer makes it easy to split them in the future if needed,
        // as hinted in the sequence diagram.
        return match ($user->role) {
            'Admin' => route('dashboard', [], false),
            'Penjual' => route('dashboard', [], false),
            default => route('dashboard', [], false),
        };
    }
}
