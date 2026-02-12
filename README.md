# Mystic Mall 🛍️

A premium, full-featured E-Commerce application built with **Laravel**. Mystic Mall offers a modern, high-end shopping experience with a robust admin dashboard for managing products, orders, and users.

## 🚀 Key Features

### 👤 User Side

- **Premium UI/UX:** Dark-themed, responsive design with smooth animations and glassmorphism effects.
- **Product Search:** Advanced full-screen search overlay for quick product discovery.
- **Wishlist System:** Save favorite products for later with a single click.
- **User Profile:** Manage personal details and secure password updates.
- **Smart Cart:** Real-time cart updates with AJAX and SweetAlert notifications.
- **Order Tracking:** Visual progress bar for tracking order status (Pending -> Processing -> Shipped -> Delivered).
- **Service Pages:** Dedicated pages for Support, Secure Payments, and Fast Delivery information.

### 🛠️ Admin Dashboard

- **Analytics:** Interactive Sales Charts, Revenue Cards, and Monthly Earnings stats.
- **Order Management:** View, update, and manage customer orders efficiently.
- **Product Management:** Add, edit, and delete products with image uploads.
- **Review Moderation:** Approve or delete user reviews to maintain quality.
- **User Management:** View registered users and their activities.

## 💻 Technology Stack

- **Backend:** Laravel Framework (PHP)
- **Frontend:** Blade Templates, Bootstrap 5, Custom CSS
- **Scripting:** jQuery, Vanilla JavaScript
- **Database:** MySQL
- **Libraries:**
    - _SweetAlert2_ (Notifications)
    - _Chart.js_ (Admin Analytics)
    - _FontAwesome_ (Icons)
    - _Animate.css_ (Animations)

## ⚙️ Installation Guide

Follow these steps to set up the project locally:

1.  **Clone the Repository**

    ```bash
    git clone https://github.com/huxi786/My-first-project-Mystic-mall.git
    cd mystic-mall-v2
    ```

2.  **Install Dependencies**

    ```bash
    composer install
    npm install
    ```

3.  **Environment Setup**
    - Copy `.env.example` to `.env`.
    - Update your database credentials (DB_DATABASE, DB_USERNAME, etc.).

4.  **Generate Key**

    ```bash
    php artisan key:generate
    ```

5.  **Run Migrations & Seeders**

    ```bash
    php artisan migrate --seed
    ```

    _This will create the database tables and populate them with dummy products and an admin account._

6.  **Serve the Application**
    ```bash
    php artisan serve
    ```
    Visit `http://127.0.0.1:8000` in your browser.

## 🔑 Admin Credentials (Default)

- **Email:** `admin@mysticmall.com`
- **Password:** `password`

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

---

_Developed by Huzaifa Ajmal_
