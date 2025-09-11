# Task Completion Checklist

When completing a task, follow this checklist to ensure code quality and consistency:

## Code Quality
1. **Code Style**: Run Laravel Pint to format PHP code
   ```bash
   ./vendor/bin/pint
   ```

2. **Validation**: Ensure all form inputs are properly validated using Request classes

3. **Error Handling**: Implement proper error handling and user feedback

4. **Security**: 
   - Use authorization middleware for protected routes
   - Validate user permissions using Spatie permissions
   - Sanitize user inputs
   - Use Eloquent models instead of raw SQL queries

## Testing
1. **Unit Tests**: Write unit tests for new business logic
2. **Feature Tests**: Write feature tests for new functionality
3. **Run Tests**: Execute the test suite to ensure no regressions
   ```bash
   php artisan test
   ```

## Documentation
1. **Code Comments**: Add PHPDoc comments for new classes and methods
2. **Route Documentation**: Ensure new routes are properly documented
3. **README Updates**: Update README if significant functionality is added

## Database
1. **Migrations**: Create migrations for any database schema changes
2. **Seeders**: Update seeders if sample data is needed
3. **Run Migrations**: Test migrations on a clean database

## Frontend
1. **Responsive Design**: Ensure UI works on different screen sizes
2. **Accessibility**: Follow accessibility best practices
3. **Performance**: Optimize assets and minimize HTTP requests

## Deployment
1. **Environment Variables**: Document any new environment variables in .env.example
2. **Configuration**: Update config files if needed
3. **Caching**: Clear caches after deployment
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   ```

## Git
1. **Commit Message**: Write a clear, descriptive commit message
2. **Branch Naming**: Use descriptive branch names (feature/, fix/, etc.)
3. **Pull Request**: Create a pull request with detailed description of changes

## Windows Environment
1. **Line Endings**: Ensure consistent LF line endings (as per .editorconfig)
2. **File Permissions**: Check that file permissions are correct
3. **Path Separators**: Use forward slashes in configuration files, even on Windows