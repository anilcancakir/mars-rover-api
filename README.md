# Mars Rover API

This project is simulating the Rover on Mars. 

## Requirements

- PHP v8+
- Composer v2+
- PHP Redis Extension
- Redis Client

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
```

## Configuration

You should configure your redis connection credentials in `.env` file.

```dotenv
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

## Run

You can use built-in PHP server for publishing & testing.

```bash
php artisan serve
```
