# 🎓 School Management System (Laravel)

A simple **Laravel-based School Management System** that allows **Admins** and **Teachers** to manage Students, Parents, and Announcements.

---

## 🚀 Features

### 👑 Admin

* Login securely to the system
* Manage **Teachers** (Add, Edit, Delete)
* Post **Announcements** for Teachers
* View all **Students**, **Parents**, and **Announcements** added by Teachers

### 👩‍🏫 Teacher

* Login to their own dashboard
* Manage **Students** and **Parents** (Add, Edit, Delete)
* Post **Announcements** for Students, Parents, or both
* Email notifications are sent automatically for announcements

---

## ⚙️ Installation Instructions

Follow these steps to set up the project locally.

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/your-username/school-management-laravel.git
cd school-management-laravel
```

### 2️⃣ Install Dependencies

```bash
composer install
```

### 3️⃣ Create Environment File

Copy the example environment file and update your local credentials.

```bash
cp .env.example .env
```

Update `.env` with your database details:

```env
DB_DATABASE=school_management
DB_USERNAME=root
DB_PASSWORD=1234
```

### 4️⃣ Generate Application Key

```bash
php artisan key:generate
```

### 5️⃣ Run Migrations and Seed Admin

```bash
php artisan migrate --seed
```

This will run the **AdminUserSeeder** automatically to create a default admin user.

---

## 👩‍💼 Default Admin Login (seeded via AdminUserSeeder)

| Field        | Value                                   |
| ------------ | --------------------------------------- |
| **Email**    | admin@test.com |
| **Password** | password                                |

---

## 🖥️ Running the Application

Start the local development server:

```bash
php artisan serve
```

Then open your browser and go to:

```
http://127.0.0.1:8000
```

---

## 🧩 Folder Structure Overview

```
app/
 ├── Http/
 │   ├── Controllers/
 │   │   ├── Admin/
 │   │   ├── Teacher/
 │   │   └── Auth/
 │   └── Middleware/
 ├── Models/
database/
 ├── migrations/
 ├── seeders/
resources/
 ├── views/
 └── css, js, etc.
routes/
 ├── web.php
```

---

## 🧪 Testing Login Credentials

### Admin:

* Email: `admin@test.com`
* Password: `password`

### Teachers, Students, Parents:

Can be added via Admin or Teacher dashboard.

---

## 🧰 Tech Stack

* **Laravel 11**
* **Blade Templates** for UI
* **MySQL** (or any other supported DB)
* **Bootstrap 5**
* **Mail Support** (for teacher announcements)

---

## 📄 License

This project is open-sourced under the [MIT License](https://opensource.org/licenses/MIT).

---

## 💡 Author

**Viram Solanki**
GitHub: [@viramsolanki3](https://github.com/viramsolanki3)
