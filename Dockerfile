# --- Étape 1 : Dépendances PHP ---
    FROM composer:2 AS composer_deps
    WORKDIR /app
    COPY composer.json composer.lock ./
    RUN composer install --no-dev --no-interaction --no-plugins --no-scripts --prefer-dist --optimize-autoloader
    
    # --- Étape 2 : Frontend (Vite) ---
    FROM node:22-alpine AS frontend_build
    WORKDIR /app
    COPY package.json package-lock.json* ./
    RUN npm install
    COPY . . 
    RUN npm run build
    
    # --- Étape 3 : Application finale ---
    FROM php:8.4-cli-alpine AS app
    WORKDIR /var/www/html
    
    # Installation des dépendances système nécessaires
    RUN apk add --no-cache unzip libpq-dev
    
    # Copie du code source
    COPY . .
    
    # Copie des dossiers générés aux étapes précédentes
    COPY --from=composer_deps /app/vendor ./vendor
    COPY --from=frontend_build /app/public/build ./public/build
    
    # Gestion des permissions (Crucial pour Laravel)
    RUN addgroup -g 1000 app \
        && adduser -D -G app -u 1000 app \
        && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
        && chown -R app:app /var/www/html
    
    USER app
    
    # Render utilise souvent le port 10000 par défaut, mais 8000 fonctionne si configuré
    EXPOSE 8000
    
    # Commande de démarrage
    CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]