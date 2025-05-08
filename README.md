# Guía Completa de MiraCar: Instalación, Configuración y Uso

<div align="center">
  <img src="galeria/logo.png" alt="MiraCar Logo" width="300" height="400" />
  <h1 style={{ fontSize: '3.5rem', fontWeight: 'bold', background: 'linear-gradient(to right, #FF2D20, #4479A1)', WebkitBackgroundClip: 'text', WebkitTextFillColor: 'transparent' }}>🚗 MiraCar</h1>
  <p style={{ fontSize: '1.3rem', maxWidth: '800px', margin: '0 auto 20px' }}>Conectando talleres y clientes para una experiencia automotriz moderna, clara y eficiente.</p>

  <div style={{ display: 'flex', justifyContent: 'center', gap: '15px', flexWrap: 'wrap', margin: '20px 0' }}>
    <a href="#sobre-miracar" style={{ textDecoration: 'none', color: '#FF2D20', fontWeight: 'bold', padding: '5px 10px', borderRadius: '5px', transition: 'all 0.3s ease' }}>¿Qué es MiraCar?</a>
    <span style={{ color: '#666' }}>•</span>
    <a href="#tecnologías-utilizadas" style={{ textDecoration: 'none', color: '#FF2D20', fontWeight: 'bold', padding: '5px 10px', borderRadius: '5px', transition: 'all 0.3s ease' }}>Tecnologías</a>
    <span style={{ color: '#666' }}>•</span>
    <a href="#instalación" style={{ textDecoration: 'none', color: '#FF2D20', fontWeight: 'bold', padding: '5px 10px', borderRadius: '5px', transition: 'all 0.3s ease' }}>Instalación</a>
    <span style={{ color: '#666' }}>•</span>
    <a href="#capturas-de-pantalla" style={{ textDecoration: 'none', color: '#FF2D20', fontWeight: 'bold', padding: '5px 10px', borderRadius: '5px', transition: 'all 0.3s ease' }}>Capturas</a>
    <span style={{ color: '#666' }}>•</span>
    <a href="#uso" style={{ textDecoration: 'none', color: '#FF2D20', fontWeight: 'bold', padding: '5px 10px', borderRadius: '5px', transition: 'all 0.3s ease' }}>Uso</a>
    <span style={{ color: '#666' }}>•</span>
    <a href="#estructura-del-proyecto" style={{ textDecoration: 'none', color: '#FF2D20', fontWeight: 'bold', padding: '5px 10px', borderRadius: '5px', transition: 'all 0.3s ease' }}>Estructura</a>
  </div>

  <div style={{ display: 'flex', justifyContent: 'center', gap: '10px', flexWrap: 'wrap', margin: '30px 0' }}>
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

<hr style={{ border: 'none', height: '1px', background: 'linear-gradient(to right, transparent, #FF2D20, transparent)', margin: '40px 0' }} />

## ¿Qué es MiraCar?

<div style={{ maxWidth: '900px', margin: '0 auto', padding: '0 20px', fontSize: '1.1rem', lineHeight: '1.6' }}>
  <p><strong>MiraCar</strong> es una aplicación web multiplataforma que conecta talleres automotrices con sus clientes, mejorando la comunicación, la gestión de reparaciones y la trazabilidad del historial de vehículos.</p>

  <p>El sistema está diseñado para ser intuitivo, responsivo y adaptable a cualquier dispositivo (móvil, tablet, escritorio). Se orienta tanto a <strong>talleres</strong> que necesitan gestionar siniestros, clientes y documentación, como a <strong>usuarios</strong> que desean hacer seguimiento en tiempo real de sus vehículos.</p>
</div>

<hr style={{ border: 'none', height: '1px', background: 'linear-gradient(to right, transparent, #4479A1, transparent)', margin: '40px 0' }} />

## Tecnologías Utilizadas

<div style={{ maxWidth: '900px', margin: '0 auto', padding: '0 20px' }}>
  <p style={{ textAlign: 'center', marginBottom: '20px', fontSize: '1.1rem' }}>El proyecto fue desarrollado con las siguientes herramientas:</p>

  <table style={{ width: '100%', borderCollapse: 'collapse', margin: '0 auto' }}>
    <thead>
      <tr style={{ background: '#f8f9fa' }}>
        <th style={{ padding: '12px 15px', textAlign: 'left', borderBottom: '2px solid #4479A1' }}>Herramienta</th>
        <th style={{ padding: '12px 15px', textAlign: 'left', borderBottom: '2px solid #4479A1' }}>Propósito</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style={{ padding: '12px 15px', borderBottom: '1px solid #ddd' }}><strong>Laravel 10</strong></td>
        <td style={{ padding: '12px 15px', borderBottom: '1px solid #ddd' }}>Framework backend (PHP)</td>
      </tr>
      <tr style={{ background: '#f8f9fa' }}>
        <td style={{ padding: '12px 15px', borderBottom: '1px solid #ddd' }}><strong>PHP 8.2</strong></td>
        <td style={{ padding: '12px 15px', borderBottom: '1px solid #ddd' }}>Lenguaje del servidor</td>
      </tr>
      <tr>
        <td style={{ padding: '12px 15px', borderBottom: '1px solid #ddd' }}><strong>MySQL</strong></td>
        <td style={{ padding: '12px 15px', borderBottom: '1px solid #ddd' }}>Base de datos relacional</td>
      </tr>
      <tr style={{ background: '#f8f9fa' }}>
        <td style={{ padding: '12px 15px', borderBottom: '1px solid #ddd' }}><strong>XAMPP</strong></td>
        <td style={{ padding: '12px 15px', borderBottom: '1px solid #ddd' }}>Entorno local (Apache + MySQL + PHP)</td>
      </tr>
      <tr>
        <td style={{ padding: '12px 15px', borderBottom: '1px solid #ddd' }}><strong>Composer</strong></td>
        <td style={{ padding: '12px 15px', borderBottom: '1px solid #ddd' }}>Gestión de dependencias PHP</td>
      </tr>
      <tr style={{ background: '#f8f9fa' }}>
        <td style={{ padding: '12px 15px', borderBottom: '1px solid #ddd' }}><strong>Node.js & npm</strong></td>
        <td style={{ padding: '12px 15px', borderBottom: '1px solid #ddd' }}>Gestión frontend, assets, dependencias JS</td>
      </tr>
      <tr>
        <td style={{ padding: '12px 15px', borderBottom: '1px solid #ddd' }}><strong>Bootstrap 5.3</strong></td>
        <td style={{ padding: '12px 15px', borderBottom: '1px solid #ddd' }}>Framework CSS responsivo</td>
      </tr>
      <tr style={{ background: '#f8f9fa' }}>
        <td style={{ padding: '12px 15px', borderBottom: '1px solid #ddd' }}><strong>Git</strong></td>
        <td style={{ padding: '12px 15px', borderBottom: '1px solid #ddd' }}>Control de versiones</td>
      </tr>
      <tr>
        <td style={{ padding: '12px 15px', borderBottom: '1px solid #ddd' }}><strong>Visual Studio Code</strong></td>
        <td style={{ padding: '12px 15px', borderBottom: '1px solid #ddd' }}>Editor de código recomendado</td>
      </tr>
    </tbody>
  </table>

  <p style={{ textAlign: 'center', marginTop: '20px', fontSize: '1.1rem' }}>Compatible con <strong>Windows, macOS y Linux</strong>.</p>
</div>

<hr style={{ border: 'none', height: '1px', background: 'linear-gradient(to right, transparent, #FF2D20, transparent)', margin: '40px 0' }} />

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





`<hr style={{ border: 'none', height: '1px', background: 'linear-gradient(to right, transparent, #4479A1, transparent)', margin: '40px 0' }} />``<h2 id="capturas-de-pantalla" style={{ fontSize: '2.5rem', fontWeight: 'bold', color: '#4479A1', textAlign: 'center', margin: '40px 0 20px' }}>🖼️ Capturas de Pantalla</h2>``<div style={{ maxWidth: '1200px', margin: '0 auto', padding: '0 20px' }}>
  <h3 style={{ fontSize: '2.2rem', fontWeight: 'bold', color: '#333', textAlign: 'center', margin: '30px 0 20px', borderBottom: '2px solid #4479A1', paddingBottom: '10px' }}>📂 General</h3>``  <h4 style={{ fontSize: '1.3rem', color: '#666', textAlign: 'center', margin: '20px 0 15px', fontWeight: 'normal' }}>🖥️ Monitor</h4>
  <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', flexWrap: 'wrap', margin: '20px 0' }}>
    <img src="galeria/monitor/general/1.png" alt="General Monitor 1" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/monitor/general/5.png" alt="General Monitor 2" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
  </div>
  <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', flexWrap: 'wrap', margin: '20px 0' }}>
    <img src="galeria/monitor/general/2.png" alt="General Monitor 3" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/monitor/general/3.png" alt="General Monitor 4" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/monitor/general/4.png" alt="General Monitor 5" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
  </div>``  <h4 style={{ fontSize: '1.3rem', color: '#666', textAlign: 'center', margin: '20px 0 15px', fontWeight: 'normal' }}>💻 Tablet</h4>
  <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', flexWrap: 'wrap', margin: '20px 0' }}>
    <img src="galeria/table/general/1.png" alt="General Tablet 1" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/table/general/5.png" alt="General Tablet 2" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
  </div>
  <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', flexWrap: 'wrap', margin: '20px 0' }}>
    <img src="galeria/table/general/2.png" alt="General Tablet 3" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/table/general/3.png" alt="General Tablet 4" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/table/general/4.png" alt="General Tablet 5" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
  </div>``  <h4 style={{ fontSize: '1.3rem', color: '#666', textAlign: 'center', margin: '20px 0 15px', fontWeight: 'normal' }}>📱 Móvil</h4>
  <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', flexWrap: 'wrap', margin: '20px 0' }}>
    <img src="galeria/movil/general/1.png" alt="General Móvil 1" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/movil/general/5.png" alt="General Móvil 2" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
  </div>
  <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', flexWrap: 'wrap', margin: '20px 0' }}>
    <img src="galeria/movil/general/2.png" alt="General Móvil 3" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/movil/general/3.png" alt="General Móvil 4" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/movil/general/4.png" alt="General Móvil 5" style={{ borderRadius: '8px', box  }} />
    <img src="galeria/movil/general/4.png" alt="General Móvil 5" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
  </div>``  <h3 style={{ fontSize: '2.2rem', fontWeight: 'bold', color: '#333', textAlign: 'center', margin: '50px 0 20px', borderBottom: '2px solid #FF2D20', paddingBottom: '10px' }}>🔧 Taller</h3>``  <h4 style={{ fontSize: '1.3rem', color: '#666', textAlign: 'center', margin: '20px 0 15px', fontWeight: 'normal' }}>🖥️ Monitor</h4>
  <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', flexWrap: 'wrap', margin: '20px 0' }}>
    <img src="galeria/monitor/taller/1.png" alt="Taller Monitor 1" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/monitor/taller/2.png" alt="Taller Monitor 2" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/monitor/taller/3.png" alt="Taller Monitor 3" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/monitor/taller/4.png" alt="Taller Monitor 4" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
  </div>
  <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', flexWrap: 'wrap', margin: '20px 0' }}>
    <img src="galeria/monitor/taller/5.png" alt="Taller Monitor 5" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/monitor/taller/6.png" alt="Taller Monitor 6" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/monitor/taller/7.png" alt="Taller Monitor 7" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/monitor/taller/8.png" alt="Taller Monitor 8" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
  </div>
  <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', flexWrap: 'wrap', margin: '20px 0' }}>
    <img src="galeria/monitor/taller/9.png" alt="Taller Monitor 9" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/monitor/taller/10.png" alt="Taller Monitor 10" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/monitor/taller/11.png" alt="Taller Monitor 11" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/monitor/taller/12.png" alt="Taller Monitor 12" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
  </div>``  <h4 style={{ fontSize: '1.3rem', color: '#666', textAlign: 'center', margin: '20px 0 15px', fontWeight: 'normal' }}>💻 Tablet</h4>
  <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', flexWrap: 'wrap', margin: '20px 0' }}>
    <img src="galeria/table/taller/1.png" alt="Taller Tablet 1" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/table/taller/2.png" alt="Taller Tablet 2" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/table/taller/3.png" alt="Taller Tablet 3" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/table/taller/4.png" alt="Taller Tablet 4" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
  </div>
  <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', flexWrap: 'wrap', margin: '20px 0' }}>
    <img src="galeria/table/taller/5.png" alt="Taller Tablet 5" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/table/taller/6.png" alt="Taller Tablet 6" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/table/taller/7.png" alt="Taller Tablet 7" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/table/taller/8.png" alt="Taller Tablet 8" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
  </div>
  <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', flexWrap: 'wrap', margin: '20px 0' }}>
    <img src="galeria/table/taller/9.png" alt="Taller Tablet 9" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/table/taller/10.png" alt="Taller Tablet 10" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/table/taller/11.png" alt="Taller Tablet 11" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/table/taller/12.png" alt="Taller Tablet 12" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
  </div>``  <h4 style={{ fontSize: '1.3rem', color: '#666', textAlign: 'center', margin: '20px 0 15px', fontWeight: 'normal' }}>📱 Móvil</h4>
  <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', flexWrap: 'wrap', margin: '20px 0' }}>
    <img src="galeria/movil/taller/1.png" alt="Taller Móvil 1" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/movil/taller/2.png" alt="Taller Móvil 2" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/movil/taller/3.png" alt="Taller Móvil 3" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/movil/taller/4.png" alt="Taller Móvil 4" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
  </div>
  <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', flexWrap: 'wrap', margin: '20px 0' }}>
    <img src="galeria/movil/taller/5.png" alt="Taller Móvil 5" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/movil/taller/6.png" alt="Taller Móvil 6" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/movil/taller/7.png" alt="Taller Móvil 7" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/movil/taller/8.png" alt="Taller Móvil 8" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
  </div>
  <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', flexWrap: 'wrap', margin: '20px 0' }}>
    <img src="galeria/movil/taller/9.png" alt="Taller Móvil 9" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/movil/taller/10.png" alt="Taller Móvil 10" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/movil/taller/11.png" alt="Taller Móvil 11" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/movil/taller/12.png" alt="Taller Móvil 12" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
  </div>``  <h3 style={{ fontSize: '2.2rem', fontWeight: 'bold', color: '#333', textAlign: 'center', margin: '50px 0 20px', borderBottom: '2px solid #4479A1', paddingBottom: '10px' }}>👤 Usuario</h3>``  <h4 style={{ fontSize: '1.3rem', color: '#666', textAlign: 'center', margin: '20px 0 15px', fontWeight: 'normal' }}>🖥️ Monitor</h4>
  <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', flexWrap: 'wrap', margin: '20px 0' }}>
    <img src="galeria/monitor/usuario/1.png" alt="Usuario Monitor 1" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/monitor/usuario/2.png" alt="Usuario Monitor 2" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/monitor/usuario/3.png" alt="Usuario Monitor 3" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/monitor/usuario/4.png" alt="Usuario Monitor 4" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
  </div>``  <h4 style={{ fontSize: '1.3rem', color: '#666', textAlign: 'center', margin: '20px 0 15px', fontWeight: 'normal' }}>💻 Tablet</h4>
  <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', flexWrap: 'wrap', margin: '20px 0' }}>
    <img src="galeria/table/usuario/1.png" alt="Usuario Tablet 1" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/table/usuario/2.png" alt="Usuario Tablet 2" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/table/usuario/3.png" alt="Usuario Tablet 3" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/table/usuario/4.png" alt="Usuario Tablet 4" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
  </div>``  <h4 style={{ fontSize: '1.3rem', color: '#666', textAlign: 'center', margin: '20px 0 15px', fontWeight: 'normal' }}>📱 Móvil</h4>
  <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', flexWrap: 'wrap', margin: '20px 0' }}>
    <img src="galeria/movil/usuario/1.png" alt="Usuario Móvil 1" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/movil/usuario/2.png" alt="Usuario Móvil 2" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/movil/usuario/3.png" alt="Usuario Móvil 3" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
    <img src="galeria/movil/usuario/4.png" alt="Usuario Móvil 4" style={{ borderRadius: '8px', boxShadow: '0 4px 8px rgba(0,0,0,0.1)' }} />
  </div>
</div>``<hr style={{ border: 'none', height: '1px', background: 'linear-gradient(to right, transparent, #FF2D20, transparent)', margin: '40px 0' }} />``<h2 id="uso" style={{ fontSize: '2.5rem', fontWeight: 'bold', color: '#FF2D20', textAlign: 'center', margin: '40px 0 20px' }}>🚀 Uso del Programa</h2>``<div style={{ maxWidth: '900px', margin: '0 auto', padding: '0 20px' }}>
  <div style={{ display: 'flex', flexDirection: 'column', gap: '30px' }}>
    <div style={{ background: '#f8f9fa', padding: '25px', borderRadius: '10px', boxShadow: '0 4px 6px rgba(0,0,0,0.05)' }}>
      <h3 style={{ fontSize: '1.8rem', color: '#333', marginBottom: '15px', borderLeft: '4px solid #FF2D20', paddingLeft: '10px' }}>Para el Taller:</h3>
      <ul style={{ listStyleType: 'none', padding: 0 }}>
        <li style={{ padding: '8px 0', display: 'flex', alignItems: 'center' }}>
          <span style={{ display: 'inline-block', width: '8px', height: '8px', borderRadius: '50%', background: '#FF2D20', marginRight: '10px' }}></span>
          Registro de clientes, vehículos y partes de siniestro.
        </li>
        <li style={{ padding: '8px 0', display: 'flex', alignItems: 'center' }}>
          <span style={{ display: 'inline-block', width: '8px', height: '8px', borderRadius: '50%', background: '#FF2D20', marginRight: '10px' }}></span>
          Gestión de documentos, fotos y piezas.
        </li>
        <li style={{ padding: '8px 0', display: 'flex', alignItems: 'center' }}>
          <span style={{ display: 'inline-block', width: '8px', height: '8px', borderRadius: '50%', background: '#FF2D20', marginRight: '10px' }}></span>
          Control de estado de cada reparación paso a paso.
        </li>
        <li style={{ padding: '8px 0', display: 'flex', alignItems: 'center' }}>
          <span style={{ display: 'inline-block', width: '8px', height: '8px', borderRadius: '50%', background: '#FF2D20', marginRight: '10px' }}></span>
          Comunicación directa con el cliente.
        </li>
      </ul>
    </div>````plaintext
<div style={{ background: '#f8f9fa', padding: '25px', borderRadius: '10px', boxShadow: '0 4px 6px rgba(0,0,0,0.05)' }}>
  <h3 style={{ fontSize: '1.8rem', color: '#333', marginBottom: '15px', borderLeft: '4px solid #4479A1', paddingLeft: '10px' }}>Para el Usuario:</h3>
  <ul style={{ listStyleType: 'none', padding: 0 }}>
    <li style={{ padding: '8px 0', display: 'flex', alignItems: 'center' }}>
      <span style={{ display: 'inline-block', width: '8px', height: '8px', borderRadius: '50%', background: '#4479A1', marginRight: '10px' }}></span>
      Visualización del estado de reparación del vehículo.
    </li>
    <li style={{ padding: '8px 0', display: 'flex', alignItems: 'center' }}>
      <span style={{ display: 'inline-block', width: '8px', height: '8px', borderRadius: '50%', background: '#4479A1', marginRight: '10px' }}></span>
      Acceso a presupuestos, facturas y documentos.
    </li>
    <li style={{ padding: '8px 0', display: 'flex', alignItems: 'center' }}>
      <span style={{ display: 'inline-block', width: '8px', height: '8px', borderRadius: '50%', background: '#4479A1', marginRight: '10px' }}></span>
      Recepción de notificaciones del taller.
    </li>
  </ul>
</div>
```

`  </div>
</div>``<hr style={{ border: 'none', height: '1px', background: 'linear-gradient(to right, transparent, #4479A1, transparent)', margin: '40px 0' }} />``<h2 id="licencia" style={{ fontSize: '2.5rem', fontWeight: 'bold', color: '#4479A1', textAlign: 'center', margin: '40px 0 20px' }}>📜 Licencia</h2>``<div style={{ maxWidth: '900px', margin: '0 auto', padding: '0 20px', textAlign: 'center' }}>
  <p style={{ fontSize: '1.1rem' }}>Este proyecto está bajo la Licencia MIT. Revisa el archivo LICENSE para más información.</p>
</div>``<hr style={{ border: 'none', height: '1px', background: 'linear-gradient(to right, transparent, #FF2D20, transparent)', margin: '40px 0' }} />``<h2 id="contacto" style={{ fontSize: '2.5rem', fontWeight: 'bold', color: '#FF2D20', textAlign: 'center', margin: '40px 0 20px' }}>✉️ Contacto</h2>``<div style={{ maxWidth: '900px', margin: '0 auto', padding: '0 20px', textAlign: 'center' }}>
  <p style={{ fontSize: '1.1rem', marginBottom: '10px' }}>Proyecto desarrollado por <strong>Román Rodríguez Martín</strong></p>
  <p style={{ fontSize: '1.1rem', marginBottom: '5px' }}>
    📧 Correo: <a href="mailto:adm.96.rrm@gmail.com" style={{ color: '#FF2D20', textDecoration: 'none' }}>adm.96.rrm@gmail.com</a>
  </p>
  <p style={{ fontSize: '1.1rem' }}>
    🌐 Sitio: <a href="" style={{ color: '#4479A1', textDecoration: 'none' }}>www.miracar.com</a> <em>(en construcción)</em>
  </p>
</div>
