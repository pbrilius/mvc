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
├── Application.php           # Entry point, DI container + router config
├── AbstractController.php    # Base controller with render/json helpers
├── ControllerInterface.php   # Contract for controllers
├── Controller/
│   └── HomeController.php     # Concrete controllers extend AbstractController
├── Http/
│   └── RequestHandler.php     # Handles PSR-7 request/response operations
├── Model/
│   ├── AbstractModel.php      # In-memory CRUD model
│   └── ModelInterface.php
├── ServiceProvider.php        # Dependency injection container configuration
└── View/
    ├── PlatesView.php         # League Plates template engine wrapper
    └── ViewInterface.php
```

## Components

- **Controller**: Handles HTTP requests
- **Model**: Data layer (abstract, implement as needed)
- **View**: Template rendering via Plates
- **ServiceProvider**: Configures dependency injection container
- **RequestHandler**: PSR-7 request/response handling utilities

## Available Commands

```bash
composer test      # Run PHPUnit tests
composer analyse   # Run PHPStan static analysis
```

## Testing

Run all tests:
```bash
composer test
```

Run a single test class:
```bash
vendor/bin/phpunit tests/Unit/ApplicationTest.php
```

Run a single test method:
```bash
vendor/bin/phpunit --filter testCreateReturnsDataWithId
```

Run tests matching a pattern:
```bash
vendor/bin/phpunit --filter AbstractModel
```

## Static Analysis

Run PHPStan (level 6):
```bash
composer analyse
# or
vendor/bin/phpstan analyse
```

Note: PHPStan runs against `src/` only. Tests are excluded from analysis.

For detailed coding standards, architecture patterns, and development guidelines, refer to [AGENTS.md](AGENTS.md).