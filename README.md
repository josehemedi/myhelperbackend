## My Helper Backend (Laravel API)

Backend API Laravel pour le formulaire de contact de **My Helper**.

- **Frontend (Vercel)**: `https://myhelper-platform01.vercel.app/`
- **CORS**: autorise `http://localhost:8080` et le domaine Vercel (configurable via `.env`)
- **Email**: envoi via SMTP (Gmail)
- **Endpoint**: `POST /api/contact`

### Prérequis

- PHP 8.2+
- Composer

### Installation (local)

1) Installer les dépendances

```bash
composer install
```

2) Copier le fichier d’environnement

```bash
copy .env.example .env
php artisan key:generate
```

3) Configurer l’envoi d’email (Gmail SMTP) dans `.env`

- `MAIL_USERNAME=communityhelper02@gmail.com`
- `MAIL_PASSWORD="...mot de passe d’application Gmail..."`
- `MAIL_FROM_ADDRESS=communityhelper02@gmail.com`

4) Lancer le serveur

```bash
php artisan serve
```

### Tester l’API

Requête POST:

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

### Performance (Queue / Jobs)

Le mail est « queueable ». Pour un vrai envoi en arrière‑plan en production:

- Mets `QUEUE_CONNECTION=database` (ou `redis`) dans `.env`
- Lance un worker:

```bash
php artisan queue:work
```
