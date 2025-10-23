# Pixar Labs Office Tracker - Development Guidelines

**Project Start Date:** October 2025
**Current Version:** 1.0.0
**Status:** Initial Setup Completed

---

## Project Overview

**Purpose:** Internal office management system for Pixar Labs team and finance tracking.

**Tech Stack:**
- Laravel 12.34.0
- Wave SaaS Framework
- Filament PHP (Admin Panel)
- MySQL/SQLite Database
- Laravel Horizon (Queue Management)
- Livewire (Dynamic UI)

---

## Development Principles

### Core Rules
1. ✅ **DO NOT run npm commands** - Focus on Laravel backend
2. ✅ **Use MySQL for production** - Extensible schema design
3. ✅ **Update this file** after every feature implementation
4. ✅ **Daily Google Drive backups** - Keep last 7 backups
5. ✅ **Use Horizon** for all cron jobs and background tasks
6. ✅ **Write tests** for critical features
7. ✅ **Comment complex logic** for future maintenance

### Database Design Philosophy
- Design tables for future extensibility
- Use proper relationships (hasMany, belongsTo, etc.)
- Add soft deletes where applicable
- Use meaningful column names
- Always include timestamps
- Add indexes for frequently queried columns

---

## Project Structure

```
office/
├── app/
│   ├── Models/              # Database models
│   ├── Http/Controllers/    # Application logic
│   ├── Filament/            # Admin panel resources
│   └── Console/Commands/    # Custom artisan commands
├── database/
│   ├── migrations/          # Database structure
│   └── seeders/             # Sample data
├── resources/
│   ├── views/               # Blade templates
│   └── themes/              # Wave themes
├── routes/
│   ├── web.php              # Web routes
│   ├── api.php              # API endpoints
│   └── console.php          # Console commands
└── wave/                    # Wave framework core
```

---

## Features Implementation Status

### ✅ Completed Features

#### 1. Project Setup (Oct 2025)
- [x] Laravel installation
- [x] Wave framework integration
- [x] Database configuration
- [x] Initial migrations
- [x] Filament admin panel setup
- [x] User authentication

**Files Modified:**
- `.env` - Environment configuration
- `database/database.sqlite` - Database file created
- `composer.json` - Dependencies installed

**Commands Used:**
```bash
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan session:table
php artisan queue:table
php artisan cache:table
```

---

### 🚧 In Progress Features

#### None currently

---

### 📋 Planned Features

#### 1. Team Management Module
**Priority:** High
**Estimated Time:** 2-3 days

**Components:**
- Employee CRUD operations
- Department management
- Salary tracking
- Holiday allocation (yearly limit)
- Leave management system

**Database Tables Needed:**
- `employees` - Employee master data
- `departments` - Department information
- `salaries` - Salary history
- `leaves` - Leave applications
- `holidays` - Company holidays

**Implementation Steps:**
1. Create migrations for all tables
2. Build Filament resources for admin panel
3. Set up relationships between models
4. Create leave approval workflow
5. Add validations and rules

---

#### 2. Attendance Tracking
**Priority:** High
**Estimated Time:** 3-4 days

**Components:**
- Manual attendance entry
- Slack integration for #signin-out channel
- Entry/Exit time tracking
- Daily attendance reports
- Weekly/Monthly/Yearly charts

**Database Tables Needed:**
- `attendances` - Daily attendance records
- `slack_users` - Slack user mapping
- `attendance_settings` - Office timings

**Integration Points:**
- Slack API for channel monitoring
- Real-time notifications

**Implementation Steps:**
1. Create attendance tables
2. Build Filament attendance resource
3. Set up Slack webhook integration
4. Create attendance calculation logic
5. Build reporting charts

---

#### 3. Income/Expense Tracking
**Priority:** High
**Estimated Time:** 4-5 days

**Components:**
- Income categories (Freemius, Paddle, Affiliate, Others)
- Expense categories (Salary, Office, Personal)
- Multi-currency support (USD/BDT)
- Receipt upload to Google Drive
- Monthly cost charts
- Transaction history

**Database Tables Needed:**
- `incomes` - Income records
- `expenses` - Expense records
- `income_categories` - Income types
- `expense_categories` - Expense types
- `payment_methods` - Payment options
- `receipts` - Uploaded receipt files

**Payment Methods:**
- City Bank, IBBL, Southeast Bank
- BKash, SCB, EBL
- Cash

**Implementation Steps:**
1. Create finance tables with multi-currency support
2. Build Filament resources for income/expense
3. Set up Google Drive integration
4. Create receipt upload functionality
5. Build transaction summary dashboard
6. Add chart visualizations

---

#### 4. Slack Integration
**Priority:** High
**Estimated Time:** 3-4 days

**Features:**
- Track attendance from #signin-out channel
- Monitor daily updates from #daily-updates channel
- Send monthly feedback reminders
- Post income/expense via Slack commands

**Implementation Steps:**
1. Register Slack App
2. Set up OAuth tokens
3. Create webhook endpoints
4. Build Slack message parser
5. Create scheduled tasks for reminders
6. Test all Slack interactions

---

#### 5. WhatsApp Integration
**Priority:** Medium
**Estimated Time:** 2-3 days

**Features:**
- Post income/expense via WhatsApp
- Upload receipt images
- Receive confirmation messages

**Implementation Steps:**
1. Set up Twilio/WhatsApp Business API
2. Create message webhook
3. Build message parser
4. Implement image upload to Google Drive
5. Send confirmation responses

---

#### 6. Google Drive Integration
**Priority:** High
**Estimated Time:** 2 days

**Features:**
- Store receipts in organized folders (Year/Month/Type)
- Daily database backups
- Keep last 7 backups
- Automated cleanup

**Implementation Steps:**
1. Set up Google Drive API
2. Create folder structure automation
3. Implement backup functionality using spatie/laravel-backup
4. Schedule daily backup tasks
5. Create cleanup command

---

#### 7. Dashboard & Widgets
**Priority:** Medium
**Estimated Time:** 3-4 days

**Components:**
- Current month income/expense
- Team performance metrics
- Attendance summary
- Quick action buttons
- Visual charts and graphs

**Implementation Steps:**
1. Design dashboard layout
2. Create widget components
3. Build data aggregation queries
4. Implement chart libraries
5. Add real-time updates

---

#### 8. Reporting System
**Priority:** Medium
**Estimated Time:** 3-4 days

**Reports:**
- Weekly team member reports
- Monthly employee summaries
- Yearly income/expense analysis
- Attendance reports
- Leave balance reports

**Implementation Steps:**
1. Create report templates
2. Build PDF generation
3. Add email delivery
4. Create scheduled report automation
5. Add export functionality (Excel/PDF)

---

#### 9. API Integration - Freemius
**Priority:** Medium
**Estimated Time:** 2 days

**Features:**
- Fetch product-based income
- Track sales automatically
- Generate product reports

**Implementation Steps:**
1. Register Freemius API credentials
2. Create API client
3. Build data sync command
4. Schedule periodic imports
5. Create product income reports

**API Documentation:** https://docs.freemius.com/api

---

#### 10. API Integration - bo.jeweltheme.com
**Priority:** Low
**Estimated Time:** 1-2 days

**Features:**
- Track internal product income
- Sync sales data

**Implementation Steps:**
1. Define API endpoints
2. Create integration service
3. Build sync functionality
4. Add to scheduled tasks

---

## Database Schema Design

### Current Tables

#### Users Table
```sql
- id (primary key)
- name (varchar)
- email (varchar, unique)
- password (varchar, nullable)
- role (varchar)
- created_at, updated_at
```

#### Roles & Permissions (Spatie)
- Standard Spatie permission tables
- Roles: admin, employee, manager

---

### Planned Tables

#### Employees
```sql
- id (PK)
- user_id (FK to users)
- department_id (FK)
- employee_code (unique)
- phone (varchar)
- joining_date (date)
- designation (varchar)
- salary (decimal)
- yearly_leave_limit (integer)
- status (active/inactive)
- timestamps
- soft_deletes
```

#### Departments
```sql
- id (PK)
- name (varchar)
- code (varchar, unique)
- manager_id (FK to employees)
- timestamps
```

#### Attendances
```sql
- id (PK)
- employee_id (FK)
- date (date)
- check_in_time (time)
- check_out_time (time)
- working_hours (decimal)
- status (present/absent/half-day)
- source (manual/slack)
- slack_message_id (varchar, nullable)
- timestamps
```

#### Leaves
```sql
- id (PK)
- employee_id (FK)
- leave_type (casual/sick/annual)
- start_date (date)
- end_date (date)
- days_count (integer)
- reason (text)
- status (pending/approved/rejected)
- approved_by (FK to users)
- timestamps
```

#### Incomes
```sql
- id (PK)
- category_id (FK)
- amount (decimal)
- currency (USD/BDT)
- payment_method_id (FK)
- description (text)
- source (freemius/paddle/affiliate/manual)
- transaction_date (date)
- receipt_path (varchar, nullable)
- created_by (FK to users)
- timestamps
```

#### Expenses
```sql
- id (PK)
- category_id (FK)
- amount (decimal)
- currency (USD/BDT)
- payment_method_id (FK)
- expense_type (personal/office/shared)
- description (text)
- transaction_date (date)
- receipt_path (varchar, nullable)
- created_by (FK to users)
- timestamps
```

#### Expense Categories
```sql
- id (PK)
- name (varchar)
- type (personal/office/shared)
- is_active (boolean)
- timestamps
```

**Default Categories:**
- Employee Salary (Office)
- Family (Personal)
- Office Furniture (Office)
- Server Bill (Office)
- AWS, Linode, Vultr (Office)
- Rent, Lunch (Office)
- Coffee Beans, Internet (Office)
- Home Rent (Personal)
- School fees (Personal)
- Home Assistant/Bua (Personal)
- Product Share - Labu (Shared)
- Product Share - Babar Vai (Shared)

#### Payment Methods
```sql
- id (PK)
- name (varchar)
- type (bank/mobile/cash)
- is_active (boolean)
- timestamps
```

**Default Methods:**
- City Bank, IBBL Bank, Southeast Bank
- Standard Chartered, Eastern Bank Limited
- BKash
- Cash Payment

---

## API Endpoints Documentation

### Attendance API
```
POST   /api/attendance/checkin
POST   /api/attendance/checkout
GET    /api/attendance/today
GET    /api/attendance/employee/{id}
```

### Income/Expense API
```
POST   /api/income
GET    /api/income
POST   /api/expense
GET    /api/expense
GET    /api/transactions/summary
```

### Slack Webhooks
```
POST   /webhook/slack/attendance
POST   /webhook/slack/daily-update
GET    /slack/oauth/callback
```

### WhatsApp Webhooks
```
POST   /webhook/whatsapp/message
POST   /webhook/whatsapp/status
```

---

## Scheduled Tasks (Cron Jobs)

### Daily Tasks
```php
// In app/Console/Kernel.php
$schedule->command('backup:clean')->daily()->at('01:00');
$schedule->command('backup:run')->daily()->at('02:00');
$schedule->command('attendance:generate-report')->daily()->at('23:00');
```

### Weekly Tasks
```php
$schedule->command('reports:weekly')->weekly()->mondays()->at('09:00');
```

### Monthly Tasks
```php
$schedule->command('salary:process')->monthly()->at('00:00');
$schedule->command('reports:monthly')->monthly()->at('09:00');
$schedule->command('slack:feedback-reminder')->monthly()->at('10:00');
```

---

## Testing Strategy

### Unit Tests
- Model relationships
- Business logic calculations
- Helper functions

### Feature Tests
- Employee CRUD operations
- Attendance tracking
- Income/Expense recording
- Leave applications
- Report generation

### Integration Tests
- Slack webhook handling
- WhatsApp message processing
- Google Drive uploads
- Freemius API sync

---

## Security Considerations

1. **Authentication:** Laravel Sanctum for API
2. **Authorization:** Spatie Permissions for role-based access
3. **Input Validation:** Form Request classes for all inputs
4. **SQL Injection:** Use Eloquent ORM, avoid raw queries
5. **File Upload:** Validate file types and sizes
6. **API Keys:** Store in `.env`, never commit
7. **CSRF Protection:** Enabled by default in Laravel
8. **Rate Limiting:** Apply to API endpoints

---

## Performance Optimization

### Caching Strategy
- Cache employee list (1 hour)
- Cache department list (1 hour)
- Cache payment methods (1 day)
- Cache expense categories (1 day)
- Clear cache on updates

### Database Optimization
- Add indexes on foreign keys
- Index frequently queried columns (date, employee_id)
- Use eager loading to prevent N+1 queries
- Implement pagination for large datasets

### Queue Jobs
- Send email notifications asynchronously
- Process large reports in background
- Upload files to Google Drive via queue
- Sync external APIs via queue

---

## Deployment Checklist

### Pre-Deployment
- [ ] Run all tests
- [ ] Update environment variables
- [ ] Backup current database
- [ ] Review security settings
- [ ] Optimize autoloader

### Deployment Steps
```bash
php artisan down                    # Enable maintenance mode
git pull origin main                # Pull latest code
composer install --no-dev           # Install dependencies
php artisan migrate --force         # Run migrations
php artisan config:cache            # Cache config
php artisan route:cache             # Cache routes
php artisan view:cache              # Cache views
php artisan optimize                # Optimize application
php artisan up                      # Disable maintenance mode
```

### Post-Deployment
- [ ] Verify application is running
- [ ] Check logs for errors
- [ ] Test critical features
- [ ] Monitor performance
- [ ] Create deployment tag

---

## Code Standards

### Naming Conventions
- **Models:** Singular, PascalCase (Employee, Attendance)
- **Controllers:** PascalCase with Controller suffix (EmployeeController)
- **Variables:** camelCase ($employeeName)
- **Database Tables:** Plural, snake_case (employees, attendances)
- **Database Columns:** snake_case (first_name, created_at)
- **Routes:** kebab-case (/employee-attendance)

### Code Organization
```php
// Controller method order:
1. index()
2. create()
3. store()
4. show()
5. edit()
6. update()
7. destroy()
8. Custom methods
```

### Comments
```php
// Good: Explain WHY, not WHAT
// Calculate working hours excluding lunch break (1 hour)
$workingHours = $totalHours - 1;

// Bad: Obvious statement
// Subtract 1 from total hours
$workingHours = $totalHours - 1;
```

---

## Change Log

### Version 1.0.0 (Oct 2025)
- Initial project setup
- Laravel and Wave installation
- Database configuration
- Basic authentication
- Admin panel setup with Filament

---

## Notes for Future Development

### Important Reminders
1. Always create migrations for database changes
2. Update this file after implementing each feature
3. Test integrations thoroughly before deployment
4. Keep backup before major changes
5. Document API endpoints clearly

### Known Issues
- None currently

### Future Enhancements
- Mobile app integration
- Real-time notifications
- Advanced analytics dashboard
- Integration with more payment gateways
- Employee self-service portal

---

**Last Updated:** October 2025
**Updated By:** Development Team
**Next Review Date:** Monthly

---

## Quick Commands Reference

```bash
# Start development
php artisan serve

# Database refresh
php artisan migrate:fresh --seed

# Create new feature
php artisan make:model FeatureName -a

# Clear everything
php artisan optimize:clear

# Run tests
php artisan test

# Check status
php artisan about
```
