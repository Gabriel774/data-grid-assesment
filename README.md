# Curotec - Laravel & Vue Data Grid Assessment

A skill assessment project for the Laravel/Vue Full Stack Engineer role at Curotec. This application demonstrates a dynamic, interactive data grid built with Laravel, Vue 3, and Inertia.js. It features advanced filtering, sorting, and persistent data handling, showcasing two models: Movies and Users.

## Project Overview

This project provides:

* **Dynamic Data Grid**: Interactive data grids for Movies and Users with customizable filters, sorting, and persistent state management.
* **Easily Extensible Architecture**: A command-line artisan tool to generate repository and interface classes directly from your Laravel models, facilitating rapid development.
* **Cron Job and Queues**: Scheduled tasks automatically associating users with movies as either fans or haters, demonstrating job scheduling and asynchronous task handling.
* **Feature Testing with Pest**: Robust feature tests to ensure application reliability and correctness.

## Installation

Clone the repository and navigate into the project directory:

```bash
git clone https://github.com/Gabriel774/data-grid-assesment.git && cd data-grid-assesment
```

Start the application with Docker:

```bash
docker compose up -d --build
```

Access the application at:

* Frontend: [http://localhost:8000](http://localhost:8000)

## Docker Configuration

The project uses Docker with the following services:

* **Laravel App** (`laravel-app`): PHP 8.2-fpm with Node.js for frontend assets compilation, supervised cron and queues.
* **Nginx** (`nginx`): Web server configured for optimal Laravel handling.
* **PostgreSQL** (`postgres`): Database backend for persistence.

## Running Tests

Execute Pest feature tests using:

```bash
docker exec -it laravel-app bash
php artisan test --testdox
```

## Project Structure

* `src`: Application source code.
* `resources/js`: Vue components and frontend logic.
* `database`: Migration, seeders, and factory setups for data grids.
* `app/Console`: Artisan commands for generating repositories and interfaces.

## Additional Features

* **Persistent State**: Data grid configurations (filters, sorting, and pagination) persist through user sessions.
* **Scheduled Automation**: Cron-based job processing integrates seamlessly with Laravel queues.
* **Optimized Setup**: A comprehensive Dockerfile and entrypoint ensure rapid and consistent environment setup.

## Extending the Project

To create a new repository and interface structure for a Laravel model:

```bash
php artisan make:repository YourModel
```

This command will generate:

* `app/Repositories/Contracts/YourModelRepositoryInterface.php`: Interface with standard methods.
* `app/Repositories/Eloquent/YourModelRepository.php`: Implementation class extending `BaseRepository`.
