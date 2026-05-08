# API Documentation — CampusBeninTrack

Plateforme de mise en relation entre étudiants africains cherchant un logement en France et membres de la diaspora.

## Base URL

```
http://localhost:8000/api
```

## Authentification

Tous les endpoints protégés (`🔒`) requièrent un Bearer token :

```
Authorization: Bearer <token>
```

---

## Auth

### POST /auth/register

Créer un compte utilisateur.

**Body**
| Champ | Type | Requis | Description |
|---|---|---|---|
| nom | string | ✓ | Nom de famille |
| prenom | string | ✓ | Prénom |
| email | string | ✓ | Email unique |
| telephone | string | ✓ | Téléphone unique |
| password | string | ✓ | Min. 8 caractères |
| ville_id | integer | ✓ | ID de ville |
| role | string | ✓ | `user` ou `diaspora` |

**Réponse 201**
```json
{
  "user": {
    "id": 1,
    "nom": "Traore",
    "prenom": "Moussa",
    "email": "student@gmail.com",
    "telephone": "+22901234567",
    "role": "user",
    "status": "active",
    "ville_id": 1,
    "created_at": "2026-05-07T10:00:00Z"
  },
  "token": "1|abc123..."
}
```

---

### POST /auth/login

Connexion email + mot de passe.

**Body**
| Champ | Type | Requis |
|---|---|---|
| email | string | ✓ |
| password | string | ✓ |

**Réponse 200** → même structure que `/register`

**Réponse 401**
```json
{ "message": "Invalid credentials" }
```

---

### POST /auth/google

Connexion / inscription via Google OAuth.

**Body**
| Champ | Type | Requis |
|---|---|---|
| google_id | string | ✓ |
| email | string | ✓ |
| nom | string | ✓ |
| prenom | string | ✓ |
| photo | string | |

**Réponse 200** → même structure que `/register`

> Crée le compte si l'email n'existe pas encore, sinon retourne l'utilisateur existant.

---

### POST /auth/logout `🔒`

Révoque le token courant.

**Réponse 200**
```json
{ "message": "Logout successful" }
```

---

### GET /auth/user `🔒`

Retourne l'utilisateur authentifié.

**Réponse 200**
```json
{
  "id": 1,
  "nom": "Traore",
  "prenom": "Moussa",
  "email": "student@gmail.com",
  "role": "user",
  "status": "active",
  "ville_id": 1
}
```

---

## Annonces (demandes de logement)

### GET /annonces `🔒`

Liste les annonces.

- **Étudiant (`user`)** : voit uniquement ses propres annonces
- **Diaspora** : voit uniquement les annonces qui lui sont assignées

**Réponse 200** (paginée)
```json
{
  "data": [
    {
      "id": 1,
      "user_id": 1,
      "diaspora_id": null,
      "ville_id": 2,
      "titre": "Besoin d'un logement à Lyon",
      "description": "Étudiant en master...",
      "photo": null,
      "universite": "Université Claude Bernard",
      "status": "en_attente",
      "user": { "id": 1, "nom": "Traore", "prenom": "Moussa" },
      "ville": { "id": 2, "ville": "Lyon" }
    }
  ],
  "meta": { "current_page": 1, "per_page": 15, "total": 5 }
}
```

---

### POST /annonces `🔒`

Créer une demande de logement (étudiant).

**Body**
| Champ | Type | Requis |
|---|---|---|
| titre | string | ✓ |
| description | string | ✓ |
| ville_id | integer | ✓ |
| universite | string | |
| photo | string | |

**Réponse 201** → l'annonce créée avec `user` et `ville`

---

### GET /annonces/{id} `🔒`

Détail d'une annonce avec toutes ses relations.

**Réponse 200**
```json
{
  "id": 1,
  "titre": "...",
  "positionnements": [...],
  "reponses": [...],
  "user": {...},
  "diaspora": null,
  "ville": {...}
}
```

---

### PUT /annonces/{id} `🔒`

Modifier une annonce. Réservé au propriétaire.

**Body** (tous optionnels)
| Champ | Type | Description |
|---|---|---|
| titre | string | |
| description | string | |
| universite | string | |
| photo | string | |
| diaspora_id | integer | Assigner un membre diaspora |
| status | string | Nouveau statut |

**Réponse 200** → l'annonce mise à jour

---

### DELETE /annonces/{id} `🔒`

Supprimer une annonce. Réservé au propriétaire.

**Réponse 200**
```json
{ "message": "Annonce deleted" }
```

---

## Positionnements (candidatures diaspora)

Un positionnement représente l'intérêt d'un membre diaspora pour aider sur une annonce.

**Statuts possibles** : `en_attente` → `accepte` | `refuse`

### GET /positionnements `🔒`

- **Diaspora** : voit uniquement ses propres positionnements
- **Étudiant** : voit tous les positionnements sur ses annonces

**Réponse 200** (paginée)
```json
{
  "data": [
    {
      "id": 1,
      "annonce_id": 1,
      "diaspora_id": 2,
      "message": "Je vis à Lyon depuis 5 ans...",
      "status": "en_attente",
      "read_at": null,
      "annonce": {...},
      "diaspora": {...}
    }
  ]
}
```

---

### POST /positionnements `🔒`

Exprimer son intérêt pour une annonce (diaspora uniquement).

**Body**
| Champ | Type | Requis |
|---|---|---|
| annonce_id | integer | ✓ |
| message | string | |

> Un diaspora ne peut se positionner qu'une seule fois par annonce (contrainte unique).

**Réponse 201** → le positionnement créé

---

### GET /positionnements/{id} `🔒`

Détail d'un positionnement.

---

### PUT /positionnements/{id} `🔒`

Mettre à jour le statut (l'étudiant accepte ou refuse).

**Body**
| Champ | Type | Valeurs |
|---|---|---|
| status | string | `en_attente`, `accepte`, `refuse` |
| message | string | |

**Réponse 200** → le positionnement mis à jour

---

### DELETE /positionnements/{id} `🔒`

Supprimer un positionnement. Réservé au propriétaire.

**Réponse 200**
```json
{ "message": "Positionnement deleted" }
```

---

## Réponses (propositions de logement)

Un membre diaspora propose un logement concret en réponse à une annonce.

**Cycle de vie des statuts :**
```
en_attente
  → visite_planifiee
  → visite_effectuee
  → offre_acceptee
  → en_cours_paiement
  → paiement_effectue
  → contrat_signe
  | refusee
```

### GET /reponses `🔒`

- **Diaspora** : ses propres propositions
- **Étudiant** : propositions liées à ses annonces

**Réponse 200** (paginée)
```json
{
  "data": [
    {
      "id": 1,
      "annonce_id": 1,
      "diaspora_id": 2,
      "address": "12 Rue de la Paix, 69001 Lyon",
      "prix": 650.00,
      "status": "en_attente",
      "read_at": null,
      "images": [
        {
          "id": 1,
          "path": "reponses/abc123.jpg",
          "filename": "chambre.jpg",
          "mime_type": "image/jpeg",
          "size": 204800
        }
      ]
    }
  ]
}
```

---

### POST /reponses `🔒`

Proposer un logement (diaspora uniquement). Envoi en `multipart/form-data` pour les images.

**Body**
| Champ | Type | Requis | Description |
|---|---|---|---|
| annonce_id | integer | ✓ | |
| address | string | ✓ | Adresse complète |
| prix | number | ✓ | Loyer mensuel en € |
| images[] | file | | Photos du logement (max 5 MB chacune) |

**Réponse 201** → la réponse créée avec ses images

---

### GET /reponses/{id} `🔒`

Détail d'une proposition.

---

### PUT /reponses/{id} `🔒`

Mettre à jour une proposition. Réservé au propriétaire.

**Body** (tous optionnels)
| Champ | Type | Description |
|---|---|---|
| address | string | |
| prix | number | |
| status | string | Voir cycle de vie ci-dessus |

**Réponse 200** → la réponse mise à jour

---

### DELETE /reponses/{id} `🔒`

Supprimer une proposition. Réservé au propriétaire.

**Réponse 200**
```json
{ "message": "Reponse deleted" }
```

---

## Codes d'erreur communs

| Code | Signification |
|---|---|
| 401 | Non authentifié ou token invalide |
| 403 | Action non autorisée (politique d'accès) |
| 404 | Ressource introuvable |
| 422 | Erreur de validation |

**Exemple 422**
```json
{
  "message": "The email field is required.",
  "errors": {
    "email": ["The email field is required."]
  }
}
```

---

## OpenAPI / Scramble

```bash
php artisan scramble:export        # Génère api.json
curl http://localhost:8000/api/docs # Spec JSON en live
```
