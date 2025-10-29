# Sembark Tech Assignment – Laravel 12

This repository contains the Laravel 12 application built as part of the **Sembark Tech Assignment**.  
The application demonstrates user management, invitation system, authentication, and email sending using **Mailtrap** for demo purposes.

---

## 🛠️ Tech Stack
- **Framework:** Laravel 12  
- **Language:** PHP 8+  
- **Database:** MySQL  
- **Mail Service:** Mailtrap (for demo invitation emails)  

---

## ⚙️ Installation & Setup

Follow the steps below to set up and run the project locally:

### 1. Clone the repository
```bash
git clone https://github.com/mohammadraquib/Sembark_Assignment.git
cd Sembark_Assignment
```

### 2. Install dependencies
```bash
composer install
npm install && npm run build
```

### 3. Configure environment
Copy the example environment file and update the required values:
```bash
cp .env.example .env
```
Then update the following in your `.env` file:
```env
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
```

### 4. Generate application key
```bash
php artisan key:generate
```

### 5. Run migrations
```bash
php artisan migrate
```

### 6. Seed default SuperAdmin user
```bash
php artisan db:seed --class=UserSeeder
```
This will create a default SuperAdmin user with the following credentials:
```
Email: superadmin@domain.com
Password: pass@2025
```

### 7. Install Node modules and build assets
```bash
npm install
npm run build
```

### 8. Start the development server
```bash
php artisan serve
```
By default, the application will be available at:
```
http://127.0.0.1:8000
```

---

## 📧 Email Invitation Demo
The app uses **Mailtrap** to send invitation emails for demo purposes.  
To test email functionality:
- Configure your Mailtrap credentials in `.env`.
- Trigger an invitation — an email will appear in your Mailtrap inbox.

---

---

## 🧪 Running Tests
The application includes tests for key functionalities.
You can run all tests using Laravel’s built-in test runner:
```bash
php artisan test
```

---

## 🧑‍💻 Default Roles
- **SuperAdmin:** Full access to user and invitation management.  
- **Admin:** Can create short urls and invite users as Admin or Member
- **Member:** Can create short urls

---

## 🧩 Useful Artisan Commands
| Command | Description |
|----------|-------------|
| `php artisan migrate:fresh --seed` | Rebuilds database and seeds default data |
| `php artisan route:list` | Shows all registered routes |
| `php artisan tinker` | Opens an interactive shell |

---

## 🚀 Features Implemented
- Laravel 12 Authentication System  
- Role-based access control (SuperAdmin, Admin, Member)  
- Invitation Flow using Mailtrap
- Short URL generator
- Download as CSV based on time range

---

## 🧾 License
This project is developed as part of an assignment for **Sembark Tech** and is intended for demonstration purposes only.

---

## ⚠️ Note on AI Usage
No AI tools were used in the development or coding of this project.  
Only **ChatGPT*** was used **exclusively** for generating this `README.md` file and the **HTML email view template**.
All backend logic, routes, migrations, and implementation were completely written and tested manually.

---

**Developed by:** Mohammad Raquib Qaisar
**Date:** 29 October 2025  
**Email:** mohdraquib26@gmail.com
