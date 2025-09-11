# Project Structure

## Main Directories
- **app/**: Contains the core application code
  - **Console/**: Artisan commands
    - **Commands/**: Custom artisan commands (e.g., GenerateMonthlySppBills.php)
  - **Exceptions/**: Custom exception handlers
  - **Exports/**: Export classes for Excel files
  - **Http/**: HTTP handling layer
    - **Controllers/**: Controllers organized by role
      - **Admin/**: Admin-specific controllers
      - **Auth/**: Authentication controllers
    - **Middleware/**: Custom middleware (e.g., CheckRole.php)
    - **Requests/**: Form request validation classes
  - **Models/**: Eloquent models (Student.php, SppBill.php, etc.)
  - **Providers/**: Service providers
  - **Services/**: Custom services (MidtransService.php)
  - **View/**: Custom view components
    - **Components/**: Blade components

- **config/**: Configuration files
  - **services.php**: Third-party service configurations (Midtrans, etc.)

- **database/**: Database related files
  - **migrations/**: Database migration files
  - **seeders/**: Database seeders (RolePermissionSeeder.php, SampleDataSeeder.php)

- **resources/**: View files and assets
  - **views/**: Blade template files

- **routes/**: Route definitions
  - **web.php**: Web routes
  - **api.php**: API routes
  - **auth.php**: Authentication routes

- **tests/**: Automated tests
  - **Feature/**: Feature tests
  - **Unit/**: Unit tests

## Key Files
- **artisan**: Laravel CLI tool
- **composer.json**: PHP dependencies and scripts
- **package.json**: Node.js dependencies and scripts
- **.env.example**: Environment variable examples
- **phpunit.xml**: PHPUnit configuration
- **.editorconfig**: Code style configuration