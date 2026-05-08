# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

**CampusBeninTrack** is a Laravel 12 API backend for a housing assistance platform targeting African students seeking accommodation in France. The platform facilitates connections between students (seeking housing) and diaspora members (residents in France offering to help find housing).

### Core Concept

1. Students create housing requests (annonces) with their criteria
2. Diaspora members express interest via positionnements (candidatures)
3. Students select one diaspora member to assist them
4. The selected diaspora member proposes housing options (reponses) with full lifecycle tracking
5. The process progresses through states: pending → visited → payment → contract signed

## Architecture

### Database Schema

- **users** → All platform users (students + diaspora members, differentiated by `role`)
- **villes** → Cities/locations with geolocation data
- **annonces** → Housing requests from students
  - Links: `user_id` (requesting student), `diaspora_id` (assigned diaspora), `ville_id`
- **positionnements** → Diaspora members expressing interest in assisting
  - Status enum: EN_ATTENTE | ACCEPTE | REFUSE
- **reponses** → Housing proposals from diaspora members
  - Full lifecycle status enum: EN_ATTENTE → VISITE_PLANIFIEE → VISITE_EFFECTUEE → OFFRE_ACCEPTEE → EN_COURS_PAIEMENT → PAIEMENT_EFFECTUE → CONTRAT_SIGNE | REFUSEE

### Enum System

- `App\Enums\PositionnementStatus` → 3 states (pending/accepted/refused)
- `App\Enums\ReponseStatus` → 9 states covering the full housing lifecycle

## Development Commands

### Setup

```bash
composer setup        # One-time setup: install dependencies, generate keys, run migrations
```

### Running the Application

```bash
composer dev          # Run all services concurrently: Laravel server, queue listener, logs, Vite dev server
php artisan serve    # Just the API server (http://localhost:8000)
npm run dev          # Just the frontend build watcher
```

### Testing

```bash
composer test         # Run all tests with a clean config
php artisan test --filter=TestName  # Run a specific test class
php artisan test tests/Unit/SomeTest.php  # Run a specific test file
```

### Database

```bash
php artisan migrate           # Run pending migrations
php artisan migrate:fresh    # Reset database and re-run all migrations
php artisan tinker           # Interactive shell for testing code
```

### Code Quality

```bash
./vendor/bin/pint            # Format code (Laravel Pint)
./vendor/bin/pint --test    # Check formatting without changes
```

### Logging & Debugging

```bash
php artisan pail             # Stream application logs in real-time
php artisan config:clear    # Clear cached config
```

## Key Technologies

- **Framework**: Laravel 12
- **Database**: SQLite (default) - can switch via .env
- **Frontend Build**: Vite + Tailwind CSS v4
- **Testing**: PHPUnit 11
- **Code Quality**: Laravel Pint
- **Queue Processing**: Database queue driver (can switch via .env)

## Important Patterns

1. **Status Management**: Use the enum values directly. Avoid storing plain strings.
2. **Role Differentiation**: The `role` field on users distinguishes between 'user' (student) and 'diaspora' (established resident)
3. **Geolocation**: Villes store longitude/latitude for location-based queries
4. **Workflow States**: Reponses have 9 distinct states; Positionnements have 3. These are enforced at the enum level.

## Common Workflows

- Creating a housing request: POST to annonces endpoint with student user + ville
- Expressing interest: Create positionnement linking diaspora to annonce
- Selecting diaspora: Update annonce to set diaspora_id (single selection)
- Proposing housing: Create reponse with full details (address, price, images)
- Tracking progress: Update reponse status through the lifecycle states

## Documentation

**API Documentation** is auto-generated using [Scramble](https://scramble.dedoc.co/):
```bash
php artisan scramble:export  # Regenerate OpenAPI spec
curl http://localhost:8000/api/docs  # Get the spec as JSON
```

For comprehensive API docs, see [API_DOCUMENTATION.md](API_DOCUMENTATION.md)

## Notes

- The project uses concurrent development mode (`composer dev`) which runs the Laravel server, queue listener, logs, and Vite in parallel
- Migrations should always be reversible (include a down() method)
- New tables should be added to the appropriate database/migrations/ folder with timestamped filenames
- Controllers use PHPDoc comments for Scramble to generate endpoint documentation
- All API endpoints require Bearer token authentication except auth endpoints
- Images are stored polymorphically; use `->images()` relation on Reponse model
