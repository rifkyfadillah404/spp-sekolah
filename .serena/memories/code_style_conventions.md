# Code Style and Conventions

## PHP Code Style
- Uses Laravel Pint for code formatting (installed as dev dependency)
- Follows PSR-12 coding standards
- Indentation: 4 spaces (as per .editorconfig)
- Line endings: LF (Unix style)
- UTF-8 encoding

## Naming Conventions
- **Classes**: PascalCase (e.g., StudentController, SppBill)
- **Methods**: camelCase (e.g., getStudentsByClass, createTransaction)
- **Variables**: camelCase (e.g., studentId, dueDate)
- **Database tables**: snake_case plural (e.g., spp_bills, students)
- **Database columns**: snake_case (e.g., student_id, due_date)

## File Organization
- **Controllers**: app/Http/Controllers/ organized by role (Admin, Auth, etc.)
- **Models**: app/Models/ with Eloquent ORM
- **Migrations**: database/migrations/ with timestamp prefixes
- **Views**: resources/views/ organized by section
- **Routes**: routes/web.php for web routes, separate auth routes file

## Laravel Specific Conventions
- Uses Laravel Resource Controllers where appropriate
- Leverages Eloquent relationships between models
- Uses Request classes for form validation
- Implements Middleware for authentication and authorization
- Uses Artisan commands for scheduled tasks
- Follows Laravel naming conventions for database tables and columns

## Type Hinting and Documentation
- Models use $fillable property to define mass-assignable attributes
- Models define relationships as methods with proper return types
- Controllers use dependency injection for services
- Custom services are created in app/Services/
- Command classes have detailed option descriptions and usage examples

## Frontend Conventions
- Uses Tailwind CSS for styling
- Implements Alpine.js for interactive components
- Follows Laravel Breeze authentication scaffolding
- Uses Blade components for reusable UI elements