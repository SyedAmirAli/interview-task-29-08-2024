# Interview Task - 29-08-2024

This project is a task completed for an interview, built using Laravel 10, Vite, and Vue 3. It is a web application that integrates a modern front-end with a robust back-end, demonstrating the ability to create and manage data efficiently.

## Table of Contents

-   [Installation](#installation)
-   [Configuration](#configuration)
-   [Database Migration & Seeding](#database-migration--seeding)
-   [Running the Application](#running-the-application)
-   [Additional Information](#additional-information)

## Installation

To get started with this project, follow these steps:

1. **Clone the Repository:**

    ```bash
    git clone https://github.com/SyedAmirAli/interview-task-29-08-2024.git
    cd interview-task-29-08-2024
    ```

2. **Install Composer Dependencies:**

    ```bash
    composer install
    ```

3. **Install NPM Dependencies:**

    ```bash
    npm install
    ```

4. **Environment Setup:**

    Create a `.env` file by copying the example file:

    ```bash
    cp .env.example .env
    ```

    Update the `.env` file with your database and other environment configurations.

5. **Generate Application Key:**

    ```bash
    php artisan key:generate
    ```

## Configuration

Before running the application, make sure to configure the following:

1. **Database Configuration:**

    Update the database settings in the `.env` file:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

2. **Vite Configuration:**

    Ensure that Vite is correctly configured to work with Vue 3 and Laravel. Vite settings should be updated in the `vite.config.js` file if necessary.

## Database Migration & Seeding

After setting up the environment, run the following commands to migrate the database and seed it with data:

1. **Run Migrations:**

    ```bash
    php artisan migrate
    ```

    > Note: Some migration and seeder files have been slightly modified. Ensure that these files are correctly set up before running the above commands. (you can ignore seeding)

## Running the Application

To serve the application locally, use the following commands:

1. **Start the Laravel Development Server:**

    ```bash
    php artisan serve
    ```

    The application will be available at `http://localhost:8000`.

2. **Run Vite for Front-End Compilation:**

    In a separate terminal, run:

    ```bash
    npm run dev
    ```

    This will start Vite and allow you to see front-end changes in real-time.

## Additional Information

-   **Laravel Version:** 10^
-   **Vue Version:** 3^
-   **Vite Version:** Latest compatible with Vue 3
-   **Node Version:** Ensure you're using a Node version compatible with Vue 3 and Vite.

For further assistance, please refer to the official Laravel, Vue 3, and Vite documentation.
