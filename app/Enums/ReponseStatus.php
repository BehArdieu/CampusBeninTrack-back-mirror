<?php

namespace App\Enums;

enum ReponseStatus: string
{
    /** Proposition en attente de réaction de l'étudiant */
    case EN_ATTENTE = 'en_attente';

    /** Proposition acceptée par l'étudiant */
    case ACCEPTE = 'accepte';

    /** Visite du logement planifiée */
    case VISITE_PLANIFIEE = 'visite_planifiee';

    /** Visite du logement effectuée */
    case VISITE_EFFECTUEE = 'visite_effectuee';

    /** Offre acceptée après visite */
    case OFFRE_ACCEPTEE = 'offre_acceptee';

    /** Paiement en cours */
    case EN_COURS_PAIEMENT = 'en_cours_paiement';

    /** Paiement effectué */
    case PAIEMENT_EFFECTUE = 'paiement_effectue';

    /** Contrat signé, logement confirmé */
    case CONTRAT_SIGNE = 'contrat_signe';

    /** Proposition refusée */
    case REFUSEE = 'refusee';
}
