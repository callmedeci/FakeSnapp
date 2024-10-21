# FakeSnapp 🚀

Snapp is a web application that provides an admin panel for managing customers and drivers. Built with Filament, this project allows admins to add, edit, and manage user data efficiently. All data is stored in a database, ensuring reliable data management.

## Features 🌟

-   Admin Panel: A user-friendly interface for admins to manage customers and drivers.
-   User Authentication: First-time users can create an account, followed by signing in to access the admin panel.
-   Database Integration: All user data is securely stored and managed in a database.
-   Responsive Design: Access the panel on any device with a mobile-friendly layout.

## Architecture 🏗️

This project follows the MVC architecture to maintain a clear separation of concerns and uses the Publisher-Subscriber pattern for efficient event handling.

## Technologies Used 🛠️

-   Frontend: HTML, CSS, JavaScript
-   Backend: PHP, Laravel
-   Admin Panel: Filament
-   Database: MySQL
-   Testing: PHPUnit

## Getting Started 🏁

### Prerequisites

-   [PHP](https://www.php.net/) (version >= 7.4)
-   [Composer](https://getcomposer.org/) for dependency management
-   [Node.js](https://nodejs.org/) (with npm) for frontend dependencies
-   MySQL or another compatible database

### Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/callmedeci/FakeSnapp.git
    cd snapp-fake
    ```
2. Install PHP dependencies:

    ```bash
    compoer install
    ```

3. Install Node.js dependencies:

    ```bash
    npm install
    ```

4. Set up your environment variables:

-   Copy .env.example to .env and update the necessary configurations:

    ```bash
    cp .env.example .env
    ```

5. Generate the application key:

    ```bash
    php artisan key:generate

    ```

6. Run database migrations:

    ```bash
    php artisan migrate
    ```

7. Start the development server:

    ```
    php artisan serve
    ```

## Usage

-   Open your browser and navigate to http://localhost:8000 to access the admin panel. First, create an account, then log in to manage customers and drivers.

## API Endpoints 📡

-   POST /api/register: Create a new account for users.
-   POST /api/login: Authenticate users and obtain access to the admin panel.
-   GET /api/customers: Retrieve all customers.
-   POST /api/drivers: Add a new driver to the database.

## Contributing 🤝

Contributions are welcome! If you find any bugs or have suggestions for improvements, feel free to create an issue or submit a pull request. Please follow the contribution guidelines if applicable.

## License 📜

This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgments 🙏

-   Laravel for the powerful framework.
-   Filament for the beautiful admin panel interface.
-   Special thanks to all contributors and mentors.
