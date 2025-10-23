# Pixar Labs Office Tracker - Quick Reference Card

> **Keep this handy for daily development tasks**

---

## 🚀 Starting & Stopping

```bash
# Start development server
php artisan serve
# → http://localhost:8000

# Start with full stack (queue, logs, etc)
composer run dev

# Stop server
Ctrl + C
```

---

## 💾 Database Operations

### Fresh Start
```bash
# Complete reset with sample data
php artisan migrate:fresh --seed
```

### Regular Migrations
```bash
# Run new migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Check migration status
php artisan migrate:status
```

### Database Console
```bash
# Open Tinker (interactive console)
php artisan tinker

# Examples:
User::all()                    # Get all users
User::find(1)                  # Find user by ID
User::create([...])            # Create new user
```

---

## 🏗️ Creating New Features

### Full Feature Scaffold
```bash
# Model + Migration + Controller + Resource
php artisan make:model FeatureName -a
```

### Individual Components
```bash
# Model only
php artisan make:model Employee

# Model with migration
php artisan make:model Employee -m

# Controller
php artisan make:controller EmployeeController

# Migration
php artisan make:migration create_employees_table
```

### Filament Admin Resources
```bash
# Auto-generate admin panel
php artisan make:filament-resource Employee --generate

# Simple resource
php artisan make:filament-resource Employee
```

---

## 🧹 Clearing Caches

### Clear Everything
```bash
# One command to clear all
php artisan optimize:clear
```

### Individual Caches
```bash
php artisan cache:clear        # Application cache
php artisan config:clear       # Config cache
php artisan route:clear        # Route cache
php artisan view:clear         # View cache
```

---

## 📋 Viewing Information

```bash
# List all routes
php artisan route:list

# Application info
php artisan about

# Check for issues
php artisan optimize
```

---

## 🔄 Queue & Jobs

```bash
# Start queue worker
php artisan queue:work

# Process with retry limit
php artisan queue:listen --tries=1

# List failed jobs
php artisan queue:failed

# Retry all failed jobs
php artisan queue:retry all
```

---

## ⏰ Scheduled Tasks

```bash
# Run scheduler (for testing)
php artisan schedule:work

# Run manually
php artisan schedule:run

# List scheduled tasks
php artisan schedule:list
```

---

## 🐛 Debugging & Logs

```bash
# View logs live
tail -f storage/logs/laravel.log

# View last 50 lines
tail -50 storage/logs/laravel.log

# Check for errors
php artisan optimize:clear && php artisan serve
```

---

## 📦 Composer Operations

```bash
# Install packages
composer install

# Update packages
composer update

# Dump autoload
composer dump-autoload

# Install without dev dependencies (production)
composer install --no-dev
```

---

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter EmployeeTest

# With coverage
php artisan test --coverage
```

---

## 🔐 Security & Permissions

```bash
# Generate app key
php artisan key:generate

# Set storage permissions
chmod -R 775 storage bootstrap/cache

# Create symbolic link for storage
php artisan storage:link
```

---

## 📊 Common Artisan Commands

| Command | Description |
|---------|-------------|
| `php artisan serve` | Start dev server |
| `php artisan migrate` | Run migrations |
| `php artisan tinker` | Interactive console |
| `php artisan route:list` | Show all routes |
| `php artisan make:model Name -a` | Create full model scaffold |
| `php artisan optimize:clear` | Clear all caches |
| `php artisan queue:work` | Process jobs |
| `php artisan test` | Run tests |

---

## 🎯 Daily Workflow

### Morning Start
```bash
# 1. Pull latest changes
git pull origin main

# 2. Update dependencies
composer install

# 3. Run new migrations
php artisan migrate

# 4. Clear caches
php artisan optimize:clear

# 5. Start server
php artisan serve
```

### Before Committing
```bash
# 1. Run tests
php artisan test

# 2. Check code quality
php artisan optimize

# 3. Commit changes
git add .
git commit -m "Description"
git push
```

---

## 🚨 Emergency Fixes

### "Something broke"
```bash
# Step 1: Clear everything
php artisan optimize:clear

# Step 2: Reinstall dependencies
composer dump-autoload

# Step 3: Restart server
php artisan serve
```

### "Database issues"
```bash
# Nuclear option (resets everything)
php artisan migrate:fresh --seed

# Safer option (run pending migrations)
php artisan migrate
```

### "Routes not working"
```bash
php artisan route:clear
php artisan cache:clear
php artisan config:clear
```

---

## 💡 Pro Tips

1. **Use Tinker for Quick Tests**
   ```bash
   php artisan tinker
   >>> Employee::count()
   ```

2. **Watch Logs While Testing**
   ```bash
   tail -f storage/logs/laravel.log
   ```

3. **Generate Multiple Things at Once**
   ```bash
   php artisan make:model Employee -a
   # Creates: Model, Migration, Controller, Factory, Seeder, Request
   ```

4. **Search Routes**
   ```bash
   php artisan route:list --name=employee
   ```

5. **Use Filament for Quick Admin**
   ```bash
   php artisan make:filament-resource Employee --generate
   # Auto-creates full CRUD in admin panel!
   ```

---

## 📞 Quick Help

### Getting Help
```bash
# General help
php artisan help

# Help for specific command
php artisan help migrate
```

### Documentation Links
- Laravel: https://laravel.com/docs
- Wave: https://devdojo.com/wave/docs
- Filament: https://filamentphp.com/docs

---

## 🔗 Important URLs (when server is running)

- **Application:** http://localhost:8000
- **Admin Panel:** http://localhost:8000/admin
- **Horizon Dashboard:** http://localhost:8000/horizon (after installing)

---

## 📱 Access Credentials (Default Seeded Data)

After running `php artisan db:seed`:
- **Email:** admin@admin.com
- **Password:** password

---

## 🎨 Filament Quick Commands

```bash
# Create resource (CRUD)
php artisan make:filament-resource Employee

# Create custom page
php artisan make:filament-page Settings

# Create widget
php artisan make:filament-widget StatsOverview

# Create relation manager
php artisan make:filament-relation-manager EmployeeResource attendances
```

---

## 📝 Git Quick Commands

```bash
# Daily workflow
git status                           # Check changes
git add .                            # Stage all
git commit -m "Message"              # Commit
git push                             # Push to remote

# Branch workflow
git checkout -b feature/new-feature  # Create branch
git checkout main                    # Switch to main
git merge feature/new-feature        # Merge branch
git branch -d feature/new-feature    # Delete branch
```

---

## 🎯 Feature Development Checklist

When adding a new feature:

- [ ] Create model: `php artisan make:model Name -a`
- [ ] Edit migration file with schema
- [ ] Run migration: `php artisan migrate`
- [ ] Define model relationships
- [ ] Create Filament resource (if admin needed)
- [ ] Add routes
- [ ] Test functionality
- [ ] Update GUIDELINES.md
- [ ] Commit changes

---

**Print this page and keep it near your desk! 📌**

**Last Updated:** October 2025
