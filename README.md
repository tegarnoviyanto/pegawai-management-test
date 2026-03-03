Pegawai Management System

A simple Employee Management System built with Laravel.

This project allows users to add and view employee data, including position, office, and CV upload with asynchronous file handling.

🚀 Features

Create new employee data

Display employee list

Relationship between Pegawai, Position, and Office

Asynchronous CV Upload (Drag & Drop)

Server-side validation

Seeder for dummy data

🛠 Tech Stack

PHP 8+

Laravel

MySQL

Bootstrap 5

jQuery

Dropzone.js

📦 Installation

Follow these steps to run the project locally:

git clone https://github.com/tegarnoviyanto/pegawai-management-test.git
cd pegawai-management-test
composer install
cp .env.example .env
php artisan key:generate

Setup database configuration inside .env, then run:

php artisan migrate --seed
php artisan storage:link
php artisan serve

Open in browser:

http://127.0.0.1:8000
📁 Project Structure

app/Models → Model definitions

app/Http/Controllers → Application logic

resources/views → Blade templates

database/migrations → Database schema

database/seeders → Dummy data

📌 Main Functionalities
Employee Management

Add new employee

View employee list

CV Upload

Drag & Drop file upload

Accept PDF, DOC, DOCX

Max file size: 2MB

🔒 Validation & Security

Server-side validation

File type restriction

File size limit

File storage handled using Laravel filesystem

📄 License

This project is open-sourced under the MIT License.

👤 Author

Tegar Noviyanto
GitHub: https://github.com/tegarnoviyanto
