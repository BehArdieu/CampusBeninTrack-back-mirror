# Campus Benin Track — Backend

API REST Laravel pour **Campus Benin Track** : mise en relation entre étudiants africains cherchant un logement en France et membres de la diaspora susceptibles de les accompagner (informations, visites, propositions).

**Contributeur :** BehArdieu

---

## Stack technique

| Composant | Détail |
|-----------|--------|
| Framework | [Laravel](https://laravel.com) 12 |
| Langage | PHP **^8.2** |
| Authentification | [Laravel Sanctum](https://laravel.com/docs/sanctum) (tokens Bearer) |
| Documentation OpenAPI | [Scramble](https://github.com/dedoc/scramble) (`dedoc/scramble`) |
| Front build (minimal) | Vite + Tailwind 4 |

---

## Prérequis

- PHP **8.2+** avec les extensions habituelles Laravel (`pdo`, `mbstring`, `openssl`, etc.)
- [Composer](https://getcomposer.org/)
- Pour les assets : Node.js **18+** et npm (facultatif si vous ne touchez qu’à l’API)

Par défaut, `.env.example` cible **SQLite** (`database/database.sqlite`). Adaptez `DB_*` pour MySQL/PostgreSQL si besoin.

---

## Installation rapide

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite   # si vous restez sur SQLite sans fichier existant
php artisan migrate --seed      # Villes + compte démo admin (voir DatabaseSeeder)
```

Pour appliquer uniquement le schéma :

```bash
php artisan migrate
```

(Optionnel frontend / Vite :)

```bash
npm install && npm run build
```

Ou un setup guidé :

```bash
composer run setup    # install + .env + key + migrate + npm (voir composer.json)
```

---

## Configuration

Fichiers et variables à connaître :

- **`.env`** — `APP_URL`, base de données, files, queues, mail, etc.
- **Sessions / cache / files** peuvent être en `database` par défaut (vérifiez que les migrations `cache`, `sessions`, `jobs` sont appliquées si vous utilisez ces drivers).

---

## Lancer l’application

```bash
php artisan serve
```

L’API est exposée sous le préfixe **`/api`** (voir `routes/api.php`).

Pour un environnement de dev complet (serveur, file d’attente, logs Vite…) :

```bash
composer run dev
```

Santé de l’application : `GET /up`.

---

## Modèle fonctionnel (aperçu)

- **Utilisateurs** — rôles `user` (étudiant) et `diaspora`, avec ville d’attache.
- **Annonces** — demandes de logement créées par les étudiants ; visibilité filtrée par rôle.
- **Positionnements** — intérêt d’un membre diaspora pour une annonce (candidatures, acceptation / refus).
- **Réponses** — proposition concrète de logement (adresse, prix, images, workflow de statuts).

Authentification classique : inscription / connexion, option **Google OAuth** côté client avec échange serveur (`POST /api/auth/google`).

---

## Documentation API

| Ressource | Description |
|-----------|-------------|
| **[API_DOCUMENTATION.md](./API_DOCUMENTATION.md)** | Description détaillée des endpoints, corps de requêtes et réponses. |
| **Scramble / OpenAPI** | Spéc JSON en ligne et export. |

Commandes utiles :

```bash
php artisan scramble:export   # produit entre autres api.json
```

En local (après `php artisan serve`) :

```bash
curl http://localhost:8000/api/docs
```

**Base URL typique :** `http://localhost:8000/api`

Endpoints principaux : `/auth/register`, `/auth/login`, `/auth/google`, `/auth/logout`, `/user`, ressources `annonces`, `positionnements`, `reponses`, `villes` — tous détaillés dans `API_DOCUMENTATION.md`.

> **Note :** la documentation mentionne parfois `GET /auth/user` alors que la route Laravel est **`GET /api/user`** (`routes/api.php`). Utilisez `/api/user` pour l’utilisateur connecté.

---

## Tests

```bash
composer test
```

ou :

```bash
php artisan test
```

---

## Licence

Ce projet inclut Laravel, publié sous [licence MIT](https://opensource.org/licenses/MIT). La licence du dépôt reste compatible avec vos choix de distribution pour Campus Benin Track.

---

### Partenaires & écosystème Laravel

Pour la présentation du framework Laravel, les sponsors officiels et le guide de contribution au *framework* lui-même :  
[Documentation Laravel](https://laravel.com/docs) · [Laravel Partners](https://partners.laravel.com)
