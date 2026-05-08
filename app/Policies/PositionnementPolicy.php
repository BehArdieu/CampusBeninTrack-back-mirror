<?php

namespace App\Policies;

use App\Models\Positionnement;
use App\Models\User;

class PositionnementPolicy
{
    public function update(User $user, Positionnement $positionnement): bool
    {
        return $user->id === $positionnement->diaspora_id;
    }

    public function delete(User $user, Positionnement $positionnement): bool
    {
        return $user->id === $positionnement->diaspora_id;
    }
}
