# Information Management System (IMS)

## Project Overview
The Information Management System (IMS) is a Laravel-based web application designed to manage and track academic details for a college. It provides dedicated portals for Students, Faculty, and Administrators to facilitate profile management, achievement submissions, and verification workflows. 

## Features
- **Role-based Access Control:** Dedicated interfaces for `student`, `faculty`, and `admin` roles.
- **VS Code Theme Aesthetic:** A clean, developer-friendly UI with light and dark mode toggles mimicking the VS Code editor.
- **Student Portal:** Manage academic profiles (Branch, Year, Roll Number) and submit extracurricular achievements and certificates.
- **Faculty Portal:** Review, approve, or reject student achievement submissions with ease.
- **Admin Dashboard:** Centralized overview of college statistics and user management.
- **Modern Tech Stack:** Laravel 11, Tailwind CSS v4, Lucide Icons, and SQLite/MySQL support.

## Project Setup steps
1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   cd ims
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install NPM Dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Compile Frontend Assets**
   ```bash
   npm run dev
   ```
   *(Keep this running in a separate terminal window during development)*

7. **Start the Development Server**
   ```bash
   php artisan serve
   ```
   The application will be accessible at `http://127.0.0.1:8000`.

## Database Setup
1. Configure your database connection in the `.env` file. By default, it is configured to use SQLite:
   ```env
   DB_CONNECTION=sqlite
   ```

2. If using SQLite, create the database file (if it doesn't exist):
   ```bash
   touch database/database.sqlite
   ```

3. Run the database migrations and seeders:
   ```bash
   php artisan migrate:fresh --seed
   ```

## Login Credentials (default test accounts)
If you seeded the database using the command above, the following default test accounts are available:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | admin@fcrit.ac.in | password |
| **Faculty** | faculty@fcrit.ac.in | password |
| **Student** | student@fcrit.ac.in | password |

---
**Author:** Alison Pinto  
**Roll Number:** 5024148  
