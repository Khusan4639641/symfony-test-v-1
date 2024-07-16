# Symfony CRUD User API

Этот проект реализует API для выполнения CRUD операций над пользователями с использованием Symfony 6 и PHP 8.2. Проект использует Docker для упрощения настройки окружения.

## Требования

- Docker
- Docker Compose

## Установка

### 1. Клонируйте репозиторий

```bash
git clone https://github.com/yourusername/yourrepository.git
cd yourrepository


docker-compose up -d --build
docker-compose run --rm php composer install
docker-compose run --rm php composer require form twig-bundle security-csrf annotations

## Настройка параметров окружения

cp .env .env.local => DATABASE_URL="mysql://symfony:symfony@db:3306/symfony"

## Создание базы данных и выполнение миграций
docker-compose run --rm php bin/console doctrine:database:create
docker-compose run --rm php bin/console make:migration
docker-compose run --rm php bin/console doctrine:migrations:migrate

## Запуск сервера
docker-compose up -d
