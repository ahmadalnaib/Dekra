# DEKRA FAQ Web Application

This is a full-stack FAQ management web application built with **Laravel**, **Inertia.js**, **Vue.js**, and **MySQL**. It was developed as part of a coding challenge and showcases both frontend and backend development best practices.

## 🛠 Tech Stack

- Laravel (Latest version)
- Inertia.js
- Vue.js 3 with Composition API
- Tailwind CSS
- MySQL

## ✨ Features

- Admin panel to manage FAQs and Tags
- Visitor view with searchable FAQs and filters by tags/categories
- Role-based authentication (`Admin`, `Visitor`)
- Search with questions, answers, and tags
- Orderable questions within categories
- Responsive and accessible UI

---

## 🚀 Installation

```bash
git clone https://github.com/ahmadalnaib/Dekra
cd Dekra

## 1. Install dependencies
 
- composer install
- npm install && npm run build


## 2. Create .env file

- cp .env.example .env
- php artisan key:generate

Then, set your database credentials and other environment variables in .env.

## 3.Run migrations and seeders

- php artisan migrate db:seed

# This will create the tables and insert initial data for:

- Categories

- FAQs

- Admin user


# A default admin account is created:
- Email: admin@dekra.com
- Password: 123456789
