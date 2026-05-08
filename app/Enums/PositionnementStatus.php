<?php

namespace App\Enums;

enum PositionnementStatus: string
{
    /** En attente de réponse de l'étudiant */
    case EN_ATTENTE = 'en_attente';

    /** Visualisée par l'étudiant */
    case LU = 'lu';

    /** Acceptée, la diaspora aidera l'étudiant */
    case ACCEPTE = 'accepte';

    /** Refusée par l'étudiant */
    case REFUSE = 'refuse';
}
