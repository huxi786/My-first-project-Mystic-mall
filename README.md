<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
    <h1 align="center">Mystic Mall E-Commerce</h1>
    <p align="center">A Premium, Modern E-Commerce Platform built with Laravel.</p>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

## 🛠️ Tech Stack Used

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
  <img src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap" />
  <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript" />
  <img src="https://img.shields.io/badge/Font_Awesome-339AF0?style=for-the-badge&logo=fontawesome&logoColor=white" alt="FontAwesome" />
</p>

---

## 📖 About The Project

**Mystic Mall** is a fully functional e-commerce application designed with a focus on **User Experience (UX)** and **Premium UI Design**. It leverages the power of the Laravel framework to provide a secure, scalable, and fast shopping experience.

### ✨ Key Features

* **Premium UI/UX:** Custom Glassmorphism design with Gold & Purple aesthetics.
* **User Authentication:** Secure Login and Registration system.
* **Product Management:** Browse, search, and view product details.
* **Interactive Contact Page:** Animated contact forms with map integration.
* **Responsive Design:** Fully optimized for Mobile, Tablet, and Desktop.
* **Admin Panel:** (Backend) Manage products, orders, and users.

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
    git clone [https://github.com/your-username/mystic-mall.git](https://github.com/your-username/mystic-mall.git)
    cd mystic-mall
    ```

2.  **Install PHP Dependencies**
    ```bash
    composer install
    ```

3.  **Setup Environment File**
    ```bash
    cp .env.example .env
    ```

4.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5.  **Configure Database**
    * Create a database in MySQL (e.g., `mystic_mall_db`).
    * Open `.env` file and update DB credentials:
        ```env
        DB_DATABASE=mystic_mall_db
        DB_USERNAME=root
        DB_PASSWORD=
        ```

6.  **Run Migrations & Seeders**
    ```bash
    php artisan migrate --seed
    ```

7.  **Start the Server**
    ```bash
    php artisan serve
    ```

    Visit `http://127.0.0.1:8000` in your browser.

---

## 🔐 Security & Credentials

For security reasons, **default admin credentials are not listed publicly**. 

* If you are a developer setting this up, please check the `DatabaseSeeder.php` file for default user creation logic.
* Or create a new user via the Registration page.

If you discover a security vulnerability within this project, please open an issue or contact the maintainer directly.

---

## 🤝 Contributing

Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1.  Fork the Project
2.  Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3.  Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4.  Push to the Branch (`git push origin feature/AmazingFeature`)
5.  Open a Pull Request

---

## 📄 License

Distributed under the MIT License. See `LICENSE` for more information.
<p><b>Mystic Mall</b></p>
<p>Developed by <strong>Huzaifa Ajmal</strong></p>
                                                                             <p>Copyright © 2025 Mystic Mall. All rights reserved.</p>
