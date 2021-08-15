<h1 align="center" style="text-align: center; font-size: xxx-large; font-weight: bold;">
Mars Rover API
</h1>

<p align="center" style="text-align: center;">
<a href="https://travis-ci.org/anilcancakir/mars-rover-api"><img src="https://travis-ci.org/anilcancakir/mars-rover-api.svg" alt="Build Status"></a>
<a href="https://github.styleci.io/repos/396462191"><img src="https://github.styleci.io/repos/396462191/shield?style=flat&branch=master" alt="Coding Style Status"></a>
</p>

# About Project
This project is simulating the Rover on Mars. 

# Requirements

- PHP v8+
- Composer v2+
- PHP Redis Extension
- Redis Client

# Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
```

# Configuration

You should configure your redis connection credentials in `.env` file.

```dotenv
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

# Run

You can use built-in PHP server for publishing & testing.

```bash
php artisan serve
```
