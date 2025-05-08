# MiraCar - Gestión Automotriz Integral

<div align="center">
  <img src="1galeria/logo.png" alt="MiraCar Logo" width="300" height="400" />
  <h1>🚗 MiraCar</h1>
  <p>Conectando talleres y clientes para una experiencia automotriz moderna, clara y eficiente.</p>

  <div>
    <a href="#qué-es-miracar">¿Qué es MiraCar?</a> •
    <a href="#tecnologías-utilizadas">Tecnologías</a> •
    <a href="#instalación-y-configuración">Instalación</a> •
    <a href="#capturas-de-pantalla">Capturas</a> •
    <a href="#documentación">Documentación</a> •
    <a href="#uso-del-programa">Uso</a> •
    <a href="#estructura-del-proyecto">Estructura</a> •
    <a href="#licencia">Licencia</a>
  </div>

  <div>
    <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
    <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
    <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
    <img src="https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap" />
    <img src="https://img.shields.io/badge/XAMPP-EF5B25?style=for-the-badge&logo=xampp&logoColor=white" alt="XAMPP" />
    <img src="https://img.shields.io/badge/Node.js-18.x-339933?style=for-the-badge&logo=node.js&logoColor=white" alt="Node.js" />
    <img src="https://img.shields.io/badge/Composer-2.x-885630?style=for-the-badge&logo=composer&logoColor=white" alt="Composer" />
    <img src="https://img.shields.io/badge/Git-F05032?style=for-the-badge&logo=git&logoColor=white" alt="Git" />
  </div>
</div>

---

## ❓ ¿Qué es MiraCar?

**MiraCar** es una aplicación web multiplataforma que conecta talleres con sus clientes, mejorando la comunicación, la gestión de reparaciones y la transparencia con el cliente.

El sistema está diseñado para ser intuitivo, responsivo y adaptable a cualquier dispositivo (móvil, tablet, escritorio). Se orienta tanto a **talleres** que necesitan gestionar siniestros, clientes y documentación, como a **usuarios** que desean hacer seguimiento en tiempo real de sus vehículos.

---

## 🛠 Tecnologías Utilizadas

| Herramienta              | Propósito                            | Versión  | Enlace |
|--------------------------|--------------------------------------|----------|--------|
| Laravel                  | Framework backend (PHP)              | 12       | -      |
| PHP                      | Lenguaje del servidor                | 8.2      | -      |
| MySQL                    | Base de datos relacional             | 8.0      | -      |
| [XAMPP](https://www.apachefriends.org/es/index.html){:target="_blank"} | Entorno local (Apache + MySQL + PHP) | 8.2.4    | [Descargar](https://www.apachefriends.org/es/index.html){:target="_blank"} |
| [Composer](https://getcomposer.org/){:target="_blank"} | Gestión de dependencias PHP          | 2.x      | [Instalar](https://getcomposer.org/){:target="_blank"} |
| [Node.js](https://nodejs.org/es){:target="_blank"} & npm | Gestión frontend y assets JS         | 18.x     | [Descargar](https://nodejs.org/es){:target="_blank"} |
| Bootstrap                | Framework CSS responsivo             | 5        | -      |
| [Git](https://git-scm.com/){:target="_blank"} | Control de versiones                 | 2.x      | [Descargar](https://git-scm.com/){:target="_blank"} |

Compatible con **Windows, macOS y Linux**.

---

## ⚙️ Instalación y Configuración

### Requisitos Previos
- PHP 8.1+
- MySQL 5.7+
- [Node.js](https://nodejs.org/es){:target="_blank"} + npm
- [Composer](https://getcomposer.org/){:target="_blank"}
- [Git](https://git-scm.com/){:target="_blank"}
- [XAMPP](https://www.apachefriends.org/es/index.html){:target="_blank"} o similar

### Pasos de Instalación

1. **Instalar XAMPP** (entorno de desarrollo local):
   - Descargar XAMPP desde [Apache Friends](https://www.apachefriends.org/es/index.html){:target="_blank"}.
   - Ejecutar el instalador como administrador.
   - Seleccionar componentes esenciales:
     - **Apache** (servidor web)
     - **MySQL** (base de datos)
     - **PHP** (versión 8.2+ recomendada)
     - **phpMyAdmin** (opcional para gestión de bases de datos)
   - Completar la instalación y abrir el panel de control.
   - Iniciar los servicios de **Apache** y **MySQL** desde el panel.

2. **Clonar el repositorio**:
   ```bash
   git clone https://github.com/tuusuario/miracar.git
   cd miracar
   ```

3. **Instalar dependencias**:
   ```bash
   composer install
   npm install && npm run build
   ```

4. **Configurar entorno**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configurar base de datos**:
   - Crear una base de datos MySQL llamada `miracar` desde phpMyAdmin ([http://localhost/phpmyadmin](http://localhost/phpmyadmin){:target="_blank"}).
   - Configurar las credenciales en `.env`:
     ```env
     DB_DATABASE=miracar
     DB_USERNAME=root
     DB_PASSWORD=
     ```
   - Ejecutar migraciones:
     ```bash
     php artisan migrate --seed
     ```

6. **Iniciar servidor**:
   ```bash
   php artisan serve
   ```
   Acceder a [http://localhost:8000](http://localhost:8000){:target="_blank"}.

---

## 🖼️ Capturas de Pantalla

### 📂 Panel del Inicio De Sección & Registro

#### 🖥️ Monitor
<div align="center">
  <img src="1galeria/monitor/general/1.png" alt="General Monitor 1" width="45%"/>
  <img src="1galeria/monitor/general/5.png" alt="General Monitor 2" width="45%"/>
  
  <img src="1galeria/monitor/general/2.png" alt="General Monitor 3" width="30%"/>
  <img src="1galeria/monitor/general/3.png" alt="General Monitor 4" width="30%"/>
  <img src="1galeria/monitor/general/4.png" alt="General Monitor 5" width="30%"/>
</div>

#### 💻 Tablet
<div align="center">
  <img src="1galeria/table/general/1.png" alt="General Tablet 1" width="45%"/>
  <img src="1galeria/table/general/5.png" alt="General Tablet 2" width="45%"/>
  
  <img src="1galeria/table/general/2.png" alt="General Tablet 3" width="30%"/>
  <img src="1galeria/table/general/3.png" alt="General Tablet 4" width="30%"/>
  <img src="1galeria/table/general/4.png" alt="General Tablet 5" width="30%"/>
</div>

#### 📱 Móvil
<div align="center">
  <img src="1galeria/movil/general/1.png" alt="General Móvil 1" width="45%"/>
  <img src="1galeria/movil/general/5.png" alt="General Móvil 2" width="45%"/>
  
  <img src="1galeria/movil/general/2.png" alt="General Móvil 3" width="30%"/>
  <img src="1galeria/movil/general/3.png" alt="General Móvil 4" width="30%"/>
  <img src="1galeria/movil/general/4.png" alt="General Móvil 5" width="30%"/>
</div>

### 🔧 Panel del Taller

#### 🖥️ Monitor
<div align="center">
  <img src="1galeria/monitor/taller/1.png" alt="Taller Monitor 1" width="23%"/>
  <img src="1galeria/monitor/taller/2.png" alt="Taller Monitor 2" width="23%"/>
  <img src="1galeria/monitor/taller/3.png" alt="Taller Monitor 3" width="23%"/>
  <img src="1galeria/monitor/taller/4.png" alt="Taller Monitor 4" width="23%"/>
  
  <img src="1galeria/monitor/taller/5.png" alt="Taller Monitor 5" width="23%"/>
  <img src="1galeria/monitor/taller/6.png" alt="Taller Monitor 6" width="23%"/>
  <img src="1galeria/monitor/taller/7.png" alt="Taller Monitor 7" width="23%"/>
  <img src="1galeria/monitor/taller/8.png" alt="Taller Monitor 8" width="23%"/>
  
  <img src="1galeria/monitor/taller/9.png" alt="Taller Monitor 9" width="23%"/>
  <img src="1galeria/monitor/taller/10.png" alt="Taller Monitor 10" width="23%"/>
  <img src="1galeria/monitor/taller/11.png" alt="Taller Monitor 11" width="23%"/>
  <img src="1galeria/monitor/taller/12.png" alt="Taller Monitor 12" width="23%"/>
</div>

#### 💻 Tablet
<div align="center">
  <img src="1galeria/table/taller/1.png" alt="Taller Tablet 1" width="23%"/>
  <img src="1galeria/table/taller/2.png" alt="Taller Tablet 2" width="23%"/>
  <img src="1galeria/table/taller/3.png" alt="Taller Tablet 3" width="23%"/>
  <img src="1galeria/table/taller/4.png" alt="Taller Tablet 4" width="23%"/>
  
  <img src="1galeria/table/taller/5.png" alt="Taller Tablet 5" width="23%"/>
  <img src="1galeria/table/taller/6.png" alt="Taller Tablet 6" width="23%"/>
  <img src="1galeria/table/taller/7.png" alt="Taller Tablet 7" width="23%"/>
  <img src="1galeria/table/taller/8.png" alt="Taller Tablet 8" width="23%"/>
  
  <img src="1galeria/table/taller/9.png" alt="Taller Tablet 9" width="23%"/>
  <img src="1galeria/table/taller/10.png" alt="Taller Tablet 10" width="23%"/>
  <img src="1galeria/table/taller/11.png" alt="Taller Tablet 11" width="23%"/>
  <img src="1galeria/table/taller/12.png" alt="Taller Tablet 12" width="23%"/>
</div>

#### 📱 Móvil
<div align="center">
  <img src="1galeria/movil/taller/1.png" alt="Taller Móvil 1" width="23%"/>
  <img src="1galeria/movil/taller/2.png" alt="Taller Móvil 2" width="23%"/>
  <img src="1galeria/movil/taller/3.png" alt="Taller Móvil 3" width="23%"/>
  <img src="1galeria/movil/taller/4.png" alt="Taller Móvil 4" width="23%"/>
  
  <img src="1galeria/movil/taller/5.png" alt="Taller Móvil 5" width="23%"/>
  <img src="1galeria/movil/taller/6.png" alt="Taller Móvil 6" width="23%"/>
  <img src="1galeria/movil/taller/7.png" alt="Taller Móvil 7" width="23%"/>
  <img src="1galeria/movil/taller/8.png" alt="Taller Móvil 8" width="23%"/>
  
  <img src="1galeria/movil/taller/9.png" alt="Taller Móvil 9" width="23%"/>
  <img src="1galeria/movil/taller/10.png" alt="Taller Móvil 10" width="23%"/>
  <img src="1galeria/movil/taller/11.png" alt="Taller Móvil 11" width="23%"/>
  <img src="1galeria/movil/taller/12.png" alt="Taller Móvil 12" width="23%"/>
</div>

### 👤 Panel del Usuario

#### 🖥️ Monitor
<div align="center">
  <img src="1galeria/monitor/usuario/1.png" alt="Usuario Monitor 1" width="45%"/>
  <img src="1galeria/monitor/usuario/2.png" alt="Usuario Monitor 2" width="45%"/>
  
  <img src="1galeria/monitor/usuario/3.png" alt="Usuario Monitor 3" width="45%"/>
  <img src="1galeria/monitor/usuario/4.png" alt="Usuario Monitor 4" width="45%"/>
</div>

#### 💻 Tablet
<div align="center">
  <img src="1galeria/table/usuario/1.png" alt="Usuario Tablet 1" width="45%"/>
  <img src="1galeria/table/usuario/2.png" alt="Usuario Tablet 2" width="45%"/>
  
  <img src="1galeria/table/usuario/3.png" alt="Usuario Tablet 3" width="45%"/>
  <img src="1galeria/table/usuario/4.png" alt="Usuario Tablet 4" width="45%"/>
</div>

#### 📱 Móvil
<div align="center">
  <img src="1galeria/movil/usuario/1.png" alt="Usuario Móvil 1" width="45%"/>
  <img src="1galeria/movil/usuario/2.png" alt="Usuario Móvil 2" width="45%"/>
  
  <img src="1galeria/movil/usuario/3.png" alt="Usuario Móvil 3" width="45%"/>
  <img src="1galeria/movil/usuario/4.png" alt="Usuario Móvil 4" width="45%"/>
</div>

---

## 🚀 Uso del Programa

### Para Talleres
- Registrar clientes, vehículos y siniestros
- Adjuntar documentos y fotos
- Controlar estado de reparaciones
- Comunicación con clientes
- Control de recambios en stock
- Fácil busqueda de los datos

### Para Usuarios
- Ver estado de vehículos a tiempo real
- Recibir notificaciones

---

## 📂 Estructura del Proyecto

```
miracar/
├── app/                  # Lógica de la aplicación
├── bootstrap/            # Archivos de inicio
├── config/               # Configuraciones
├── database/             # Migraciones y seeds
├── public/               # Assets públicos
├── resources/            # Vistas y assets
├── routes/               # Rutas
├── storage/              # Almacenamiento
├── tests/                # Pruebas
└── vendor/               # Dependencias
```

---

## 📚 Documentación

Documentación técnica y diagramas del sistema:

- [📄 Documentación Completa del Proyecto](0documentos/Documentación%20Del%20Proyecto.pdf){:target="_blank"}
- [📊 Diagrama de Casos de Uso](0documentos/Diagrama%20de%20casos%20de%20uso.png){:target="_blank"}
- [🔗 Modelo Entidad-Relación](0documentos/Modelo%20Entidad%20&%20Relación.png){:target="_blank"}
- [🎨 Prototipo de Interfaz](0documentos/Prototipo.jpg){:target="_blank"}

---

## 📜 Licencia

Este proyecto está bajo la [Licencia MIT](LICENSE){:target="_blank"}.

---

## ✉️ Contacto

**Román Rodríguez Martín**  
📧 [adm.96.rrm@gmail.com](mailto:adm.96.rrm@gmail.com)  
🌐 [www.miracar.com](http://www.miracar.com){:target="_blank"} *(en construcción)*

---

## 🔍 Guía Completa de Instalación

### Instalación de XAMPP

1. **Descargar XAMPP** desde [apachefriends.org](https://www.apachefriends.org/es/index.html){:target="_blank"}
2. **Ejecutar instalador** como administrador
3. **Seleccionar componentes**:
   - Apache
   - MySQL
   - PHP
   - phpMyAdmin
4. **Iniciar servicios** desde el panel de control

### Configuración de Laravel

1. **Copiar proyecto** a `htdocs`:
   ```bash
   cp -r miracar/ C:\xampp\htdocs\
   ```

2. **Configurar base de datos**:
   - Restaurar backup SQL via phpMyAdmin
   - O copiar archivos a `mysql/data`

3. **Configurar .env**:
   ```env
   APP_URL=http://localhost/miracar/public
   DB_DATABASE=miracar
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Instalar dependencias**:
   ```bash
   composer install
   php artisan key:generate
   php artisan storage:link
   ```
```