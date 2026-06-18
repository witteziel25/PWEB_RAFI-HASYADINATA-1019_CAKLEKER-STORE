# Cakleker Auction

Cakleker Auction is a web-based online auction platform specifically designed for Ferrari car collections. The system facilitates seamless interactions between sellers and buyers through a secure, real-time bidding mechanism.

## Features

*   **User Authentication and Authorization**
    *   Secure user registration and login system.
    *   Password reset mechanism utilizing OTP (One-Time Password) sent via email.
    *   Profile management including avatar uploads.
*   **Auction Management**
    *   Sellers can create new auctions with detailed specifications using a rich text editor (CKEditor).
    *   Support for multiple image uploads per auction, automatically optimized and converted to WebP format.
    *   Interactive map integration (Leaflet & OpenStreetMap) for precise Cash On Delivery (COD) location tagging.
    *   Ability to cancel auctions before any bids are placed.
*   **Bidding System**
    *   Real-time bid submission using asynchronous AJAX requests.
    *   Automatic validation to ensure bids exceed the current highest offer.
    *   Clear indication of the highest bidder and transaction history.
*   **Dashboards**
    *   **Public Dashboard**: Displays all active public auctions and the user's personal bidding history.
    *   **Personal Dashboard**: Allows users to manage their created auctions, track active listings, and review completed sales.
*   **User Interface**
    *   Responsive and modern design built with Bootstrap 5.
    *   Built-in Dark Mode and Light Mode toggle with local storage persistence.

## Technology Stack

*   **Backend Framework**: Laravel (PHP)
*   **Database**: MySQL
*   **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 5
*   **Image Processing**: Intervention Image (GD Driver)
*   **Rich Text Editor**: CKEditor 5
*   **Mapping Service**: Leaflet JS & Nominatim (OpenStreetMap)

## System Requirements

Ensure your server or local environment meets the following requirements:
*   PHP >= 8.1
*   Composer
*   MySQL or MariaDB
*   Node.js and NPM (optional, for frontend asset compilation)
*   GD PHP Extension (required for image processing)

## Installation Guide

Follow these steps to set up the project locally:

1.  **Clone the Repository**
    Clone the project into your local server directory (e.g., inside Laragon, XAMPP, or Valet).

2.  **Install Dependencies**
    Navigate to the project directory and run Composer to install PHP dependencies.
    ```bash
    composer install
    ```

3.  **Environment Configuration**
    Copy the example environment file and configure it according to your database setup.
    ```bash
    cp .env.example .env
    ```
    Open the `.env` file and update the database credentials:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=cakleker_auction
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    Also, configure your SMTP settings for the OTP email functionality to work properly.

4.  **Generate Application Key**
    Generate a secure application key for Laravel.
    ```bash
    php artisan key:generate
    ```

5.  **Run Database Migrations**
    Run the migrations to create the required tables in your database.
    ```bash
    php artisan migrate
    ```

6.  **Create Storage Link**
    Create a symbolic link to ensure uploaded images are publicly accessible.
    ```bash
    php artisan storage:link
    ```

7.  **Run the Application**
    Start the local development server.
    ```bash
    php artisan serve
    ```
    The application will be accessible at `http://localhost:8000`.

## Directory Structure Highlights

*   `app/Http/Controllers/`: Contains the application's business logic (e.g., `C_Lelang.php`, `C_Akun.php`, `C_Penawaran.php`).
*   `app/Models/`: Eloquent ORM models representing database tables.
*   `resources/views/`: Blade templates for the user interface.
*   `routes/web.php`: Defines the web routes and middleware protections.

## License

This project is proprietary and intended for specific deployment. Unauthorized copying or distribution of this codebase is prohibited.
