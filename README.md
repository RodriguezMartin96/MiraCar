Aquí tienes el código completo del archivo README.md:

```markdown
# MiraCar

<div align="center">
  <img src="galeria/logo.png" alt="MiraCar Logo" width="300" height="400" />
  <h1>🚗 MiraCar</h1>
  <p>Conectando talleres y clientes para una experiencia automotriz moderna, clara y eficiente.</p>

  <div>
    <a href="#sobre-miracar">¿Qué es MiraCar?</a>
    •
    <a href="#tecnologías-utilizadas">Tecnologías</a>
    •
    <a href="#instalación">Instalación</a>
    •
    <a href="#guía-xampp">Guía XAMPP</a>
    •
    <a href="#capturas-de-pantalla">Capturas</a>
    •
    <a href="#uso">Uso</a>
    •
    <a href="#estructura-del-proyecto">Estructura</a>
  </div>

  <div>
    <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP Badge" />
    <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel Badge" />
    <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL Badge" />
    <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap Badge" />
    <img src="https://img.shields.io/badge/XAMPP-EF5B25?style=for-the-badge&logo=xampp&logoColor=white" alt="XAMPP Badge" />
    <img src="https://img.shields.io/badge/Node.js-18.x-339933?style=for-the-badge&logo=node.js&logoColor=white" alt="Node.js Badge" />
    <img src="https://img.shields.io/badge/Composer-2.x-885630?style=for-the-badge&logo=composer&logoColor=white" alt="Composer Badge" />
    <img src="https://img.shields.io/badge/Git-F05032?style=for-the-badge&logo=git&logoColor=white" alt="Git Badge" />
  </div>
</div>

---

## ❓ ¿Qué es MiraCar? <a name="sobre-miracar"></a>

**MiraCar** es una aplicación web multiplataforma que conecta talleres automotrices con sus clientes, mejorando la comunicación, la gestión de reparaciones y la trazabilidad del historial de vehículos.

El sistema está diseñado para ser intuitivo, responsivo y adaptable a cualquier dispositivo (móvil, tablet, escritorio). Se orienta tanto a **talleres** que necesitan gestionar siniestros, clientes y documentación, como a **usuarios** que desean hacer seguimiento en tiempo real de sus vehículos.

---

## 🛠 Tecnologías Utilizadas <a name="tecnologías-utilizadas"></a>

El proyecto fue desarrollado con las siguientes herramientas:

| Herramienta | Propósito |
|-------------|-----------|
| **Laravel 10** | Framework backend (PHP) |
| **PHP 8.2** | Lenguaje del servidor |
| **MySQL** | Base de datos relacional |
| **XAMPP** | Entorno local (Apache + MySQL + PHP) |
| **Composer** | Gestión de dependencias PHP |
| **Node.js & npm** | Gestión frontend, assets, dependencias JS |
| **Bootstrap 5.3** | Framework CSS responsivo |
| **Git** | Control de versiones |
| **Visual Studio Code** | Editor de código recomendado |

Compatible con **Windows, macOS y Linux**.

---

## ⚙️ Instalación <a name="instalación"></a>

### Requisitos Previos

- PHP 8.1+
- MySQL 5.7+
- Node.js + npm
- Composer
- Git
- XAMPP o similar

### Pasos

```bash
# Clonar el proyecto
git clone https://github.com/tuusuario/miracar.git
cd miracar

# Instalar dependencias backend
composer install

# Instalar dependencias frontend
npm install && npm run build

# Crear base de datos y configurar .env
cp .env.example .env
php artisan key:generate
php artisan migrate --seed

# Iniciar servidor local
php artisan serve
```

---

## 📚 Guía Completa de Instalación y Configuración de XAMPP con Laravel `<a name="guía-xampp">``</a>`

### Índice

1. [Instalación de XAMPP](#instalación-de-xampp)
2. [Solución de Problemas Comunes](#solución-de-problemas-comunes)
3. [Restauración de un Proyecto Laravel](#restauración-de-un-proyecto-laravel)
4. [Configuración del Entorno Laravel](#configuración-del-entorno-laravel)
5. [Solución de Problemas Específicos](#solución-de-problemas-específicos)


### Instalación de XAMPP `<a name="instalación-de-xampp">``</a>`

#### Paso 1: Descargar la última versión de XAMPP

1. **Visita el sitio oficial de XAMPP**:

1. Abre tu navegador y ve a [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html)



2. **Selecciona la versión para Windows**:

1. Elige la versión más reciente para Windows
2. Haz clic en el botón de descarga



3. **Guarda el archivo de instalación**:

1. Selecciona una ubicación fácil de encontrar, como tu Escritorio





#### Paso 2: Instalar XAMPP

1. **Ejecuta el instalador**:

1. Localiza el archivo descargado (normalmente `xampp-windows-x64-X.X.X-X-installer.exe`)
2. Haz clic derecho y selecciona "Ejecutar como administrador"



2. **Si aparece una advertencia de seguridad**:

1. Haz clic en "Sí" para permitir que el programa realice cambios



3. **Sigue el asistente de instalación**:

1. Haz clic en "Next" (Siguiente)
2. En la pantalla de selección de componentes, asegúrate de que estén marcados al menos:

1. Apache
2. MySQL
3. PHP
4. phpMyAdmin



3. Haz clic en "Next"



4. **Selecciona la carpeta de instalación**:

1. La ubicación predeterminada es `C:\xampp`
2. Puedes cambiarla si lo deseas, pero recuerda la nueva ubicación
3. Haz clic en "Next"



5. **Selección de idioma y otras opciones**:

1. Selecciona tu idioma preferido
2. Desmarca la opción "Learn more about Bitnami" si no te interesa
3. Haz clic en "Next"



6. **Inicia la instalación**:

1. Haz clic en "Next" para comenzar la instalación
2. Espera a que se complete el proceso (puede tardar varios minutos)



7. **Finaliza la instalación**:

1. Cuando se complete, marca la casilla "Start Control Panel now"
2. Haz clic en "Finish"





#### Paso 3: Configurar XAMPP después de la instalación

1. **Configura el panel de control**:

1. En el panel de control de XAMPP, haz clic en "Config" (arriba a la derecha)
2. Selecciona las opciones según tus preferencias



2. **Inicia los servicios necesarios**:

1. Haz clic en "Start" junto a Apache
2. Haz clic en "Start" junto a MySQL
3. Verifica que ambos servicios muestren la luz verde



3. **Verifica la instalación**:

1. Abre tu navegador
2. Navega a `http://localhost`
3. Deberías ver la página de bienvenida de XAMPP



4. **Configura la seguridad**:

1. Haz clic en "Security" en la página de bienvenida
2. Sigue las recomendaciones para asegurar tu instalación
3. Establece contraseñas para MySQL y phpMyAdmin





#### Paso 4: Restaurar tus datos (si es necesario)

1. **Restaura tus bases de datos**:

1. Copia las carpetas de bases de datos desde `C:\XAMPP_Backup\databases`
2. Pégalas en `C:\xampp\mysql\data`



2. **Restaura tus proyectos web**:

1. Copia las carpetas de proyectos desde `C:\XAMPP_Backup\htdocs`
2. Pégalas en `C:\xampp\htdocs`



3. **Restaura configuraciones personalizadas** (si es necesario):

1. Revisa tus configuraciones personalizadas en `C:\XAMPP_Backup\config`
2. Aplica los cambios necesarios a los nuevos archivos de configuración
3. **No sobrescribas** directamente los archivos, mejor aplica los cambios manualmente





### Solución de Problemas Comunes `<a name="solución-de-problemas-comunes">``</a>`

#### Si MySQL no inicia:

1. **Verifica los puertos**:

1. Asegúrate de que el puerto 3306 no esté siendo usado por otro programa
2. Puedes cambiar el puerto en `C:\xampp\mysql\bin\my.ini`



2. **Verifica los archivos de datos**:

1. Si restauraste bases de datos, puede haber conflictos
2. Intenta iniciar MySQL sin las bases de datos restauradas





#### Si Apache no inicia:

1. **Verifica los puertos**:

1. Asegúrate de que los puertos 80 y 443 no estén siendo usados
2. Puedes cambiar los puertos en `C:\xampp\apache\conf\httpd.conf`



2. **Verifica la configuración**:

1. Revisa `C:\xampp\apache\conf\httpd.conf` en busca de errores
2. Revisa los logs en `C:\xampp\apache\logs`





#### Solución para el mensaje "La carpeta seleccionada no está vacía"

##### Opción 1: Eliminar completamente la carpeta existente

1. **Cierra el instalador de XAMPP**
2. **Asegúrate de tener una copia de seguridad de tus datos importantes**
3. **Elimina la carpeta de XAMPP existente**:

1. Navega a la ubicación de XAMPP (normalmente `C:\xampp`)
2. Haz clic derecho en la carpeta y selecciona "Eliminar"



4. **Ejecuta el instalador nuevamente**


##### Opción 2: Instalar en una ubicación diferente

1. **Cierra el instalador de XAMPP**
2. **Ejecuta el instalador nuevamente**
3. **Cuando llegues a la pantalla de selección de ubicación**:

1. Elige una ubicación diferente, por ejemplo:

1. `C:\xampp2`
2. `D:\xampp`
3. `C:\Programas\xampp`






4. **Completa la instalación normalmente**


### Restauración de un Proyecto Laravel `<a name="restauración-de-un-proyecto-laravel">``</a>`

#### Paso 1: Restaurar el código fuente del proyecto

1. **Localiza la copia de seguridad** de tu proyecto Laravel
2. **Copia la carpeta del proyecto** a la nueva instalación:

1. Copia toda la carpeta de tu proyecto (por ejemplo, `miracar`)
2. Pégala en `C:\xampp\htdocs\`



3. **Configura los permisos correctos** para las carpetas que requieren escritura:

1. `C:\xampp\htdocs\laravel\miracar\storage`
2. `C:\xampp\htdocs\laravel\miracar\bootstrap\cache`





#### Paso 2: Restaurar la base de datos

1. **Inicia los servicios de XAMPP**
2. **Restaurar desde archivos de datos**:

1. Detén el servicio MySQL en el panel de control de XAMPP
2. Copia la carpeta de la base de datos
3. Pégala en `C:\xampp\mysql\data\`
4. Inicia el servicio MySQL nuevamente



3. **Restaurar desde un archivo SQL** (si tienes un dump):

1. Abre phpMyAdmin (`http://localhost/phpmyadmin`)
2. Crea una nueva base de datos
3. Importa el archivo SQL





### Configuración del Entorno Laravel `<a name="configuración-del-entorno-laravel">``</a>`

#### Paso 1: Verificar el archivo .env

1. **Verifica que el archivo .env exista**:

1. Si no existe, crea uno copiando `.env.example`:





```shellscript
copy .env.example .env
```

2. **Edita el archivo .env** para que coincida con tu nueva configuración:


```plaintext
APP_URL=http://miracar.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=miracar
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
CACHE_DRIVER=file
```

#### Paso 2: Instalar dependencias y regenerar la clave

1. **Verifica si Composer está instalado**:


```shellscript
composer --version
```

2. **Instala las dependencias del proyecto**:


```shellscript
cd C:\xampp\htdocs\laravel\MiraCar
composer install
```

3. **Genera una nueva clave de aplicación**:


```shellscript
php artisan key:generate
```

4. **Limpia cachés**:


```shellscript
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

#### Paso 3: Configurar hosts virtuales

1. **Edita el archivo hosts**:

1. Abre `C:\Windows\System32\drivers\etc\hosts` como administrador
2. Agrega estas líneas:





```plaintext
127.0.0.1 miracar.com
127.0.0.1 www.miracar.com
```

2. **Configura el host virtual en Apache**:

1. Abre `C:\xampp\apache\conf\extra\httpd-vhosts.conf`
2. Agrega esta configuración:





```plaintext
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/laravel/miracar/public"
    ServerName miracar.com
    ServerAlias www.miracar.com
    <Directory "C:/xampp/htdocs/laravel/miracar/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    ErrorLog "logs/miracar.com-error.log"
    CustomLog "logs/miracar.com-access.log" combined
</VirtualHost>

# Configuración para acceder a través de IP/miracar
Alias "/miracar" "C:/xampp/htdocs/laravel/miracar/public"
<Directory "C:/xampp/htdocs/laravel/miracar/public">
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>
```

3. **Reinicia Apache**


### Solución de Problemas Específicos `<a name="solución-de-problemas-específicos">``</a>`

#### Recrear el archivo .env sin copia de seguridad

1. **Crea un nuevo archivo .env a partir del ejemplo**:


```shellscript
copy .env.example .env
```

2. **Configura los valores básicos**:


```plaintext
APP_NAME=MiraCar
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://miracar.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=miracar
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=database
SESSION_LIFETIME=120
```

3. **Genera una nueva clave de aplicación**:


```shellscript
php artisan key:generate
```

#### Solución para el error de vendor/autoload.php no encontrado

1. **Instala Composer** (si no está instalado)
2. **Instala las dependencias del proyecto**:


```shellscript
cd C:\xampp\htdocs\laravel\MiraCar
composer install
```

3. **Si encuentras errores de extensiones de PHP faltantes**:

1. Edita `C:\xampp\php\php.ini`
2. Descomenta las extensiones necesarias:





```plaintext
extension=fileinfo
extension=openssl
extension=mbstring
extension=pdo_mysql
extension=zip
```

#### Solución para el problema de redirección a la página de XAMPP

1. **Verifica la estructura de carpetas**:

1. Confirma que tu proyecto esté en la ubicación correcta
2. Asegúrate de que la carpeta `public` exista



2. **Corrige la configuración del host virtual**:

1. Asegúrate de que `DocumentRoot` apunte a la carpeta `public`



3. **Verifica el archivo .htaccess** en la carpeta `public`:


```plaintext
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

4. **Verifica que mod_rewrite esté habilitado**:

1. Abre `C:\xampp\apache\conf\httpd.conf`
2. Busca `LoadModule rewrite_module modules/mod_rewrite.so`
3. Asegúrate de que no esté comentada



5. **Revisa los logs de error** para identificar problemas específicos:

1. Apache: `C:\xampp\apache\logs\error.log`
2. Laravel: `C:\xampp\htdocs\laravel\MiraCar\storage\logs\laravel.log`





---

## 🖼️ Capturas de Pantalla `<a name="capturas-de-pantalla">``</a>`

### 📂 General

#### 🖥️ Monitor

<div>



</div><div>





</div>#### 💻 Tablet

<div>



</div><div>





</div>#### 📱 Móvil

<div>



</div><div>





</div>### 🔧 Taller

#### 🖥️ Monitor

<div>







</div><div>







</div><div>







</div>#### 💻 Tablet

<div>







</div><div>







</div><div>







</div>#### 📱 Móvil

<div>







</div><div>







</div><div>







</div>### 👤 Usuario

#### 🖥️ Monitor

<div>







</div>#### 💻 Tablet

<div>







</div>#### 📱 Móvil

<div>







</div>---

## 🚀 Uso del Programa `<a name="uso">``</a>`

### Para el Taller:

- Registro de clientes, vehículos y partes de siniestro.
- Gestión de documentos, fotos y piezas.
- Control de estado de cada reparación paso a paso.
- Comunicación directa con el cliente.


### Para el Usuario:

- Visualización del estado de reparación del vehículo.
- Acceso a presupuestos, facturas y documentos.
- Recepción de notificaciones del taller.


---

## 📜 Licencia

Este proyecto está bajo la Licencia MIT. Revisa el archivo LICENSE para más información.

---

## ✉️ Contacto

Proyecto desarrollado por **Román Rodríguez Martín**

📧 Correo: [adm.96.rrm@gmail.com](mailto:adm.96.rrm@gmail.com)

🌐 Sitio: [www.miracar.com](http://www.miracar.com) *(en construcción)*

```plaintext

Puedes copiar este código completo y guardarlo como un archivo README.md. El formato Markdown se renderizará correctamente en plataformas como GitHub, GitLab, Bitbucket, etc., mostrando todos los elementos visuales como encabezados, tablas, imágenes y enlaces.

```