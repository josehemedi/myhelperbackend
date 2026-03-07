## My Helper Backend (Laravel API)

Backend API Laravel pour le formulaire de contact de **My Helper**.

- **Frontend (Vercel)**: `https://myhelper-platform01.vercel.app/`
- **CORS**: autorise `http://localhost:8080` et le domaine Vercel (configurable via `.env`)
- **Email**: envoi via SMTP (Gmail)
- **Endpoint**: `POST /api/contact`

### Prerequis

- PHP 8.2+
- Composer

### Installation (local)

1. Installer les dependances

```bash
composer install
```

2. Copier le fichier d'environnement

```bash
copy .env.example .env
php artisan key:generate
```

3. Configurer l'envoi d'email (Gmail SMTP) dans `.env`

- `MAIL_USERNAME=communityhelper02@gmail.com`
- `MAIL_PASSWORD="...mot de passe d'application Gmail..."`
- `MAIL_FROM_ADDRESS=communityhelper02@gmail.com`

4. Lancer le serveur

```bash
php artisan serve
```

### Tester l'API

Requete POST:

- URL: `http://127.0.0.1:8000/api/contact`
- Body JSON:

```json
{
  "nom": "siku",
  "email": "sikuemedi@gmail.com",
  "message": "je vais bien"
}
```

### CORS (prod + dev)

Dans `.env`:

```env
CORS_ALLOWED_ORIGINS=http://localhost:8080,https://myhelper-platform01.vercel.app
```

### Deploiement Render

Points importants pour eviter les erreurs `500` sur Render:

- Definir `APP_KEY` dans les variables d'environnement Render
- Definir `APP_URL` avec l'URL Render de l'API
- Si tu veux un vrai envoi email, definir un vrai `MAIL_PASSWORD` Gmail de type mot de passe d'application
- Si l'email n'est pas encore configure, laisser `MAIL_MAILER=log` pour eviter qu'un SMTP invalide fasse echouer la requete
- Garder `CACHE_STORE=file` tant que tu n'as pas configure une base ou Redis pour le cache

Le conteneur demarre maintenant avec le port fourni par Render via `PORT`.
