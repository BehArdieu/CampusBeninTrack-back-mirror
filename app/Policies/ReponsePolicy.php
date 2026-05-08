<?php

namespace App\Policies;

use App\Models\Reponse;
use App\Models\User;

class ReponsePolicy
{
    public function update(User $user, Reponse $reponse): bool
    {
        return $user->id === $reponse->diaspora_id;
    }

    public function delete(User $user, Reponse $reponse): bool
    {
        return $user->id === $reponse->diaspora_id;
    }
}
