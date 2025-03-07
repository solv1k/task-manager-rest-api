## О проекте

Rest API для системы управления задачами.

Разработано на основе PHP-фреймворка [Laravel 11](https://laravel.com/docs/11.x).

## Установка

Для установки нужно склонировать содержимое этого репозитория к себе в папку, используя Git:
```
git clone git@github.com:solv1k/task-manager-rest-api.git
```

После клонирования нужно установить все необходимые зависимости с помощью Composer, выполнив команду из папки с проектом:
```
composer install
```

## Запуск

### Первый запуск

Перед первым запуском приложения необходимо в корневой папке проекта создать конфигурационный файл с именем `.env` и скопировать в него содержимое файла `.env.example`.

Для быстрого копирования рекомендуется использовать команду:
```
cp .env.example .env
```

### Запуск c помощью Sail

Для быстрого поднятия приложения рекомендуется использовать [Sail](https://github.com/laravel/sail).

Перед использованием Sail убедитесь в том, что у вас установлен [Docker](https://www.docker.com) с расширением [Docker Compose](https://docs.docker.com/compose).

Выполните команду в терминале из папки с проектом:
```
./vendor/bin/sail up -d
```

### Запуск c помощью LAMP-сервера

Если вы предпочитаете использовать локальный LAMP-сервер, тогда просто укажите необходимые данные для подключения к базе данных в файле конфигурации `.env`, который находится в корневой папке проекта.

## Миграции базы данных

### Важно
Если приложение запущено с помощью Sail, то команду для запуска миграций необходимо выполнять в терминале запущенного docker-контейнера.

### Запуск миграций

Для запуска миграций используйте команду:
```
php artisan migrate
```

## Создание администратора

```
php artisan app:create-admin Admin super@admin.com Password123!
```

## Вспомогательные пакеты

- [Sail](https://github.com/laravel/sail)
- [Sanctum](https://github.com/laravel/sanctum)
- [Pint](https://github.com/laravel/pint)

## Лицензия

Это программное обеспечение с открытым исходным кодом.
