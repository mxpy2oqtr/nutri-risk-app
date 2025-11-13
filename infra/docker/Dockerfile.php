# docker/Dockerfile.php
FROM php:8.3-fpm-alpine AS php-fpm

LABEL maintainer="NutriRisk Team"

# Instala dependencias + Nginx + Supervisor
RUN apk add --no-cache \
    nginx \
    supervisor \
    git curl zip unzip \
    libpng-dev libjpeg-turbo-dev freetype-dev \
    postgresql-dev oniguruma-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql mbstring exif pcntl bcmath

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear usuario no root
RUN addgroup -g 1000 appgroup && \
    adduser -u 1000 -G appgroup -s /bin/sh -D appuser

# Copia código
WORKDIR /var/www/html
COPY . .

# Laravel - ORDEN CORRECTO
RUN composer install --optimize-autoloader --no-dev --no-interaction \
    && cp .env.example .env 2>/dev/null || true \
    && php artisan key:generate --force \
    # PRIMERO: Crear archivo api.php si no existe
    && if [ ! -f routes/api.php ]; then \
        echo '<?php' > routes/api.php && \
        echo '' >> routes/api.php && \
        echo 'use Illuminate\Support\Facades\Route;' >> routes/api.php && \
        echo '' >> routes/api.php && \
        echo '// Rutas API aquí' >> routes/api.php; \
    fi \
    # LUEGO: Ejecutar migraciones (necesita api.php existente)
    && php artisan migrate --force \
    && chown -R appuser:appgroup /var/www/html \
    && chmod -R 755 storage bootstrap/cache

# Configs - ¡ANTES DE CAMBIAR DE USUARIO!
COPY nginx.conf /etc/nginx/http.d/default.conf
COPY supervisord.conf /etc/supervisord.conf

# Preparar Nginx para que se ejecute como no root (en la práctica)
# Aunque supervisor lo lanza como root, los workers correrán como 'appuser'
RUN sed -i 's/user nginx;/user appuser;/' /etc/nginx/nginx.conf \
    && mkdir -p /var/lib/nginx/tmp \
    && chown -R appuser:appgroup /var/lib/nginx /var/log/nginx /run/nginx

# Cambiar a usuario no root (si es necesario para otros comandos)
# USER appuser

EXPOSE 8000

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
