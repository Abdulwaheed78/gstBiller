# gstBiller Laravel Software
GST Biller Project Overview
GST Biller is a comprehensive billing and invoicing software developed in Laravel, designed to manage GST-compliant invoices with a multi-role authentication system. The system features two main user roles: Admin and Vendor.

Admin Features:

Acts as a superuser with access to all vendors' data.
Can create, manage, and delete vendors.
Can view, create, edit, and delete bills generated by vendors.
Logs to track all actions performed by the admin and vendors.
Vendor Features:

Can log in to create, edit, and delete their invoices.
Can view and download invoices in PDF format.
Sends invoices directly to customers via email.
Logs to track vendor-specific actions.
The system ensures seamless invoice management with functionalities to send invoices via email, generate PDFs, and maintain activity logs for both roles.


#Steps to Download and Set Up GST Biller
Clone the Repository:
Clone the project from the version control system or download the ZIP file.
git clone <repository_url>
cd gstbiller
composer install

Setup Environment Variables:
Create a .env file by copying the .env.example file:
cp .env.example .env
Configure the database credentials and other environment settings in the .env file.

Generate Application Key:
Run the following command to generate the application key:
php artisan key:generate
Run Migrations and Seed Database:

Run the migrations to create database tables and seed the default admin user.
php artisan migrate
php artisan db:seed --class=UserSeeder

Default Admin Credentials:
Use the following credentials to log in as the admin:
Email: baba@gmail.com
Password: admin@12

Setup File Permissions:
Ensure the necessary permissions for Laravel storage and cache:
chmod -R 775 storage bootstrap/cache

make sure to link stprage first bu using below command 
php artisan storage:link

Run the Application:
Start the Laravel development server:
php artisan serve
The application will be accessible at http://127.0.0.1:8000.
