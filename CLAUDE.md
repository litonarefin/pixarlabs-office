# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

**Pixar Labs Office Tracker** - A Laravel-based internal application for team and finance management, built on top of the Wave SaaS framework.

**Tech Stack:**
- Laravel (PHP framework)
- Wave SaaS boilerplate (https://devdojo.com/wave/docs)
- MySQL database
- Laravel Horizon (queue management & cron jobs)
- Filament PHP for admin UI (https://filamentphp.com/docs)
- Livewire for dynamic UI interactions
- Laravel Folio for page routing

**Core Features:**
- Team Management (members, departments, salaries, holidays, attendance)
- Income/Expense Tracking (multi-currency: USD/BDT)
- Weekly/Monthly Reports (per-employee, filtered insights)
- Dashboard Widgets (income, expense, performance, attendance)
- Slack Integration (attendance tracking, daily activity monitoring)
- WhatsApp Integration (expense/income logging)
- Google Drive Integration (receipt storage, automated backups)

## Development Commands

### Initial Setup
```bash
git clone https://github.com/pixarlabs/office-tracker.git
cd office-tracker
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
```

### Running the Application
```bash
composer run dev                     # Start full dev environment (server, queue, logs, Vite)
php artisan serve                    # Start Laravel dev server at http://localhost:8000
php artisan horizon                  # Start queue worker for background jobs
php artisan schedule:work            # Run scheduled tasks (for local dev)
```

### Frontend Development (Wave Theme Assets)
```bash
npm run dev                          # Start Vite development server
npm run build                        # Build assets for production
```

### Database Operations
```bash
php artisan migrate                                  # Run pending migrations
php artisan migrate:rollback                         # Rollback last migration
php artisan migrate:refresh                          # Rollback all & re-run
php artisan migrate:fresh --seed                     # Drop all tables & re-seed
php artisan db:seed                                  # Run database seeders
php artisan make:migration create_table_name_table  # Create new migration
```

### Testing
```bash
php artisan test                     # Run PHPUnit tests
vendor/bin/pest                      # Run Pest tests
```

### Queue Management
```bash
php artisan queue:work               # Process queued jobs
php artisan queue:listen --tries=1   # Listen for jobs with retry limit
```

### Common Laravel Commands
```bash
php artisan make:model ModelName -m         # Create model with migration
php artisan make:controller ControllerName  # Create controller
php artisan make:request RequestName        # Create form request
php artisan tinker                          # Interactive console
php artisan route:list                      # List all routes
php artisan config:clear                    # Clear config cache
php artisan cache:clear                     # Clear application cache
```

### Wave-Specific Commands
```bash
php artisan wave:cancel-expired-subscriptions  # Cancel expired subscriptions
php artisan wave:create-plugin                 # Create a new plugin
```

## Architecture Overview

### Core Structure
- `app/` - Standard Laravel application files
- `wave/` - Wave framework core files and components
- `resources/themes/` - Theme files (Blade templates, assets)
- `resources/plugins/` - Plugin system files
- `config/wave.php` - Main Wave configuration
- `app/Filament/` - Filament admin panel resources

### Wave Components

#### Wave Service Provider (`wave/src/WaveServiceProvider.php`)
- Registers middleware, Livewire components, and Blade directives
- Handles plugin registration and theme management
- Configures Filament colors and authentication

#### Models & Database
- User model extends Wave User with subscription capabilities
- Role-based permissions using Spatie Laravel Permission
- Subscription management capabilities (though not primary use for this project)

#### Theme System
- Multiple themes available in `resources/themes/`
- Folio integration for page routing
- Theme development follows Blade templating conventions

#### Admin Panel
- Filament-based admin interface
- Resource management for users, posts, plans, etc.

#### Plugin System
- Plugins located in `resources/plugins/`
- Auto-loading via `PluginServiceProvider`
- Plugin creation command available

### Custom Entities for Office Tracker

**Database Entities:**
- Employees (members, departments, salaries)
- Attendance (daily check-in/out, tracked via Slack #signin-out)
- Leaves (holidays, leave requests)
- Income (multi-currency, categorized, tracked via Slack/WhatsApp)
- Expenses (multi-currency, categorized, tracked via Slack/WhatsApp)
- Activities (daily updates from Slack #daily-updates)

**Payment Methods:** City Bank, IBBL, Southeast Bank, BKash, SCB, EBL, Cash

**Expense Categories:**
- Personal: Family, Home Rent, School, Bua
- Office: Salary, Furniture, Internet, Coffee Beans, Server Bills
- Shared: Product Share

## Integrations

### Slack
- **#signin-out channel:** Track employee attendance (entry/exit times)
- **#daily-updates channel:** Monitor daily tasks and productivity
- **Monthly reminders:** Send feedback prompts to admin via DM

### WhatsApp
- Receive messages for Income/Expense entries
- Parse text and optional images
- Store receipts to Google Drive

### Google Drive
- Store receipt/reference images in `/Year/Month/Type/` folder structure
- Automated daily backups (database + uploads)
- Retain last 7 days of backups

**Backup Commands:**
```bash
composer require spatie/laravel-backup
php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"
php artisan backup:run              # Run manual backup
```

**.env Configuration:**
```
GOOGLE_DRIVE_FOLDER_PATH=/PixarLabs/Backups
```

### Freemius API
- Integration for product income tracking
- Documentation: https://docs.freemius.com/api
- Also track internal income from bo.jeweltheme.com

## Horizon Setup

Laravel Horizon manages queue jobs and scheduled tasks.

```bash
composer require laravel/horizon
php artisan horizon:install
php artisan migrate
php artisan horizon
```

**.env Configuration:**
```
HORIZON_PREFIX=pixarlabs
```

## Wave Configuration

### Environment Variables
- `WAVE_DOCS` - Show/hide documentation
- `WAVE_DEMO` - Enable demo mode
- `WAVE_BAR` - Show development bar
- `BILLING_PROVIDER` - Set to 'stripe' or 'paddle' (if needed)

### Important Config Files
- `config/wave.php` - Main Wave configuration
- `config/themes.php` - Theme configuration
- `config/settings.php` - Application settings

## Performance Optimizations

### Caching Strategy
- User subscription/admin status cached for 5-10 minutes
- Active plans cached for 30 minutes
- Categories cached for 1 hour
- Helper files cached permanently until cleared
- Theme colors cached for 1 hour
- Plugin lists cached for 1 hour

### Cache Clearing
- User caches: `$user->clearUserCache()`
- Plan caches: `Plan::clearCache()`
- Category caches: `Category::clearCache()`

### Best Practices
- Use `Plan::getActivePlans()` instead of `Plan::where('active', 1)->get()`
- Use `Plan::getByName($name)` instead of `Plan::where('name', $name)->first()`
- Use `Category::getAllCached()` instead of `Category::all()`
- Always clear relevant caches when updating user roles, plans, or categories
- Eager load relationships to prevent N+1 queries

## UI/UX References

- Dashboard UI: https://cln.sh/0ZBr1D9d
- Employee Screens: https://cln.sh/CNbjfTz9
- Attendance Screens: https://cln.sh/12WyHf5G
- Leave Management: https://cln.sh/srRF2ywv
- Add Leave: https://cln.sh/G5QrpXcH
- Income: https://cln.sh/gC8zZSYF
- Add Income: https://cln.sh/X1KwBhj7
- Expense Overview: https://cln.sh/Jg0yNzmT
- Add Expense: https://cln.sh/fM17ylPS

## Development Guidelines

**Critical Rules:**
1. **Never run npm commands** - Focus on Laravel backend (use npm only for Wave theme assets if needed)
2. Use MySQL for all database operations
3. Update Guidelines.md documentation with every feature addition
4. Maintain 7-day rolling backups to Google Drive
5. Use Laravel Horizon for all cron jobs and scheduled tasks
6. Generate daily Slack summary reports for activities & attendance
7. Design database schema for extensibility and future scaling
8. Follow Wave's plugin system for modular features
9. All caching methods include fallbacks for when cache service is unavailable

**Reporting:**
- Weekly, Monthly, and Yearly reports per employee
- Income vs Expense graphs and visual summaries
- Automated monthly employee summaries

## Additional Resources

- Wave Documentation: https://devdojo.com/wave/docs/getting-started
- Filament PHP Documentation: https://filamentphp.com/docs
- ERPNext Reference (for inspiration): https://frappe.io/erpnext
- Laravel Documentation: https://laravel.com/docs
- Livewire Documentation: https://livewire.laravel.com
- Laravel Folio: https://laravel.com/docs/folio
