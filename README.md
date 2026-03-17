# 🛍️ Mystic Mall v2

![Project Banner](https://capsule-render.vercel.app/api?type=waving&color=2e0249&height=300&section=header&text=Mystic%20Mall&fontSize=90&animation=fadeIn&fontAlignY=38&desc=Premium%20E-Commerce%20Solution&descAlignY=51&descAlign=50)

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
  <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
  <img src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap" />
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript" />
  <img src="https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white" alt="jQuery" />
</p>

---

## 📖 Overview

**Mystic Mall** is a state-of-the-art E-Commerce platform designed to provide a premium shopping experience. Built with the robust **Laravel** framework, it features a sleek, dark-themed UI, real-time interactions, and a comprehensive administration suite.

## ✨ Key Features

### 👤 For Customers

- **🎨 Premium UI/UX:** Immersive dark theme with glassmorphism effects, luxury "About Us" and "Contact Us" pages, and smooth animations.
- **🔍 Advanced Search:** Full-screen overlay search for instant product discovery.
- **❤️ Wishlist System:** Save products to your profile with a single click.
- **🛍️ Smart Cart:** Real-time updates, AJAX-powered actions, and instant feedback.
- **🚚 Order Tracking:** Visual progress bars to track orders from processing to delivery.
- **🔒 Secure Profile:** Manage personal information and security settings.

### 🛠️ For Admins

- **📊 Analytics Dashboard:** Interactive charts for sales, revenue, and user growth (Powered by Chart.js).
- **📦 Product Management:** Full CRUD operations for products with image galleries and professional pagination.
- **📝 Order Management:** Workflow to update order statuses and manage logic.
- **🌟 Review Moderation:** Control user feedback to maintain platform quality.
- **👥 User Control:** Monitor registered users and system activity.

---

## 💻 Tech Stack

| Category     | Technology                                                                                                                                                                                                                                                                                                                          |
| :----------- | :---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Backend**  | ![Laravel](https://img.shields.io/badge/-Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white) ![PHP](https://img.shields.io/badge/-PHP-777BB4?style=flat-square&logo=php&logoColor=white)                                                                                                                                 |
| **Frontend** | ![Bootstrap](https://img.shields.io/badge/-Bootstrap-563D7C?style=flat-square&logo=bootstrap&logoColor=white) ![JavaScript](https://img.shields.io/badge/-JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black) ![jQuery](https://img.shields.io/badge/-jQuery-0769AD?style=flat-square&logo=jquery&logoColor=white) |
| **Database** | ![MySQL](https://img.shields.io/badge/-MySQL-005C84?style=flat-square&logo=mysql&logoColor=white)                                                                                                                                                                                                                                   |
| **Tools**    | ![Composer](https://img.shields.io/badge/-Composer-885630?style=flat-square&logo=composer&logoColor=white) ![NPM](https://img.shields.io/badge/-NPM-CB3837?style=flat-square&logo=npm&logoColor=white)                                                                                                                              |

---

## 🚀 Getting Started

Follow these steps to set up the project locally on your machine.

### Prerequisites

* PHP >= 8.1
* Composer
* MySQL

### Installation

1.  **Clone the repository**
    ```bash
    git clone https://github.com/huxi786/My-first-project-Mystic-mall
    cd mystic-mall
    ```

2.  **Install PHP Dependencies**
    ```bash
    composer install
    ```

3.  **Environment Setup**
    - Duplicate `.env.example` and rename it to `.env`.
    - Configure your database credentials in the `.env` file.

4.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5.  **Database Migration & Seeding**
    ```bash
    php artisan migrate --seed
    ```
    *This creates necessary tables and populates the database with 15+ premium products.*

6.  **Start the Server**
    ```bash
    php artisan serve
    ```
    The application will be available at `http://127.0.0.1:8000`.

---

## 🔐 Security & Credentials

For security reasons, **default admin credentials are not listed publicly**. 

* If you are a developer setting this up, please check the `DatabaseSeeder.php` file for default user creation logic.
* Or create a new user via the Registration page.

---

## 🤝 Contributing

Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1.  Fork the Project
2.  Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3.  Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4.  Push to the Branch (`git push origin feature/AmazingFeature`)
5.  Open a Pull Request

---

<p align="center">
  Developed by <strong>Huzaifa Ajmal</strong>
</p>
<p align="center">Copyright © 2025 Mystic Mall. All rights reserved.</p>
