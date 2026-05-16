# AGENTS.md

## Cursor Cloud specific instructions

### Prérequis système (installés par le snapshot, pas par l'update script)

- **PHP 8.3** (PPA `ondrej/php`) avec extensions : `cli`, `mbstring`, `xml`, `curl`, `sqlite3`, `zip`, `bcmath`, `dom`, `fileinfo`, `tokenizer`
- **Composer** (installé globalement dans `/usr/local/bin/composer`)
- **Node.js 22.x** + npm (pré-installé dans l'environnement)

### Commandes de référence

Les commandes de développement sont documentées dans `CLAUDE.md` et `README.md`. En résumé :

| Action | Commande |
|--------|----------|
| Setup complet (1ère fois) | `composer setup` |
| Serveur API (port 8000) | `php artisan serve` |
| Dev complet (serveur + queue + logs + vite) | `composer dev` |
| Tests | `composer test` |
| Linting / formatage | `./vendor/bin/pint --test` (vérification) / `./vendor/bin/pint` (correction) |
| Migrations | `php artisan migrate` |
| Seed (villes) | `php artisan db:seed` |

### Notes non évidentes

- La base de données est **SQLite** (`database/database.sqlite`). Pas de service de base de données externe à démarrer.
- L'inscription (`POST /api/auth/register`) nécessite un `ville_id` valide. Exécuter `php artisan db:seed` pour peupler les villes si la base est vide.
- Le linting Pint signale des erreurs de formatage dans le code existant (non bloquant pour les tests ou le serveur).
- Le `composer dev` utilise `npx concurrently` pour lancer 4 processus en parallèle. Il peut être utile de démarrer `php artisan serve` seul si vous n'avez pas besoin du frontend Vite.
- Toutes les routes API nécessitent un Bearer token (`Authorization: Bearer <token>`) sauf `/api/auth/register`, `/api/auth/login`, et `/api/auth/google`.
