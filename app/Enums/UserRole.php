<?php

namespace App\Enums;

enum UserRole: string
{
    /** Étudiant cherchant un logement */
    case USER = 'user';

    /** Membre de la diaspora aidant à trouver un logement */
    case DIASPORA = 'diaspora';

    /** Administrateur de la plateforme */
    case ADMIN = 'admin';
}
