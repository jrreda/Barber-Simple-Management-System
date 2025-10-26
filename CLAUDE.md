# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a **Barber Simple Management System** built with Laravel 11.31 and PHP 8.2+. It manages barber services, tracks service records, calculates revenue with bonuses, and maintains activity audit logs. The application supports bilingual operation (English/Arabic) with RTL layout support.

## Development Commands

### Initial Setup
```bash
# Install dependencies
composer install
npm install

# Configure environment
cp .env.example .env
php artisan key:generate

# Setup database and run migrations
php artisan migrate

# (Optional) Seed test data
php artisan db:seed
```

### Development Workflow
```bash
# Start all development services (recommended)
composer dev
# This runs concurrently: server, queue worker, logs (pail), and vite

# Or run individually:
php artisan serve           # Start web server at http://localhost:8000
php artisan queue:listen    # Process queue jobs
npm run dev                 # Start Vite dev server with hot reload
php artisan pail            # View real-time logs
```

### Build and Deploy
```bash
# Build production assets
npm run build

# Code formatting (Laravel Pint)
./vendor/bin/pint

# Run tests (Pest)
./vendor/bin/pest                    # All tests
./vendor/bin/pest --filter=TestName  # Single test
./vendor/bin/pest tests/Feature      # Feature tests only
./vendor/bin/pest tests/Unit         # Unit tests only
```

### Database Operations
```bash
# Create new migration
php artisan make:migration create_table_name

# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Fresh database with seeds
php artisan migrate:fresh --seed
```

## Architecture Overview

### Domain Models and Relationships

**Core Entities:**
- **User**: Authentication + role-based permissions (`owner`/`admin`)
- **Barber**: Barber professionals providing services
- **Service**: Service offerings with type and pricing (recently changed from enum to flexible string type)
- **ServiceRecord**: Transaction log linking barbers, services, dates, and fees
- **ActivityLog**: Audit trail tracking create/update/delete operations with before/after states

**Key Relationships:**
```
User (1) ──── (M) ActivityLog
Barber (1) ──── (M) ServiceRecord ──── (M) Service
```

**Important Note on Service.type**: The `type` field was recently changed from enum to string in [app/Models/Service.php](app/Models/Service.php) to allow flexible service naming without code changes.

### Authorization System

**Two-Tier Role System:**
- `owner`: Full access (typically business owner)
- `admin`: Same access as owner (manager level)
- Non-admin users: Limited to viewing dashboard and service records

**Access Control:**
- Middleware: [app/Http/Middleware/OwnerOnly.php](app/Http/Middleware/OwnerOnly.php)
- Protected routes: Barbers, Services, Revenue, Activity Logs (owner/admin only)
- Public routes: Dashboard, Service Records (all authenticated users)

**Navigation Barriers:**
- Menu items conditionally rendered in [resources/views/layouts/navigation.blade.php](resources/views/layouts/navigation.blade.php) based on `Auth::user()->role`
- Role checks use `isOwner()` and `isAdmin()` helper methods on User model

### Activity Logging Pattern

**Central Service:** [app/Services/ActivityLogger.php](app/Services/ActivityLogger.php)

**Usage Pattern:**
```php
ActivityLogger::log(
    action: 'create|update|delete',
    modelType: 'ServiceRecord',
    modelId: $record->id,
    oldValues: $record->getOriginal(), // null for create/delete
    newValues: $record->fresh()->toArray()
);
```

**Integration Points:**
- Explicitly called in [ServiceRecordController](app/Http/Controllers/ServiceRecordController.php) methods: `store()`, `update()`, `destroy()`
- Captures authenticated user via `auth()->id()`
- Stores complete before/after state as JSON in `activity_logs` table
- Viewable by owner/admin at `/activity-logs` route

**Why Not Observers?** Manual logging in controllers provides transparency and control over what gets logged.

### Revenue Calculation System

**Location:** [app/Http/Controllers/BarberController.php](app/Http/Controllers/BarberController.php) - `revenue()` method (lines 91-121)

**Calculation Logic:**
1. Filter `ServiceRecord` by date range (default: current month)
2. Per barber: Sum `service.price + extra_fees` for all records
3. Calculate bonus: `(totalIncome * proportion) / 100` (default 5%)
4. Aggregate grand totals across all barbers

**Key Features:**
- Date-based filtering via `service_date` field on ServiceRecord
- Configurable bonus percentage at report time (no database storage)
- Supports extra fees for variable pricing adjustments
- Uses eager loading to prevent N+1 queries: `Barber::with(['serviceRecords.service'])`

### Localization Architecture

**Supported Languages:** English (en), Arabic (ar)

**Implementation:**
- Middleware: [app/Http/Middleware/SetLocale.php](app/Http/Middleware/SetLocale.php) - reads locale from session on each request
- Translation files: [lang/en/messages.php](lang/en/messages.php) and [lang/ar/messages.php](lang/ar/messages.php)
- Locale switcher: Public route at `/locale/{locale}` stores selection in session
- RTL support: Layout [resources/views/layouts/app.blade.php](resources/views/layouts/app.blade.php) conditionally applies `dir="rtl"` and swaps margin/text alignment classes for Arabic

**Usage in Views:**
```blade
{{ __('messages.key') }}
```

All user-facing strings should use the `__()` helper with keys defined in `lang/{locale}/messages.php`.

## Frontend Stack

**Technologies:**
- **CSS Framework:** Tailwind CSS 3.1.0 with Forms plugin
- **JavaScript:** Alpine.js 3.4.2 (minimal reactive framework)
- **Build Tool:** Vite 6.0 with Laravel plugin
- **HTTP Client:** Axios 1.7.4 (configured with CSRF in [resources/js/bootstrap.js](resources/js/bootstrap.js))
- **Templating:** Blade components with slots

**Key Patterns:**
- Mobile-first responsive design
- Alpine.js for dropdowns, modals, mobile menu toggle
- Blade components in [resources/views/components/](resources/views/components/) for reusable UI elements
- Flash messages auto-dismiss after 5 seconds via [resources/views/components/flash.blade.php](resources/views/components/flash.blade.php)
- Zero custom JavaScript needed (Alpine handles all interactivity)

## Database Schema Notes

**Primary Tables:**
- `users`: Authentication + `role` enum (owner/admin)
- `barbers`: Name, email (nullable), phone, address (nullable)
- `services`: `type` (string), `price` (decimal 8,2)
- `service_records`: Links barber + service + date + extra_fees + notes
- `activity_logs`: Audit trail with user_id, action, model_type, model_id, old_values (JSON), new_values (JSON)

**Important Foreign Keys:**
- `service_records.barber_id` → `barbers.id` (cascade delete)
- `service_records.service_id` → `services.id` (cascade delete)
- `activity_logs.user_id` → `users.id`

**Cascade Behavior:** Deleting a barber or service removes all associated service records automatically.

## Testing Strategy

**Framework:** Pest PHP (configured in [tests/Pest.php](tests/Pest.php))

**Test Suites:**
- Feature tests: [tests/Feature/](tests/Feature/) - HTTP requests, authentication flows
- Unit tests: [tests/Unit/](tests/Unit/) - Isolated logic testing

**Running Tests:**
```bash
./vendor/bin/pest                          # All tests
./vendor/bin/pest --filter=revenue         # Tests matching "revenue"
./vendor/bin/pest tests/Feature/Auth       # Auth feature tests only
```

**Environment:** Tests use in-memory SQLite (configured in [phpunit.xml](phpunit.xml)) with session/cache set to array driver.

## Important Implementation Details

### Service Type Flexibility
The `Service.type` field is now a string (not enum), allowing arbitrary service names without migrations. See commit: "update service type into string".

### Bonus Calculation Non-Persistence
Bonuses are calculated on-demand in reports, not stored in database. This allows flexible compensation models without schema changes.

### Explicit Activity Logging
Activity logs are manually triggered in controllers rather than using Eloquent observers. This makes it clear which actions are audited and captures user context.

### Queue Configuration
Queue driver is set to `database` in [.env.example](.env.example). Run `php artisan queue:listen` to process jobs, or use `composer dev` which includes queue worker.

### Date-Based Financial Tracking
`ServiceRecord.service_date` is separate from `created_at` timestamp, enabling backdating and accurate period-based reporting regardless of when records are entered.

## Configuration Notes

**Database:** Default is MySQL (`zema` database). Update `DB_*` values in `.env` for your environment. For development, SQLite works: set `DB_CONNECTION=sqlite` and create `database/database.sqlite`.

**Queue:** Uses database driver. Ensure migrations are run and queue worker is started (`php artisan queue:listen`).

**Cache/Session:** Both use database driver. Run migrations to create required tables.

**Mail:** Set to `log` driver for development (emails written to logs). Configure SMTP for production.

## Common Development Patterns

### Creating a New Controller
```bash
php artisan make:controller FooController --resource
```
Follow existing patterns in [app/Http/Controllers/](app/Http/Controllers/) - use validation, eager loading, and activity logging where appropriate.

### Adding a New Model
```bash
php artisan make:model Foo -mfc
# Creates model, migration, factory, controller
```

### Adding Translations
1. Add key to [lang/en/messages.php](lang/en/messages.php)
2. Add corresponding Arabic translation to [lang/ar/messages.php](lang/ar/messages.php)
3. Use in views: `{{ __('messages.your_key') }}`

### Creating Blade Components
```bash
php artisan make:component ComponentName
```
Store in [resources/views/components/](resources/views/components/) and follow Tailwind styling patterns used in existing components.

## File Reference Patterns

**Models:** [app/Models/](app/Models/)
**Controllers:** [app/Http/Controllers/](app/Http/Controllers/)
**Views:** [resources/views/](resources/views/)
**Migrations:** [database/migrations/](database/migrations/)
**Routes:** [routes/web.php](routes/web.php), [routes/auth.php](routes/auth.php)
**Middleware:** [app/Http/Middleware/](app/Http/Middleware/)
**Services:** [app/Services/](app/Services/)

## Key Design Decisions

1. **Role-based access** uses middleware (`OwnerOnly`) rather than model policies
2. **Activity logging** is explicit in controllers, not automatic via observers
3. **Service types** are flexible strings, not enums, for easier customization
4. **Revenue bonuses** calculated on-demand, not stored in database
5. **Localization** uses session storage with RTL CSS injection for Arabic
6. **Frontend interactivity** relies entirely on Alpine.js, no custom JavaScript
7. **Date tracking** uses `service_date` field separate from record creation timestamp
