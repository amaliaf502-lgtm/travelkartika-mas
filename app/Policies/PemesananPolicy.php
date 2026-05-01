<?php

namespace App\Policies;

use App\Models\Pemesanan;
use App\Models\User;

class PemesananPolicy
{
    public function view(User $user, Pemesanan $pemesanan): bool
    {
        if (isset($user->is_admin) && $user->is_admin) {
            return true;
        }

        return $user->id === $pemesanan->user_id;
    }
}
