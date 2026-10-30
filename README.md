# AppSalon - Proyecto Web (Entrega Intermedia - Semana 11)

Sistema web desarrollado en PHP con el framework Laravel para la gestión de un salón de belleza y barbería, implementando el patrón arquitectónico MVC, autenticación de usuarios, control de accesos por roles y catálogo dinámico adaptado a pesos colombianos (COP).

## 🚀 Tecnologías Utilizadas
* **PHP** (Versión 8.2+)
* **Laravel** 11 / 12 (Framework MVC)
* **MySQL** (Vía XAMPP)
* **Bootstrap 5** (Diseño y componentes responsivos)
* **Blade** (Motor de plantillas)

## 📋 Funcionalidades Implementadas
1. **Módulo de Autenticación:** Registro de nuevos usuarios, inicio y cierre de sesión seguro con contraseñas cifradas mediante `bcrypt`.
2. **Control de Accesos por Roles:** Diferenciación automática entre Administrador (`admin = 1`) y Cliente (`admin = 0`) gestionada mediante variables de sesión.
3. **Catálogo de Servicios:** Visualización dinámica de los servicios disponibles en la base de datos, con precios formateados en pesos colombianos (COP) y tiempos de duración.

---

## ⚙️ Instrucciones de Instalación y Configuración

Sigue estos pasos para clonar y poner a marchar el proyecto en tu entorno local:

1. **Clonar el repositorio:**
   ```bash
   git clone  (https://github.com/AlexanderNexus/appsalon.git)
   cd appsalon


**Instalar las Dependencias de PHP:**
composer install

**Configurar el archivo del entorno:**
-- Duplica el archivo .env.example y renómbralo a .env.

-- Configura los datos de tu conexión a la base de datos en MySQL (XAMPP):
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=appsalon_mvc_php
DB_USERNAME=root
DB_PASSWORD=

**Generar la llave de la aplicación:**
php artisan key:generate

**Ejecutar migraciones y seeders (para cargar la base de datos):**
php artisan migrate:fresh --seed

**Levantar el servidor de desarrollo:**
php artisan serve

**Credenciales de Usuarios de Prueba**
Puedes utilizar las siguientes cuentas sembradas en la base de datos para probar los diferentes roles:

*Administrador:*

Correo: admin@appsalon.com

Contraseña: 123456

*Cliente:*

Correo: cliente@appsalon.com

Contraseña: 123456