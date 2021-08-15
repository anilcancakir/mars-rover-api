# Mars Rover API
<a href="https://www.travis-ci.com/github/anilcancakir/mars-rover-api"><img src="https://api.travis-ci.com/anilcancakir/mars-rover-api.svg?branch=master" alt="Build Status"></a>
<a href="https://github.styleci.io/repos/396462191"><img src="https://github.styleci.io/repos/396462191/shield?style=flat&branch=master" alt="Coding Style Status"></a>

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
