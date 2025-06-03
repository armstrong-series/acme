# Acme Widget Co Sales System

## Overview
This is a proof-of-concept implementation of a sales basket system for Acme Widget Co, written in PHP. It follows SOLID principles, uses modern PHP standards, and is structured as a mini framework with dependency injection, Service and Strategy patterns.

## Stack
1. Php >= 8.3
2. Docker
3. Docker-compose
## Setup
1. Clone the Repository
1. Install Docker and Docker Compose.
2. Run `docker-compose up -d` to start the container.
3. Run  to execute tests and static analysis.
```bash
./run-tests.sh
```

## Usage
- Initialize the basket with products, delivery rules, and offers.
- Use the `addItem` method to add product codes.
- Call `total` me to get the calculated total.

## Assumptions
- Product codes are unique identifiers.
- Delivery rules are applied in ascending order of threshold.
- The offer "buy one red widget, get the second half price" applies to pairs of R01.

## Directory Structure
- `src/`: Core application logic.
- `tests/`: Unit and integration tests.

## Testing
- Uses PHPUnit for Unit and Integration tests.
- PHPStan for static analysis.


## Resources
- [PhpStan](https://phpstan.org).
- [Neon](https://phpstan.org/config-reference#neon-format) 
- [PhpUnit](https://docs.phpunit.de/en/9.6/)
