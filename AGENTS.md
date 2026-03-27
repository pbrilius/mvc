# Agent Guidelines for prototype.in/mvc

This is a lightweight PHP MVC framework built on top of the PHP League ecosystem.

## Build / Lint / Test Commands

### Run all tests
```bash
composer test
# or
vendor/bin/phpunit
```

### Run a single test class
```bash
vendor/bin/phpunit tests/Unit/ApplicationTest.php
```

### Run a single test method
```bash
vendor/bin/phpunit --filter testCreateReturnsDataWithId
```

### Run tests matching a pattern
```bash
vendor/bin/phpunit --filter AbstractModel
```

### Static analysis (PHPStan level 6)
```bash
composer analyse
# or
vendor/bin/phpstan analyse
```

Note: PHPStan runs against `src/` only. Tests are excluded from analysis.

### Dependencies
```bash
composer install
```

## Code Style Guidelines

### General
- Every PHP file MUST start with `<?php` on the first line (no blank lines before).
- Every PHP file MUST include `declare(strict_types=1);` immediately after the opening PHP tag.
- No comments in code unless the user explicitly requests them.

### Namespaces
- `Prototype\Mvc\` is the root namespace.
- Namespace directories match class names exactly (e.g. `src/Controller/` contains `namespace Prototype\Mvc\Controller;`).
- Test namespaces mirror source: `Prototype\Mvc\Tests\Unit\`.

### Naming Conventions
| Element         | Convention       | Examples                                    |
|-----------------|------------------|---------------------------------------------|
| Classes         | PascalCase       | `AbstractController`, `HomeController`      |
| Interfaces      | PascalCase + I suffix | `ModelInterface`, `ViewInterface`      |
| Abstract classes | PascalCase + Abstract prefix | `AbstractModel` |
| Methods         | camelCase        | `findById`, `setLayout`                     |
| Properties      | camelCase        | `$storage`, `$lastId`                       |
| Constants       | UPPER_SNAKE_CASE |                                             |
| Test classes    | PascalCase       | `ApplicationTest`, `AbstractModelTest`      |
| Test methods    | camelCase with test prefix | `testCreateReturnsDataWithId` |

### Imports
- Use fully qualified class names for `use` statements.
- Group imports: external packages first, then internal namespaces.
- No aliases unless strictly necessary.
- Import order: alphabetical within each group.

Example:
```php
use Laminas\Diactoros\Response\JsonResponse;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Prototype\Mvc\View\ViewInterface;
```

### Types
- Always use strict type declarations (already enforced by `declare(strict_types=1)`).
- Use union types (e.g. `int|string`) where appropriate.
- Use `mixed` for parameters that accept any type.
- Nullable types: `?string` or `?Type`, not `Type|null` (unless using PHP 8.1+ syntax explicitly).
- Return types are mandatory on public and protected methods.

### Error Handling
- Methods that can fail return `null`, `false`, or an empty `array` — they do NOT throw exceptions.
- Example:
  ```php
  public function findById(int|string $id): ?array
  {
      return $this->storage[(string) $id] ?? null;
  }
  ```
- Use guard clauses for early returns on invalid state.

### Architecture

```
src/
├── Application.php           # Entry point, DI container + router config
├── AbstractController.php    # Base controller with render/json helpers
├── ControllerInterface.php   # Contract for controllers
├── Controller/
│   └── HomeController.php     # Concrete controllers extend AbstractController
├── Model/
│   ├── AbstractModel.php      # In-memory CRUD model
│   └── ModelInterface.php
├── View/
│   ├── PlatesView.php         # League Plates template engine wrapper
│   └── ViewInterface.php
└── Middleware/
    ├── CorsMiddleware.php
    └── JsonBodyParserMiddleware.php

tests/
└── Unit/
    ├── ApplicationTest.php
    └── AbstractModelTest.php
```

### Patterns
- **Controllers**: Extend `AbstractController`, implement `ControllerInterface`. Use `render($template, $data)` or `json($data, $statusCode)`.
- **Models**: Extend `AbstractModel`, implement `ModelInterface`. Return `null`/`false` on failure.
- **Middleware**: Implement `Psr\Http\Server\MiddlewareInterface` with `process()`.
- **Dependencies**: Injected via setters (e.g. `setView()`), not constructor injection.

### Configuration Files
| File            | Purpose                                      |
|-----------------|----------------------------------------------|
| `phpstan.neon`  | Static analysis config (level 6, src only)   |
| `phpunit.xml`   | Test suite config, bootstrap, source include |
| `.phpactor.json`| IDE integration (PHPStan language server)     |
| `composer.json` | Autoloading, scripts, dependencies           |

### PHP Version
- Minimum: **PHP 8.2**
- Features from 8.2+ may be used freely (first-class callable syntax, enum-backed enums, etc.).
