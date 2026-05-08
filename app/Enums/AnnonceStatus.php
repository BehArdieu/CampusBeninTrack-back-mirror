<?php

namespace App\Enums;

enum AnnonceStatus: string
{
    /** Ouverte, en attente de candidatures diaspora */
    case EN_ATTENTE = 'en_attente';

    /** Un membre diaspora a été sélectionné */
    case EN_COURS = 'en_cours';

    /** Logement trouvé, processus terminé */
    case RESOLUE = 'resolue';

    /** Annulée par l'étudiant */
    case ANNULEE = 'annulee';
}
