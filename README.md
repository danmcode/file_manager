## 🧭 Análisis inicial

**File Manager** es una aplicación web diseñada para gestionar usuarios, grupos, roles y archivos dentro de una organización.  
Su arquitectura se basa en una estructura modular, aprovechando la potencia de Laravel para la lógica del backend, PostgreSQL como base de datos relacional, y Docker para garantizar entornos reproducibles y consistentes.

El objetivo principal del proyecto es ofrecer una plataforma escalable y segura que permita:
- Controlar accesos mediante roles y permisos.
- Gestionar archivos con almacenamiento estructurado.
- Administrar grupos y usuarios desde una interfaz simple y eficiente.

---

## ⚙️ Tecnologías utilizadas y su justificación

### 🧱 **Laravel**
Laravel fue elegido por su robustez, escalabilidad y ecosistema.  
Ofrece un marco de trabajo limpio, moderno y seguro para el desarrollo backend, integrando herramientas potentes como:
- **Eloquent ORM:** facilita la interacción con la base de datos mediante modelos.
- **Migrations y Seeders:** permiten versionar y poblar la base de datos de forma controlada.
- **Blade Templates:** integran el frontend sin necesidad de frameworks adicionales.
- **Artisan CLI:** acelera el desarrollo con comandos automatizados.
- **Middleware y Policies:** simplifican la gestión de seguridad y roles.

En conjunto, Laravel permite desarrollar de forma ordenada, manteniendo el principio de *convención sobre configuración*.

---

### 🐘 **PostgreSQL**
PostgreSQL se eligió como motor de base de datos por su **fiabilidad, rendimiento y soporte de integridad referencial avanzada**.  
Entre sus ventajas destacan:
- Soporte completo para **transacciones ACID**.
- Tipos de datos avanzados y extensibilidad.
- Mejor manejo de relaciones complejas y consultas optimizadas.
- Gran estabilidad y comunidad activa.

Su combinación con Eloquent permite aprovechar las capacidades relacionales sin comprometer la portabilidad del código.

---

### 🐳 **Docker**
Docker garantiza que el entorno de desarrollo y producción sean **idénticos y reproducibles**.  
Con él se evita la clásica frase _“en mi máquina sí funciona”_.

El proyecto está dividido en contenedores:
- **app:** corre Laravel y PHP.
- **db:** instancia de PostgreSQL.
- **nginx:** servidor web que expone la aplicación.
  
Beneficios principales:
- Aislamiento de dependencias.
- Facilita despliegues y CI/CD.
- Escalabilidad horizontal (puede crecer sin conflictos de entorno).

---

## 🧩 Arquitectura general

La arquitectura se compone de tres capas principales:

```
[ Nginx ]  →  [ Laravel (PHP-FPM) ]  →  [ PostgreSQL ]
```

Cada contenedor se comunica por red interna de Docker, mientras que el frontend Blade interactúa directamente con las rutas definidas en Laravel.

---

## 🖼️ Interfaz

El sistema presenta una interfaz moderna construida con **Laravel Breeze + Blade**, ofreciendo autenticación, gestión de usuarios, grupos y archivos de forma visual e intuitiva.

---

## ⚙️ Instalación y despliegue

### 1️⃣ Clonar el repositorio

```bash
git clone https://github.com/danmcode/file_manager.git
cd file_manager
```

---

### 2️⃣ Copiar el archivo de entorno

```bash
cp .env.example .env
```

---

### 3️⃣ Configurar las variables de entorno

Edita el archivo `.env` y ajusta los valores de conexión a base de datos (ya preconfigurados para Docker):

```env
APP_NAME="File Manager"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=https://filemanager.local

DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=file_manager
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

---

### 4️⃣ Agregar el dominio local

Edita tu archivo `/etc/hosts` (o en Windows: `C:\Windows\System32\drivers\etc\hosts`) y agrega:

```bash
127.0.0.1   filemanager.local
```

---

### 5️⃣ Levantar los contenedores

```bash
docker compose up -d --build
```

---

### 6️⃣ Instalar dependencias

```bash
docker compose exec app composer install
docker compose exec app npm install
```

---

### 7️⃣ Generar la APP_KEY

```bash
docker compose exec app php artisan key:generate
```

---

### 8️⃣ Ejecutar migraciones y seeders

```bash
docker compose exec app php artisan migrate
docker compose exec app php artisan storage:link
docker compose exec app php artisan db:seed --class=RoleSeeder
docker compose exec app php artisan db:seed --class=GroupSeeder
docker compose exec app php artisan db:seed --class=AdminUserSeeder
docker compose exec app php artisan db:seed --class=BasicUserSeeder
```

---

### 9️⃣ Compilar assets (opcional)

- Para desarrollo:
  ```bash
  docker compose exec app npm run dev
  ```

- Para build de producción:
  ```bash
  docker compose exec app npm run build
  ```

---

### 🔗 Acceso a la aplicación

Abre en tu navegador:

👉 [https://filemanager.local/login](https://filemanager.local/login)

Si tu navegador advierte sobre el certificado, puedes continuar de forma segura (ya que es un entorno local).

---

## 🧾 Licencia

Este proyecto se distribuye bajo la licencia MIT.  
Consulta el archivo `LICENSE` para más información.

---
