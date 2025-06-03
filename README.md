# Acme Widget Co Sales System

## Overview
This is a proof-of-concept implementation of a sales basket system for Acme Widget Co, written in PHP. It follows SOLID principles, uses modern PHP standards, and is structured as a mini framework with dependency injection, service and strategy patterns.

## Setup
1. Clone the Repository
1. Install Docker and Docker Compose.
2. Run `docker-compose up -d` to start the container.
3. Run ```bash ./run-tests.sh``` to execute tests and static analysis.

## Usage
- Initialize the basket with products, delivery rules, and offers.
- Use the `addItem` method to add product codes.
- Call `total` to get the calculated total.

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
