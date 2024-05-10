## Notification Service

Задача: Разработать систему уведомлений веб-приложения на Laravel с использованием RabbitMQ в качестве брокера сообщений.

Представим, что у нас очень много запросов к почтовому( и смс или любому другому сервису), он может часто отвечать ошибкой из-за перегрузки и мы не можем себе позволить ретраи на хитах.

Чтобы не блокировать основной поток работы приложения, необходимо реализовать отправку почтовых и смс сообщений с помощью rabbitMQ.

## Технологии

- Laravel 11
- Docker
- RabbitMQ
- JWT auth
- Supervisor
- Laravel Queues/Jobs

## Требования
- Docker
- Composer

## Разворачивание проекта

1. ```bash
    git clone <URL репозитория>
    ```

2. ```bash
    cd <название_проекта>
    ```

3. ```bash
    cp .env.example .env
    ```

4.  ```bash
    composer install
    ```
   
5. ```bash
   php artisan key:generate
    ```
   
6. ```bash
    ./vendor/bin/sail up -d
    ```

7. ```bash
    ./vendor/bin/sail artisan migrate --seed
    ```
