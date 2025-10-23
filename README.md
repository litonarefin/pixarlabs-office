# Pixar Labs Office Tracker

> A comprehensive office management system for team tracking, finance management, and operational efficiency.

![Laravel](https://img.shields.io/badge/Laravel-12.34-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php&logoColor=white)
![Status](https://img.shields.io/badge/Status-Active%20Development-green)

---

## 📋 Overview

**Pixar Labs Office Tracker** is an internal management application designed to streamline team operations, track finances, monitor attendance, and generate comprehensive reports. Built on Laravel and Wave SaaS framework with Filament admin panel.

### Key Features

✅ **Team Management**
- Employee records with departments and roles
- Salary tracking and history
- Leave management with yearly limits
- Holiday calendar

✅ **Attendance Tracking**
- Manual and automated attendance via Slack
- Entry/Exit time monitoring from #signin-out channel
- Weekly, monthly, and yearly reports
- Performance analytics

✅ **Income/Expense Management**
- Multi-currency support (USD/BDT)
- Categorized income sources (Freemius, Paddle, Affiliates)
- Expense tracking (Personal/Office/Shared)
- Receipt storage on Google Drive
- Transaction history and summaries

✅ **Dashboard & Reports**
- Real-time widgets for income, expense, attendance
- Monthly performance metrics
- Team-specific reports with filters
- Visual charts and graphs

✅ **Integrations**
- **Slack:** Attendance tracking, daily updates, reminders
- **WhatsApp:** Expense/Income logging with receipts
- **Google Drive:** Receipt storage and daily backups
- **Freemius API:** Product income tracking
- **Horizon:** Background job management

---

## 🚀 Quick Start

### Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL or SQLite
- Git

### Installation

```bash
# Clone repository
git clone https://github.com/pixarlabs/office-tracker.git
cd office-tracker

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Create database (SQLite)
touch database/database.sqlite

# Run migrations and seed data
php artisan migrate:fresh --seed

# Create required tables
php artisan session:table
php artisan queue:table
php artisan cache:table
php artisan migrate

# Start development server
php artisan serve
```

Access the application at: **http://localhost:8000**

---

## 📚 Documentation

- **[INSTRUCTIONS.md](INSTRUCTIONS.md)** - Complete command reference and usage guide
- **[GUIDELINES.md](GUIDELINES.md)** - Development guidelines and feature documentation
- **[CLAUDE.md](CLAUDE.md)** - AI assistant context and architecture

---

## 🏗️ Tech Stack

| Technology | Purpose |
|------------|---------|
| **Laravel 12** | PHP Framework |
| **Wave** | SaaS Boilerplate |
| **Filament** | Admin Panel |
| **Livewire** | Dynamic UI Components |
| **Horizon** | Queue Management |
| **SQLite/MySQL** | Database |
| **Slack API** | Team Communication |
| **Google Drive API** | File Storage & Backup |

---

## 📊 Features Roadmap

### ✅ Completed
- [x] Project setup and configuration
- [x] User authentication
- [x] Admin panel (Filament)
- [x] Database migrations

### 🚧 In Progress
- [ ] None currently

### 📋 Planned
- [ ] Employee Management Module
- [ ] Attendance Tracking System
- [ ] Income/Expense Tracker
- [ ] Slack Integration
- [ ] WhatsApp Integration
- [ ] Google Drive Integration
- [ ] Dashboard & Widgets
- [ ] Reporting System
- [ ] Freemius API Integration

See [GUIDELINES.md](GUIDELINES.md) for detailed feature specifications.

---

## 🎯 Quick Actions

### Common Commands

```bash
# Start server
php artisan serve

# Run migrations
php artisan migrate

# Fresh database with seed data
php artisan migrate:fresh --seed

# Clear all caches
php artisan optimize:clear

# List all routes
php artisan route:list

# Run background jobs
php artisan queue:work

# Start Horizon dashboard
php artisan horizon
```

### Development Workflow

```bash
# Create new feature
php artisan make:model FeatureName -mcr

# Create Filament resource
php artisan make:filament-resource FeatureName --generate

# Run tests
php artisan test

# View logs
tail -f storage/logs/laravel.log
```

---

## 📖 Usage Examples

### Creating an Employee

```bash
php artisan make:model Employee -a
```

### Adding Attendance Record

```bash
php artisan tinker
>>> App\Models\Attendance::create([
    'employee_id' => 1,
    'date' => now(),
    'check_in_time' => '09:00',
    'check_out_time' => '18:00',
]);
```

### Running Backups

```bash
php artisan backup:run
```

---

## 🔗 API Integrations

### Slack
- Monitor #signin-out channel for attendance
- Track #daily-updates for activity logs
- Send monthly feedback reminders

### WhatsApp
- Post income/expense via messages
- Upload receipt images
- Receive confirmations

### Google Drive
- Store receipts: `/Year/Month/Type/`
- Daily database backups
- Retain last 7 backups

### Freemius
- Sync product sales automatically
- Track revenue per product
- Generate income reports

---

## 🗄️ Database Structure

### Core Tables
- `employees` - Team member information
- `attendances` - Daily check-in/out records
- `leaves` - Leave applications and approvals
- `incomes` - Revenue tracking
- `expenses` - Expense records
- `departments` - Organizational units

See [GUIDELINES.md](GUIDELINES.md) for complete schema.

---

## 🔐 Security

- ✅ Authentication via Laravel Sanctum
- ✅ Role-based access with Spatie Permissions
- ✅ CSRF protection enabled
- ✅ SQL injection prevention (Eloquent ORM)
- ✅ Environment variables for sensitive data
- ✅ File upload validation
- ✅ API rate limiting

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

## 📦 Deployment

### Production Setup

```bash
# Set environment
APP_ENV=production
APP_DEBUG=false

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force
```

See [INSTRUCTIONS.md](INSTRUCTIONS.md) for detailed deployment steps.

---

## 🤝 Contributing

1. Create feature branch: `git checkout -b feature/amazing-feature`
2. Commit changes: `git commit -m 'Add amazing feature'`
3. Push to branch: `git push origin feature/amazing-feature`
4. Open Pull Request

---

## 📝 License

This project is proprietary software for **Pixar Labs** internal use.

---

## 👥 Team

**Pixar Labs Development Team**
- Internal office management tool
- For questions: Contact team lead

---

## 📞 Support

### Having Issues?

1. Check [INSTRUCTIONS.md](INSTRUCTIONS.md) for command reference
2. Review [GUIDELINES.md](GUIDELINES.md) for development guidelines
3. Check logs: `storage/logs/laravel.log`
4. Run diagnostics: `php artisan about`
5. Contact development team

---

## 🔄 Version History

### Version 1.0.0 (October 2025)
- Initial project setup
- Laravel 12 + Wave framework
- Filament admin panel
- Database structure
- Core authentication

---

## 🌟 Built With

This project is built on top of:
- [Laravel](https://laravel.com) - The PHP Framework
- [Wave](https://devdojo.com/wave) - SaaS Starter Kit
- [Filament](https://filamentphp.com) - Admin Panel
- [Livewire](https://livewire.laravel.com) - Dynamic Components

---

## 📚 Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Wave Documentation](https://devdojo.com/wave/docs)
- [Filament Documentation](https://filamentphp.com/docs)
- [Laravel Horizon](https://laravel.com/docs/horizon)

---

**Made with ❤️ by Pixar Labs Team**

**Last Updated:** October 2025
