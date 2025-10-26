# Barber Simple Management System

A comprehensive Laravel-based management system designed for barbershops to track services, manage barbers, record transactions, calculate revenue with bonuses, and maintain detailed activity logs.

## Features

### Core Functionality
- **Barber Management**: Add, edit, and manage barber profiles with contact information
- **Service Management**: Define services with flexible pricing and discount options
- **Service Records**: Track daily transactions linking barbers to services performed
- **Revenue Calculation**: Generate revenue reports with configurable bonus calculations
- **Activity Logging**: Complete audit trail of all create/update/delete operations
- **Bilingual Support**: Full English and Arabic localization with RTL layout support

### Service Discounts (New Feature)
- **Fixed Discounts**: Apply flat rate discounts in Egyptian Pounds (LE)
- **Percentage Discounts**: Apply percentage-based discounts (0-100%)
- **Automatic Calculation**: Final prices calculated automatically
- **Revenue Integration**: Discounts properly reflected in revenue reports

### Role-Based Access Control
- **Owner Role**: Full system access
- **Admin Role**: Same permissions as owner


## Technology Stack

- **Backend**: Laravel 11.31, PHP 8.2+
- **Frontend**: Blade Templates, Alpine.js 3.4.2, Tailwind CSS 3.1.0
- **Database**: MySQL (configurable to SQLite)
- **Build Tool**: Vite 6.0
- **Testing**: Pest PHP 3.7
- **Code Quality**: Laravel Pint 1.13

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js & npm
- MySQL or SQLite database

## Installation

### 1. Clone the Repository
```bash
git clone <repository-url>
cd Barber-Simple-Management-System
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 3. Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup
Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Run migrations:
```bash
php artisan migrate
```

(Optional) Seed test data:
```bash
php artisan db:seed
```

### 5. Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

## Development

### Start Development Server
Run all development services concurrently (recommended):
```bash
composer dev
```

This command starts:
- Web server (`php artisan serve`)
- Queue worker (`php artisan queue:listen`)
- Real-time logs (`php artisan pail`)
- Vite dev server with hot reload (`npm run dev`)

Or run services individually:
```bash
# Web server
php artisan serve

# Queue worker
php artisan queue:listen

# Vite dev server
npm run dev

# Real-time logs
php artisan pail
```

### Code Quality
```bash
# Format code with Laravel Pint
./vendor/bin/pint

# Run tests
./vendor/bin/pest
```

## Usage Guide

### Managing Services with Discounts

1. **Create a Service**:
   - Navigate to Services → Add Service
   - Enter service type (e.g., "Haircut")
   - Set base price (e.g., 100 LE)
   - Optionally select discount type:
     - **No Discount**: Use base price
     - **Fixed (LE)**: Subtract fixed amount (e.g., 10 LE = 90 LE final)
     - **Percentage (%)**: Subtract percentage (e.g., 15% = 85 LE final)
   - Enter discount value if applicable
   - Save

2. **View Services**:
   - Services list shows: Type, Base Price, Discount, Final Price
   - Final price is automatically calculated and displayed

3. **Revenue Reports**:
   - Navigate to Revenue
   - Select date range (defaults to current month)
   - Set bonus proportion (default 5%)
   - View per-barber breakdown and totals
   - Revenue calculations use final prices (after discounts)

### Activity Logging

All service record operations are automatically logged:
- **Create**: Captures new record details
- **Update**: Stores before/after states
- **Delete**: Preserves deleted record snapshot

Owners/admins can view complete audit trail at Activity Logs page.

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── BarberController.php         # Barber CRUD + revenue
│   │   ├── ServiceController.php        # Service CRUD with discounts
│   │   ├── ServiceRecordController.php  # Transaction logging
│   │   └── ActivityLogController.php    # Audit trail viewing
│   └── Middleware/
│       ├── OwnerOnly.php               # Role-based access control
│       └── SetLocale.php               # Localization middleware
├── Models/
│   ├── Barber.php                      # Barber entity
│   ├── Service.php                     # Service with discount logic
│   ├── ServiceRecord.php               # Transaction records
│   └── ActivityLog.php                 # Audit log entries
└── Services/
    └── ActivityLogger.php              # Centralized logging service

database/
└── migrations/
    ├── *_create_barbers_table.php
    ├── *_create_services_table.php
    ├── *_create_service_records_table.php
    ├── *_create_activity_logs_table.php
    ├── *_add_role_to_users_table.php
    └── *_add_discount_fields_to_services_table.php

resources/
├── views/
│   ├── barbers/                        # Barber management views
│   ├── services/                       # Service management views
│   ├── service_records/                # Transaction views
│   ├── revenue/                        # Revenue reports
│   ├── logs/                          # Activity logs
│   └── layouts/                       # App layouts with i18n
└── lang/
    ├── en/messages.php                # English translations
    └── ar/messages.php                # Arabic translations
```

## Localization

### Supported Languages
- Arabic (ar) - Default With RTL layout support
- English (en) - With LTR layout support

### Switch Language
Click the language dropdown in the navigation bar to toggle between English and Arabic. Selection is stored in session.

### Add New Translations
1. Add key to `lang/en/messages.php`
2. Add Arabic translation to `lang/ar/messages.php`
3. Use in views: `{{ __('messages.your_key') }}`

## Security

- **Authentication**: Laravel Breeze with email verification
- **Authorization**: Role-based middleware (OwnerOnly)
- **CSRF Protection**: Enabled on all forms
- **Password Hashing**: Bcrypt with configurable rounds
- **Activity Auditing**: Complete audit trail of changes

## Testing

```bash
# Run all tests
./vendor/bin/pest

# Run specific test file
./vendor/bin/pest tests/Feature/Auth/AuthenticationTest.php

# Run tests matching pattern
./vendor/bin/pest --filter=revenue

# Run with coverage
./vendor/bin/pest --coverage
```

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## Code Standards

- Follow PSR-12 coding standards
- Run Laravel Pint before committing: `./vendor/bin/pint`
- Write tests for new features
- Update translations for user-facing changes

## License

This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For issues, questions, or contributions, please open an issue on the project repository.

## Changelog

### Latest Updates
- ✨ Added discount feature (fixed and percentage discounts)
- 🔧 Updated revenue calculation to account for discounts
- 🌐 Added discount-related translations (EN/AR)
- 🐛 Fixed price input validation and formatting
- 📊 Enhanced services table with discount and final price columns

---

Built with ❤️ using Laravel
