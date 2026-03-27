# Prototype MVC

Lightweight MVC framework built on top of PHP League packages.

## Requirements

- PHP 8.2+

## Installation

```bash
composer install
```

## Development Server

```bash
php -S 0.0.0.0:1213 -t public
```

## Architecture

```
src/
├── AbstractController.php
├── Application.php
├── ControllerInterface.php
├── Controller/
│   └── HomeController.php
├── Http/
│   └── RequestHandler.php
├── Middleware/
│   ├── CorsMiddleware.php
│   └── JsonBodyParserMiddleware.php
├── Model/
│   ├── AbstractModel.php
│   └── ModelInterface.php
├── ServiceProvider.php
└── View/
    ├── PlatesView.php
    └── ViewInterface.php
```

## Components

- **Controller**: Handles HTTP requests
- **Model**: Data layer (abstract, implement as needed)
- **View**: Template rendering via Plates

## Available Commands

```bash
composer test      # Run PHPUnit tests
composer analyse   # Run PHPStan static analysis
```
