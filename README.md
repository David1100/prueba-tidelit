#  Symfony 6

Este backend está desarrollado en Symfony y expone endpoints para gestionar libros y reseñas.
Funciona como API para un frontend hecho en Vue 3 + Vite

## 🚀 Tecnologías Utilizadas

PHP 8.2+

Symfony 6.x / 7.x

Doctrine ORM

MySQL / MariaDB

Composer

CORS habilitado (NelmioCorsBundle opcional)

📦 Instalación

1️⃣ Clonar el repositorio

git clone https://github.com/usuario/tu-backend-symfony.git
cd tu-backend-symfony

2️⃣ Instalar dependencias

composer install

🔧 Configuración del entorno

Copia el archivo .env

cp .env

Edita tu conexión a la base de datos en .env

DATABASE_URL="mysql://root:@127.0.0.1:3306/prueba_tidelit?serverVersion=10.4.32-MariaDB&charset=utf8mb4"

🗄️ Migraciones y Base de Datos

php bin/console doctrine:database:create

Ejecutar migraciones:

php bin/console doctrine:migrations:migrate

▶️ Iniciar el Servidor

symfony server:start

Tu API estará disponible en:

http://127.0.0.1:8000

🌐 Endpoints disponibles

✔️ Obtener todos los libros

GET /api/books
<img width="1377" height="831" alt="image" src="https://github.com/user-attachments/assets/6908f8ad-8040-41e2-8f83-ad4f4d699aff" />

[
    {
        "id": 2,
        "title": "El Arte de Programar",
        "author": "Donald Knuth",
        "published_year": 1968,
        "average_rating": "2.0000"
    },
    {
        "id": 3,
        "title": "Clean Code",
        "author": "Robert C. Martin",
        "published_year": 2008,
        "average_rating": "3.0000"
    },
    {
        "id": 4,
        "title": "Refactoring",
        "author": "Martin Fowler",
        "published_year": 1999,
        "average_rating": "5.0000"
    }
]



✔️ Crear las reseñas

POST /api/review

body - JSON
{
  "book_id": 1,
  "rating": 5,
  "comment": "Excelente libro!"
}

🔐 CORS (Requerido para Vue 3 + Vite)

composer require nelmio/cors-bundle

Configura en config/packages/nelmio_cors.yaml:

nelmio_cors:
  defaults:
    allow_origin: ['http://localhost:5173']
    allow_methods: ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS']
    allow_headers: ['Content-Type']
    max_age: 3600
  paths:
    '^/api/':
        allow_origin: ['*']
        allow_headers: ['*']
        allow_methods: ['*']

🧪 Probar API con Postman

GET http://127.0.0.1:8000/api/books

Solo se valida la rama main y el primer commit "Initial commit - Symfony backend"
