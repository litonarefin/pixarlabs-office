# Pixar Labs Office Tracker - Instructions Guide

## Table of Contents
1. [Prerequisites](#prerequisites)
2. [Initial Setup](#initial-setup)
3. [Running the Application](#running-the-application)
4. [Database Management](#database-management)
5. [Common Daily Commands](#common-daily-commands)
6. [Development Workflow](#development-workflow)
7. [Troubleshooting](#troubleshooting)
8. [Deployment](#deployment)

---

## Prerequisites

Before working with this application, ensure you have:

- **PHP 8.2 or higher** - Check version: `php -v`
- **Composer** - PHP dependency manager: `composer --version`
- **MySQL/SQLite** - Database (currently using SQLite)
- **Git** - Version control: `git --version`

---

## Initial Setup

### 1. Clone the Repository (if not already done)
```bash
git clone https://github.com/pixarlabs/office-tracker.git
cd office-tracker
```

### 2. Install Dependencies
```bash
composer install
```

This will download all PHP packages needed for the application (~5-10 minutes).

### 3. Environment Configuration

Copy the example environment file:
```bash
cp .env.example .env
```

Or create `.env` file manually with these settings:
```env
APP_NAME="Pixar Labs Office"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# For MySQL, uncomment and configure:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=pixarlabs_office
# DB_USERNAME=root
# DB_PASSWORD=your_password
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

This creates a unique encryption key for your application.

### 5. Create Database

**For SQLite (default):**
```bash
touch database/database.sqlite
```

**For MySQL:**
```bash
mysql -u root -p
CREATE DATABASE pixarlabs_office;
EXIT;
```

### 6. Run Database Migrations
```bash
php artisan migrate
```

This creates all necessary tables in your database.

### 7. Seed Initial Data
```bash
php artisan db:seed
```

This populates the database with default roles, users, and sample data.

---

## Running the Application

### Start Development Server

**Option 1: Simple Server**
```bash
php artisan serve
```
Access at: http://localhost:8000

**Option 2: Full Development Environment (Recommended)**
```bash
composer run dev
```
This starts:
- Laravel server (http://localhost:8000)
- Queue worker (for background jobs)
- Log viewer
- Vite asset compiler (if using npm)

**Stop the Server:**
Press `Ctrl + C` in the terminal

### Access Admin Panel

Default credentials (after seeding):
- URL: http://localhost:8000/admin
- Email: admin@admin.com
- Password: password

---

## Database Management

### Creating New Tables

**Step 1: Create Migration**
```bash
php artisan make:migration create_employees_table
```

This creates a file in `database/migrations/`.

**Step 2: Edit the Migration**
Open the created file and define your table structure:
```php
Schema::create('employees', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('department');
    $table->decimal('salary', 10, 2);
    $table->timestamps();
});
```

**Step 3: Run the Migration**
```bash
php artisan migrate
```

### Creating Models

```bash
php artisan make:model Employee
```

To create a model with migration in one command:
```bash
php artisan make:model Employee -m
```

Additional options:
- `-c` - Create controller
- `-f` - Create factory
- `-s` - Create seeder
- `-a` - Create all (model, migration, controller, factory, seeder)

Example:
```bash
php artisan make:model Employee -a
```

### Migration Commands Reference

| Command | Description |
|---------|-------------|
| `php artisan migrate` | Run pending migrations |
| `php artisan migrate:fresh` | Drop all tables and re-run migrations |
| `php artisan migrate:fresh --seed` | Fresh migration + seed data |
| `php artisan migrate:rollback` | Rollback last migration batch |
| `php artisan migrate:rollback --step=1` | Rollback last 1 migration |
| `php artisan migrate:reset` | Rollback all migrations |
| `php artisan migrate:refresh` | Rollback all and re-run migrations |
| `php artisan migrate:status` | Show migration status |

### Database Seeding

**Create a Seeder:**
```bash
php artisan make:seeder EmployeesTableSeeder
```

**Run Specific Seeder:**
```bash
php artisan db:seed --class=EmployeesTableSeeder
```

**Run All Seeders:**
```bash
php artisan db:seed
```

### Working with Database

**Access Database Console:**
```bash
php artisan tinker
```

Example queries in Tinker:
```php
// Get all users
User::all();

// Create new user
User::create(['name' => 'John', 'email' => 'john@example.com']);

// Find user by ID
User::find(1);

// Delete user
User::find(1)->delete();

// Exit tinker
exit
```

---

## Common Daily Commands

### Application Management

```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize application (for production)
php artisan optimize

# Clear all optimization
php artisan optimize:clear
```

### Code Generation

```bash
# Create Controller
php artisan make:controller EmployeeController

# Create Resource Controller (with CRUD methods)
php artisan make:controller EmployeeController --resource

# Create API Controller
php artisan make:controller API/EmployeeController --api

# Create Request Validation
php artisan make:request StoreEmployeeRequest

# Create Middleware
php artisan make:middleware CheckRole

# Create Command
php artisan make:command SendMonthlyReports
```

### Viewing Routes

```bash
# List all routes
php artisan route:list

# Filter routes by name
php artisan route:list --name=employee

# Filter routes by method
php artisan route:list --method=GET
```

### Queue Management

```bash
# Process queue jobs
php artisan queue:work

# Process jobs with retry limit
php artisan queue:listen --tries=1

# List failed jobs
php artisan queue:failed

# Retry all failed jobs
php artisan queue:retry all

# Clear all failed jobs
php artisan queue:flush
```

### Scheduled Tasks (Cron Jobs)

```bash
# Test schedule locally
php artisan schedule:work

# Run scheduled tasks manually
php artisan schedule:run

# List scheduled tasks
php artisan schedule:list
```

---

## Development Workflow

### 1. Creating a New Feature (Example: Employee Management)

**Step 1: Create Model and Migration**
```bash
php artisan make:model Employee -mcr
```
This creates:
- Model: `app/Models/Employee.php`
- Migration: `database/migrations/xxxx_create_employees_table.php`
- Controller: `app/Http/Controllers/EmployeeController.php`

**Step 2: Define Database Schema**
Edit the migration file:
```php
Schema::create('employees', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('phone')->nullable();
    $table->string('department');
    $table->decimal('salary', 10, 2);
    $table->date('joining_date');
    $table->integer('yearly_leave_limit')->default(20);
    $table->timestamps();
    $table->softDeletes(); // For soft delete functionality
});
```

**Step 3: Run Migration**
```bash
php artisan migrate
```

**Step 4: Define Model Relationships**
Edit `app/Models/Employee.php`:
```php
class Employee extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'department',
        'salary', 'joining_date', 'yearly_leave_limit'
    ];

    protected $casts = [
        'joining_date' => 'date',
        'salary' => 'decimal:2',
    ];

    // Relationships
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}
```

**Step 5: Create Routes**
Add to `routes/web.php`:
```php
Route::resource('employees', EmployeeController::class);
```

**Step 6: Test Your Feature**
```bash
php artisan route:list --name=employee
```

### 2. Creating Filament Resources (Admin Panel)

```bash
# Create Filament Resource
php artisan make:filament-resource Employee --generate

# Create simple resource
php artisan make:filament-resource Employee

# Create resource with form fields
php artisan make:filament-resource Employee --simple
```

This creates admin CRUD interface automatically!

### 3. Creating API Endpoints

**Create API Controller:**
```bash
php artisan make:controller API/EmployeeController --api
```

**Add API Routes** in `routes/api.php`:
```php
Route::apiResource('employees', EmployeeController::class);
```

**Create API Resource (for JSON formatting):**
```bash
php artisan make:resource EmployeeResource
```

---

## Laravel Horizon (Background Jobs)

### Installation
```bash
composer require laravel/horizon
php artisan horizon:install
php artisan migrate
```

### Configuration
Edit `.env`:
```env
HORIZON_PREFIX=pixarlabs
```

### Running Horizon
```bash
php artisan horizon
```

Access dashboard at: http://localhost:8000/horizon

### Horizon Commands
```bash
# Start Horizon
php artisan horizon

# Pause Horizon
php artisan horizon:pause

# Continue Horizon
php artisan horizon:continue

# Terminate Horizon
php artisan horizon:terminate

# Clear failed jobs
php artisan horizon:clear
```

---

## Google Drive Backup Integration

### Installation
```bash
composer require spatie/laravel-backup
php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"
```

### Configuration
Edit `config/backup.php` and `.env`:
```env
GOOGLE_DRIVE_FOLDER_PATH=/PixarLabs/Backups
```

### Backup Commands
```bash
# Run backup manually
php artisan backup:run

# Run only database backup
php artisan backup:run --only-db

# List all backups
php artisan backup:list

# Clean old backups (keep last 7)
php artisan backup:clean
```

### Schedule Daily Backups
Edit `app/Console/Kernel.php`:
```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('backup:clean')->daily()->at('01:00');
    $schedule->command('backup:run')->daily()->at('02:00');
}
```

---

## Slack Integration

### Setup Slack App
1. Go to https://api.slack.com/apps
2. Create New App
3. Get OAuth Token
4. Add to `.env`:
```env
SLACK_WEBHOOK_URL=your_webhook_url
SLACK_TOKEN=your_token
```

### Install Laravel Slack Package
```bash
composer require laravel/slack-notification-channel
```

### Create Slack Command
```bash
php artisan make:command TrackSlackAttendance
```

---

## WhatsApp Integration

### Setup (using Twilio or similar)
```bash
composer require twilio/sdk
```

Add to `.env`:
```env
TWILIO_SID=your_sid
TWILIO_AUTH_TOKEN=your_token
TWILIO_WHATSAPP_NUMBER=your_number
```

---

## Troubleshooting

### Problem: "Class not found" Error
**Solution:**
```bash
composer dump-autoload
```

### Problem: Permission Denied on Storage/Cache
**Solution:**
```bash
chmod -R 775 storage bootstrap/cache
```

### Problem: Database Connection Error
**Solution:**
1. Check `.env` database credentials
2. Verify database exists
3. Clear config cache:
```bash
php artisan config:clear
```

### Problem: Page Not Found (404)
**Solution:**
```bash
php artisan route:clear
php artisan cache:clear
```

### Problem: Changes Not Reflecting
**Solution:**
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### View Application Logs
```bash
# View latest logs
tail -f storage/logs/laravel.log

# View last 50 lines
tail -50 storage/logs/laravel.log
```

---

## Testing

### Create Tests
```bash
# Create Feature Test
php artisan make:test EmployeeTest

# Create Unit Test
php artisan make:test EmployeeTest --unit
```

### Run Tests
```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test --filter EmployeeTest

# Run with coverage
php artisan test --coverage
```

---

## Git Workflow

### Daily Workflow
```bash
# Check status
git status

# Add changes
git add .

# Commit changes
git commit -m "Added employee management feature"

# Push to remote
git push origin main

# Pull latest changes
git pull origin main
```

### Create Feature Branch
```bash
git checkout -b feature/employee-attendance
# Make changes
git add .
git commit -m "Added attendance tracking"
git push origin feature/employee-attendance
```

---

## Production Deployment

### Preparation
```bash
# Set environment to production
APP_ENV=production
APP_DEBUG=false

# Optimize application
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Seed production data
php artisan db:seed --force
```

### Server Setup (on production)
```bash
# Set permissions
chmod -R 755 storage bootstrap/cache

# Generate key (first time only)
php artisan key:generate

# Link storage
php artisan storage:link
```

---

## Useful Resources

- **Laravel Documentation**: https://laravel.com/docs
- **Wave Documentation**: https://devdojo.com/wave/docs
- **Filament Documentation**: https://filamentphp.com/docs
- **Laravel Best Practices**: https://github.com/alexeymezenin/laravel-best-practices

---

## Quick Reference Card

### Most Used Commands
```bash
# Start server
php artisan serve

# Create model with migration and controller
php artisan make:model Employee -mc

# Run migrations
php artisan migrate

# Fresh migration with seed
php artisan migrate:fresh --seed

# Clear all caches
php artisan optimize:clear

# List all routes
php artisan route:list

# Access database console
php artisan tinker

# Run queue worker
php artisan queue:work

# Run scheduled tasks
php artisan schedule:work

# View logs
tail -f storage/logs/laravel.log
```

### Database Quick Actions
```bash
# Create table
php artisan make:migration create_tablename_table
php artisan migrate

# Add column to existing table
php artisan make:migration add_column_to_tablename_table
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Reset database
php artisan migrate:fresh --seed
```

---

## Support

For issues or questions:
1. Check logs: `storage/logs/laravel.log`
2. Run: `php artisan about` to see system info
3. Clear caches: `php artisan optimize:clear`
4. Consult documentation or team members

---

**Last Updated:** October 2025
**Version:** 1.0
**Maintainer:** Pixar Labs Team
