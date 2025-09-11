# Suggested Commands for Development

## Project Setup
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Copy and configure environment file
cp .env.example .env
# Edit .env file with appropriate settings

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Run database seeders (optional)
php artisan db:seed

# Start development server
php artisan serve
```

## Development Commands
```bash
# Run development server
php artisan serve

# Run development server on specific host/port
php artisan serve --host=0.0.0.0 --port=8000

# Run queue worker (if using queues)
php artisan queue:work

# Run scheduler (for automatic SPP bill generation)
php artisan schedule:work
```

## Frontend Development
```bash
# Compile and hot-reload for development
npm run dev

# Compile and minify for production
npm run build
```

## Code Quality
```bash
# Format PHP code with Laravel Pint
./vendor/bin/pint

# Run PHPStan for static analysis (if installed)
./vendor/bin/phpstan analyse

# Run PHP CS Fixer (if installed)
./vendor/bin/php-cs-fixer fix
```

## Testing
```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/ExampleTest.php

# Run tests with coverage (if xdebug installed)
php artisan test --coverage

# Run tests in parallel
php artisan test --parallel
```

## Database
```bash
# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Reset and re-run all migrations
php artisan migrate:refresh

# Run seeders
php artisan db:seed

# Generate migration file
php artisan make:migration create_table_name

# Generate seeder file
php artisan make:seeder SeederName
```

## Artisan Commands
```bash
# Generate SPP bills for current month
php artisan spp:generate-bills

# Generate SPP bills for specific month/year
php artisan spp:generate-bills --month=9 --year=2025

# Generate SPP bills for specific class
php artisan spp:generate-bills --class="XII IPA 1"

# Generate SPP bills for specific student
php artisan spp:generate-bills --student=5

# Force update non-paid existing bills
php artisan spp:generate-bills --force
```

## Caching
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Cache configuration for production
php artisan config:cache

# Cache routes for production
php artisan route:cache

# Cache views for production
php artisan view:cache
```

## Windows Specific Commands
Since this is a Windows environment, use these commands in Command Prompt or PowerShell:

```cmd
# Run development server
php artisan serve

# Run tests
php artisan test

# Run migrations
php artisan migrate

# Format code (using Windows path)
vendor\\bin\\pint.bat
```