# Guía Completa de MiraCar: Instalación, Configuración y Uso

<div align="center">
  <img src="galeria/logo.png" alt="MiraCar Logo" width="300" height="400" />
  <h1>🚗 MiraCar</h1>
  <p>Conectando talleres y clientes para una experiencia automotriz moderna, clara y eficiente.</p>

  <div>
    <a href="#sobre-miracar">¿Qué es MiraCar?</a> •
    <a href="#tecnologías-utilizadas">Tecnologías</a> •
    <a href="#instalación">Instalación</a> •
    <a href="#capturas-de-pantalla">Capturas</a> •
    <a href="#uso">Uso</a> •
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

## ¿Qué es MiraCar?

<div>
  <p><strong>MiraCar</strong> es una aplicación web multiplataforma que conecta talleres automotrices con sus clientes, mejorando la comunicación, la gestión de reparaciones y la trazabilidad del historial de vehículos.</p>

  <p>El sistema está diseñado para ser intuitivo, responsivo y adaptable a cualquier dispositivo (móvil, tablet, escritorio). Se orienta tanto a <strong>talleres</strong> que necesitan gestionar siniestros, clientes y documentación, como a <strong>usuarios</strong> que desean hacer seguimiento en tiempo real de sus vehículos.</p>
</div>

---

## Tecnologías Utilizadas

<div>
  <p align="center">El proyecto fue desarrollado con las siguientes herramientas:</p>

  <table>
    <thead>
      <tr>
        <th>Herramienta</th>
        <th>Propósito</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><strong>Laravel 10</strong></td>
        <td>Framework backend (PHP)</td>
      </tr>
      <tr>
        <td><strong>PHP 8.2</strong></td>
        <td>Lenguaje del servidor</td>
      </tr>
      <tr>
        <td><strong>MySQL</strong></td>
        <td>Base de datos relacional</td>
      </tr>
      <tr>
        <td><strong>XAMPP</strong></td>
        <td>Entorno local (Apache + MySQL + PHP)</td>
      </tr>
      <tr>
        <td><strong>Composer</strong></td>
        <td>Gestión de dependencias PHP</td>
      </tr>
      <tr>
        <td><strong>Node.js & npm</strong></td>
        <td>Gestión frontend, assets, dependencias JS</td>
      </tr>
      <tr>
        <td><strong>Bootstrap 5.3</strong></td>
        <td>Framework CSS responsivo</td>
      </tr>
      <tr>
        <td><strong>Git</strong></td>
        <td>Control de versiones</td>
      </tr>
      <tr>
        <td><strong>Visual Studio Code</strong></td>
        <td>Editor de código recomendado</td>
      </tr>
    </tbody>
  </table>

  <p align="center">Compatible con <strong>Windows, macOS y Linux</strong>.</p>
</div>

---

## Instalación y Configuración

### Instalación de XAMPP

#### Paso 1: Descargar la última versión de XAMPP

1. **Visita el sitio oficial de XAMPP**:
   - Abre tu navegador y ve a [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html)

2. **Selecciona la versión para Windows**:
   - Elige la versión más reciente para Windows
   - Haz clic en el botón de descarga

3. **Guarda el archivo de instalación**:
   - Selecciona una ubicación fácil de encontrar, como tu Escritorio

#### Paso 2: Instalar XAMPP

1. **Ejecuta el instalador**:
   - Localiza el archivo descargado (normalmente `xampp-windows-x64-X.X.X-X-installer.exe`)
   - Haz clic derecho y selecciona "Ejecutar como administrador"

2. **Si aparece una advertencia de seguridad**:
   - Haz clic en "Sí" para permitir que el programa realice cambios

3. **Sigue el asistente de instalación**:
   - Haz clic en "Next" (Siguiente)
   - En la pantalla de selección de componentes, asegúrate de que estén marcados al menos:
     - Apache
     - MySQL
     - PHP
     - phpMyAdmin
   - Haz clic en "Next"

4. **Selecciona la carpeta de instalación**:
   - La ubicación predeterminada es `C:\xampp`
   - Puedes cambiarla si lo deseas, pero recuerda la nueva ubicación
   - Haz clic en "Next"

5. **Selección de idioma y otras opciones**:
   - Selecciona tu idioma preferido
   - Desmarca la opción "Learn more about Bitnami" si no te interesa
   - Haz clic en "Next"

6. **Inicia la instalación**:
   - Haz clic en "Next" para comenzar la instalación
   - Espera a que se complete el proceso (puede tardar varios minutos)

7. **Finaliza la instalación**:
   - Cuando se complete, marca la casilla "Start Control Panel now"
   - Haz clic en "Finish"

#### Paso 3: Configurar XAMPP después de la instalación

1. **Configura el panel de control**:
   - En el panel de control de XAMPP, haz clic en "Config" (arriba a la derecha)
   - Selecciona las opciones según tus preferencias

2. **Inicia los servicios necesarios**:
   - Haz clic en "Start" junto a Apache
   - Haz clic en "Start" junto a MySQL
   - Verifica que ambos servicios muestren la luz verde

3. **Verifica la instalación**:
   - Abre tu navegador
   - Navega a `http://localhost`
   - Deberías ver la página de bienvenida de XAMPP

4. **Configura la seguridad**:
   - Haz clic en "Security" en la página de bienvenida
   - Sigue las recomendaciones para asegurar tu instalación
   - Establece contraseñas para MySQL y phpMyAdmin

#### Paso 4: Restaurar tus datos (si es necesario)

1. **Restaura tus bases de datos**:
   - Copia las carpetas de bases de datos desde `C:\XAMPP_Backup\databases`
   - Pégalas en `C:\xampp\mysql\data`

2. **Restaura tus proyectos web**:
   - Copia las carpetas de proyectos desde `C:\XAMPP_Backup\htdocs`
   - Pégalas en `C:\xampp\htdocs`

3. **Restaura configuraciones personalizadas** (si es necesario):
   - Revisa tus configuraciones personalizadas en `C:\XAMPP_Backup\config`
   - Aplica los cambios necesarios a los nuevos archivos de configuración
   - **No sobrescribas** directamente los archivos, mejor aplica los cambios manualmente

### Solución de Problemas Comunes

#### Si MySQL no inicia:

1. **Verifica los puertos**:
   - Asegúrate de que el puerto 3306 no esté siendo usado por otro programa
   - Puedes cambiar el puerto en `C:\xampp\mysql\bin\my.ini`

2. **Verifica los archivos de datos**:
   - Si restauraste bases de datos, puede haber conflictos
   - Intenta iniciar MySQL sin las bases de datos restauradas

#### Si Apache no inicia:

1. **Verifica los puertos**:
   - Asegúrate de que los puertos 80 y 443 no estén siendo usados
   - Puedes cambiar los puertos en `C:\xampp\apache\conf\httpd.conf`

2. **Verifica la configuración**:
   - Revisa `C:\xampp\apache\conf\httpd.conf` en busca de errores
   - Revisa los logs en `C:\xampp\apache\logs`

#### Solución para el mensaje "La carpeta seleccionada no está vacía"

##### Opción 1: Eliminar completamente la carpeta existente

1. **Cierra el instalador de XAMPP**
2. **Asegúrate de tener una copia de seguridad de tus datos importantes**
3. **Elimina la carpeta de XAMPP existente**:
   - Navega a la ubicación de XAMPP (normalmente `C:\xampp`)
   - Haz clic derecho en la carpeta y selecciona "Eliminar"
4. **Ejecuta el instalador nuevamente**

##### Opción 2: Instalar en una ubicación diferente

1. **Cierra el instalador de XAMPP**
2. **Ejecuta el instalador nuevamente**
3. **Cuando llegues a la pantalla de selección de ubicación**:
   - Elige una ubicación diferente, por ejemplo:
     - `C:\xampp2`
     - `D:\xampp`
     - `C:\Programas\xampp`
4. **Completa la instalación normalmente**

### Restauración de un Proyecto Laravel

#### Paso 1: Restaurar el código fuente del proyecto

1. **Localiza la copia de seguridad** de tu proyecto Laravel
2. **Copia la carpeta del proyecto** a la nueva instalación:
   - Copia toda la carpeta de tu proyecto (por ejemplo, `miracar`)
   - Pégala en `C:\xampp\htdocs\`
3. **Configura los permisos correctos** para las carpetas que requieren escritura:
   - `C:\xampp\htdocs\laravel\miracar\storage`
   - `C:\xampp\htdocs\laravel\miracar\bootstrap\cache`

#### Paso 2: Restaurar la base de datos

1. **Inicia los servicios de XAMPP**
2. **Restaurar desde archivos de datos**:
   - Detén el servicio MySQL en el panel de control de XAMPP
   - Copia la carpeta de la base de datos
   - Pégala en `C:\xampp\mysql\data\`
   - Inicia el servicio MySQL nuevamente
3. **Restaurar desde un archivo SQL** (si tienes un dump):
   - Abre phpMyAdmin (`http://localhost/phpmyadmin`)
   - Crea una nueva base de datos
   - Importa el archivo SQL

### Configuración del Entorno Laravel

#### Paso 1: Verificar el archivo .env

1. **Verifica que el archivo .env exista**:
   - Si no existe, crea uno copiando `.env.example`:

```

copy .env.example .env

```plaintext

2. **Edita el archivo .env** para que coincida con tu nueva configuración:

```

APP_URL=[http://miracar.com](http://miracar.com)

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=miracar
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
CACHE_DRIVER=file

```plaintext

#### Paso 2: Instalar dependencias y regenerar la clave

1. **Verifica si Composer está instalado**:

```

composer --version

```plaintext

2. **Instala las dependencias del proyecto**:

```

cd C:\xampp\htdocs\laravel\MiraCar
composer install

```plaintext

3. **Genera una nueva clave de aplicación**:

```

php artisan key:generate

```plaintext

4. **Limpia cachés**:

```

php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

```plaintext

#### Paso 3: Configurar hosts virtuales

1. **Edita el archivo hosts**:
   - Abre `C:\Windows\System32\drivers\etc\hosts` como administrador
   - Agrega estas líneas:

```

127.0.0.1 miracar.com
127.0.0.1 [www.miracar.com](http://www.miracar.com)

```plaintext

2. **Configura el host virtual en Apache**:
   - Abre `C:\xampp\apache\conf\extra\httpd-vhosts.conf`
   - Agrega esta configuración:

```

<VirtualHost *:80>
DocumentRoot "C:/xampp/htdocs/laravel/miracar/public"
ServerName miracar.com
ServerAlias [www.miracar.com](http://www.miracar.com)
<Directory "C:/xampp/htdocs/laravel/miracar/public">
Options Indexes FollowSymLinks
AllowOverride All
Require all granted
`</Directory>`
ErrorLog "logs/miracar.com-error.log"
CustomLog "logs/miracar.com-access.log" combined
`</VirtualHost>`

# Configuración para acceder a través de IP/miracar

Alias "/miracar" "C:/xampp/htdocs/laravel/miracar/public"
<Directory "C:/xampp/htdocs/laravel/miracar/public">
Options Indexes FollowSymLinks
AllowOverride All
Require all granted
`</Directory>`

```plaintext

3. **Reinicia Apache**

### Solución de Problemas Específicos

#### Recrear el archivo .env sin copia de seguridad

1. **Crea un nuevo archivo .env a partir del ejemplo**:

```

copy .env.example .env

```plaintext

2. **Configura los valores básicos**:

```

APP_NAME=MiraCar
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=[http://miracar.com](http://miracar.com)

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

```plaintext

3. **Genera una nueva clave de aplicación**:

```

php artisan key:generate

```plaintext

#### Solución para el error de vendor/autoload.php no encontrado

1. **Instala Composer** (si no está instalado)
2. **Instala las dependencias del proyecto**:

```

cd C:\xampp\htdocs\laravel\MiraCar
composer install

```plaintext

3. **Si encuentras errores de extensiones de PHP faltantes**:
   - Edita `C:\xampp\php\php.ini`
   - Descomenta las extensiones necesarias:

```

extension=fileinfo
extension=openssl
extension=mbstring
extension=pdo_mysql
extension=zip

```plaintext

#### Solución para el problema de redirección a la página de XAMPP

1. **Verifica la estructura de carpetas**:
   - Confirma que tu proyecto esté en la ubicación correcta
   - Asegúrate de que la carpeta `public` exista

2. **Corrige la configuración del host virtual**:
   - Asegúrate de que `DocumentRoot` apunte a la carpeta `public`

3. **Verifica el archivo .htaccess** en la carpeta `public`:

```

`<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>````plaintext
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
```

`</IfModule>
````4. **Verifica que mod_rewrite esté habilitado**:

1. Abre `C:\xampp\apache\conf\httpd.conf`
2. Busca `LoadModule rewrite_module modules/mod_rewrite.so`
3. Asegúrate de que no esté comentada



5. **Revisa los logs de error** para identificar problemas específicos:

1. Apache: `C:\xampp\apache\logs\error.log`
2. Laravel: `C:\xampp\htdocs\laravel\MiraCar\storage\logs\laravel.log`





---

## 🖼️ Capturas de Pantalla

### 📂 General

#### 🖥️ Monitor

`<div>
  <img src="galeria/monitor/general/1.png" alt="General Monitor 1" />
  <img src="galeria/monitor/general/5.png" alt="General Monitor 2" />
</div>
<div>
  <img src="galeria/monitor/general/2.png" alt="General Monitor 3" />
  <img src="galeria/monitor/general/3.png" alt="General Monitor 4" />
  <img src="galeria/monitor/general/4.png" alt="General Monitor 5" />
</div>`#### 💻 Tablet

`<div>
  <img src="galeria/table/general/1.png" alt="General Tablet 1" />
  <img src="galeria/table/general/5.png" alt="General Tablet 2" />
</div>
<div>
  <img src="galeria/table/general/2.png" alt="General Tablet 3" />
  <img src="galeria/table/general/3.png" alt="General Tablet 4" />
  <img src="galeria/table/general/4.png" alt="General Tablet 5" />
</div>`#### 📱 Móvil

`<div>
  <img src="galeria/movil/general/1.png" alt="General Móvil 1" />
  <img src="galeria/movil/general/5.png" alt="General Móvil 2" />
</div>
<div>
  <img src="galeria/movil/general/2.png" alt="General Móvil 3" />
  <img src="galeria/movil/general/3.png" alt="General Móvil 4" />
  <img src="galeria/movil/general/4.png" alt="General Móvil 5" />
</div>`### 🔧 Taller

#### 🖥️ Monitor

`<div>
  <img src="galeria/monitor/taller/1.png" alt="Taller Monitor 1" />
  <img src="galeria/monitor/taller/2.png" alt="Taller Monitor 2" />
  <img src="galeria/monitor/taller/3.png" alt="Taller Monitor 3" />
  <img src="galeria/monitor/taller/4.png" alt="Taller Monitor 4" />
</div>
<div>
  <img src="galeria/monitor/taller/5.png" alt="Taller Monitor 5" />
  <img src="galeria/monitor/taller/6.png" alt="Taller Monitor 6" />
  <img src="galeria/monitor/taller/7.png" alt="Taller Monitor 7" />
  <img src="galeria/monitor/taller/8.png" alt="Taller Monitor 8" />
</div>
<div>
  <img src="galeria/monitor/taller/9.png" alt="Taller Monitor 9" />
  <img src="galeria/monitor/taller/10.png" alt="Taller Monitor 10" />
  <img src="galeria/monitor/taller/11.png" alt="Taller Monitor 11" />
  <img src="galeria/monitor/taller/12.png" alt="Taller Monitor 12" />
</div>`#### 💻 Tablet

`<div>
  <img src="galeria/table/taller/1.png" alt="Taller Tablet 1" />
  <img src="galeria/table/taller/2.png" alt="Taller Tablet 2" />
  <img src="galeria/table/taller/3.png" alt="Taller Tablet 3" />
  <img src="galeria/table/taller/4.png" alt="Taller Tablet 4" />
</div>
<div>
  <img src="galeria/table/taller/5.png" alt="Taller Tablet 5" />
  <img src="galeria/table/taller/6.png" alt="Taller Tablet 6" />
  <img src="galeria/table/taller/7.png" alt="Taller Tablet 7" />
  <img src="galeria/table/taller/8.png" alt="Taller Tablet 8" />
</div>
<div>
  <img src="galeria/table/taller/9.png" alt="Taller Tablet 9" />
  <img src="galeria/table/taller/10.png" alt="Taller Tablet 10" />
  <img src="galeria/table/taller/11.png" alt="Taller Tablet 11" />
  <img src="galeria/table/taller/12.png" alt="Taller Tablet 12" />
</div>`#### 📱 Móvil

`<div>
  <img src="galeria/movil/taller/1.png" alt="Taller Móvil 1" />
  <img src="galeria/movil/taller/2.png" alt="Taller Móvil 2" />
  <img src="galeria/movil/taller/3.png" alt="Taller Móvil 3" />
  <img src="galeria/movil/taller/4.png" alt="Taller Móvil 4" />
</div>
<div>
  <img src="galeria/movil/taller/5.png" alt="Taller Móvil 5" />
  <img src="galeria/movil/taller/6.png" alt="Taller Móvil 6" />
  <img src="galeria/movil/taller/7.png" alt="Taller Móvil 7" />
  <img src="galeria/movil/taller/8.png" alt="Taller Móvil 8" />
</div>
<div>
  <img src="galeria/movil/taller/9.png" alt="Taller Móvil 9" />
  <img src="galeria/movil/taller/10.png" alt="Taller Móvil 10" />
  <img src="galeria/movil/taller/11.png" alt="Taller Móvil 11" />
  <img src="galeria/movil/taller/12.png" alt="Taller Móvil 12" />
</div>`### 👤 Usuario

#### 🖥️ Monitor

`<div>
  <img src="galeria/monitor/usuario/1.png" alt="Usuario Monitor 1" />
  <img src="galeria/monitor/usuario/2.png" alt="Usuario Monitor 2" />
  <img src="galeria/monitor/usuario/3.png" alt="Usuario Monitor 3" />
  <img src="galeria/monitor/usuario/4.png" alt="Usuario Monitor 4" />
</div>`#### 💻 Tablet

`<div>
  <img src="galeria/table/usuario/1.png" alt="Usuario Tablet 1" />
  <img src="galeria/table/usuario/2.png" alt="Usuario Tablet 2" />
  <img src="galeria/table/usuario/3.png" alt="Usuario Tablet 3" />
  <img src="galeria/table/usuario/4.png" alt="Usuario Tablet 4" />
</div>`#### 📱 Móvil

`<div>
  <img src="galeria/movil/usuario/1.png" alt="Usuario Móvil 1" />
  <img src="galeria/movil/usuario/2.png" alt="Usuario Móvil 2" />
  <img src="galeria/movil/usuario/3.png" alt="Usuario Móvil 3" />
  <img src="galeria/movil/usuario/4.png" alt="Usuario Móvil 4" />
</div>`---

## 🚀 Uso del Programa

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

El problema principal era que estabas usando estilos JSX/React dentro del Markdown, lo cual no es compatible con GitHub. He eliminado todos los estilos JSX (como `style={{ ... }}`) y he simplificado el HTML para que sea compatible con el procesamiento de Markdown de GitHub. Esto debería solucionar el problema de visualización en GitHub.

<Actions>
  <Action name="Verificar la sintaxis Markdown" description="Revisar que todo el código Markdown sea compatible con GitHub" />
  <Action name="Configurar mod_rewrite en Apache" description="Asegurar que mod_rewrite esté habilitado para el funcionamiento correcto de Laravel" />
  <Action name="Configurar hosts virtuales" description="Configurar correctamente los hosts virtuales para el proyecto MiraCar" />
  <Action name="Optimizar imágenes" description="Comprimir las imágenes para mejorar el rendimiento del sitio" />
</Actions>