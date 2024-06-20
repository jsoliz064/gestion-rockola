1. Copie el archivo .env.example a .env

```
    cp .env.example .env
```

2. Rellene los datos del .env

```
ASSET_URL=/public

MY_HOST=http://localhost:8000

JWT_KEY=
JWT_EXPIRATION_HOURS=

YOUTUBE_API_KEY=

DB_CONNECTION=mysql
DB_HOST=mysql-rockola
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=root
DB_PASSWORD=
```

3. Ejecute Contenedor de Base de datos

```
    docker-compose -f docker-compose-db.yml up -d
```

4. Ejecute Contenedor de Laravel

```
    docker-compose up -d
```

5. Ejecute Comandos Adicionales del Contenedor de Laravel

```
    composer install
    
    docker exec gestion-rockola chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

    docker exec gestion-rockola chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

    php artisan optimize
```
