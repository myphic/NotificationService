## Notification Service


## Требования
- Docker

## Установка

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
