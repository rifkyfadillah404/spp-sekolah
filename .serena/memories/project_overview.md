# SPP Sekolah BE - School Tuition Payment System

## Project Purpose
This is a Laravel-based web application for managing school tuition payments (SPP - Sumbangan Pembinaan Pendidikan). The system allows schools to:
- Manage student data
- Generate monthly tuition bills automatically
- Process payments through Midtrans payment gateway
- Generate reports in various formats (PDF, Excel)

## Tech Stack
- **Backend Framework**: Laravel 10.x (PHP 8.1+)
- **Frontend**: Blade templates with Tailwind CSS, Alpine.js
- **Database**: MySQL
- **Payment Gateway**: Midtrans
- **PDF Generation**: barryvdh/laravel-dompdf
- **Excel Export**: maatwebsite/excel
- **Authentication**: Laravel Breeze with Sanctum
- **Authorization**: spatie/laravel-permission for role-based access control
- **Testing**: PHPUnit

## Key Features
1. **Student Management**: CRUD operations for student data
2. **SPP Bill Generation**: Automatic monthly bill generation via artisan command
3. **Payment Processing**: Integration with Midtrans payment gateway
4. **Reporting**: Export student and payment data to PDF and Excel
5. **Role-Based Access**: Admin and user roles with different permissions
6. **Dashboard**: Separate dashboards for admins and regular users

## Database Structure
- **Users**: Authentication and authorization
- **Students**: Student information (NIS, name, class, etc.)
- **SPP Bills**: Monthly tuition bills for students
- **Payments**: Payment records linked to bills
- **Roles/Permissions**: Spatie permissions system tables

## Environment Variables
Key environment variables include:
- Database connection settings
- Midtrans API keys
- SPP configuration (default amount, due day, generation time)