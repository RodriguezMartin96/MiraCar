<div align="center">
  <h1>MiraCar</h1>
</div>

<div align="center">
  <img src="1galeria/logo.png" alt="MiraCar Logo" width="300" height="400" />
  <h1>🚗 MiraCar</h1>
  <p>Conectando talleres y clientes para una experiencia automotriz moderna, clara y eficiente.</p>

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

## 🚀 Uso del Programa

### Para Talleres
- Registrar clientes, vehículos y siniestros
- Adjuntar documentos y fotos
- Controlar estado de reparaciones
- Comunicación con clientes
- Control de recambios en stock
- Fácil búsqueda de los datos

### Para Usuarios
- Ver estado de vehículos a tiempo real
- Recibir notificaciones

---

## 📚 Documentación

Documentación técnica y diagramas del sistema:

- [Documentación Completa del Proyecto](0documentos/Documentación%20Del%20Proyecto.pdf)
- [Diagrama de Casos de Uso](0documentos/Diagrama%20de%20casos%20de%20uso.png)
- [Modelo Entidad-Relación](0documentos/Modelo%20Entidad%20&%20Relación.png)
- [Prototipo de Interfaz](0documentos/Prototipo.jpg)

---

## 🛠 Tecnologías Utilizadas

| Herramienta              | Propósito                            | Versión  | Enlace |
|--------------------------|--------------------------------------|----------|--------|
| Laravel                  | Framework backend (PHP)              | 12       | -      |
| PHP                      | Lenguaje del servidor                | 8.2      | -      |
| MySQL                    | Base de datos relacional             | 8.0      | -      |
| XAMPP                    | Entorno local (Apache + MySQL + PHP) | 8.2.4    | [Descargar](https://www.apachefriends.org/es/index.html) |
| Composer                 | Gestión de dependencias PHP          | 2.x      | [Instalar](https://getcomposer.org/) |
| Node.js & npm            | Gestión frontend y assets JS         | 18.x     | [Descargar](https://nodejs.org/es) |
| Bootstrap                | Framework CSS responsivo             | 5        | -      |
| Git                      | Control de versiones                 | 2.x      | [Descargar](https://git-scm.com/) |

Compatible con **Windows, macOS y Linux**.

---

## ⚙️ Instalación y Configuración

### Requisitos Previos
- PHP 8.1+
- MySQL 5.7+
- Node.js + npm
- Composer
- Git
- XAMPP o similar

### Instalación de XAMPP
1. **Descargar XAMPP** desde [apachefriends.org](https://www.apachefriends.org/es/index.html)
2. **Ejecutar instalador** como administrador
3. **Seleccionar componentes**:
   - Apache
   - MySQL
   - PHP
   - phpMyAdmin
4. **Iniciar servicios** desde el panel de control

### Configuración del Proyecto
1. **Clonar el repositorio**:
   ```bash
   git clone https://github.com/tuusuario/miracar.git
   cd miracar
   ```

2. **Copiar proyecto** a `htdocs` (opcional):
   ```bash
   cp -r miracar/ C:\xampp\htdocs\
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
   php artisan storage:link
   ```

5. **Configurar base de datos**:
   - Crear una base de datos MySQL llamada `miracar` desde phpMyAdmin ([http://localhost/phpmyadmin](http://localhost/phpmyadmin))
   - Configurar las credenciales en `.env`:
     ```env
     APP_URL=http://localhost/miracar/public
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
   Acceder a [http://localhost:8000](http://localhost:8000)

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

## 🖼️ Capturas de Pantalla

### 🔐📱 Panel de Inicio de Sesión & Registro

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

### 🔧🛠️ Panel del Taller

#### 🖥️ Monitor
<div align="center">
  <img src="1galeria/monitor/taller/1.png" alt="Taller Monitor 1" width="23%"/>
  <img src="1galeria/monitor/taller/2.png" alt="Taller Monitor 2" width="23%"/>
  <img src="1galeria/monitor/taller/3.png" alt="Taller Monitor 3" width="23%"/>
  <img src="1galeria/monitor/taller/4.png" alt="Taller Monitor 4" width="23%"/>
</div>

#### 💻 Tablet
<div align="center">
  <img src="1galeria/table/taller/1.png" alt="Taller Tablet 1" width="23%"/>
  <img src="1galeria/table/taller/2.png" alt="Taller Tablet 2" width="23%"/>
  <img src="1galeria/table/taller/3.png" alt="Taller Tablet 3" width="23%"/>
  <img src="1galeria/table/taller/4.png" alt="Taller Tablet 4" width="23%"/>
</div>

#### 📱 Móvil
<div align="center">
  <img src="1galeria/movil/taller/1.png" alt="Taller Móvil 1" width="23%"/>
  <img src="1galeria/movil/taller/2.png" alt="Taller Móvil 2" width="23%"/>
  <img src="1galeria/movil/taller/3.png" alt="Taller Móvil 3" width="23%"/>
  <img src="1galeria/movil/taller/4.png" alt="Taller Móvil 4" width="23%"/>
</div>

### 👤🚘 Panel del Usuario

#### 🖥️ Monitor
<div align="center">
  <img src="1galeria/monitor/usuario/1.png" alt="Usuario Monitor 1" width="45%"/>
  <img src="1galeria/monitor/usuario/2.png" alt="Usuario Monitor 2" width="45%"/>
</div>

#### 💻 Tablet
<div align="center">
  <img src="1galeria/table/usuario/1.png" alt="Usuario Tablet 1" width="45%"/>
  <img src="1galeria/table/usuario/2.png" alt="Usuario Tablet 2" width="45%"/>
</div>

#### 📱 Móvil
<div align="center">
  <img src="1galeria/movil/usuario/1.png" alt="Usuario Móvil 1" width="45%"/>
  <img src="1galeria/movil/usuario/2.png" alt="Usuario Móvil 2" width="45%"/>
</div>

---

## 📹 Video

<div align="center">
  <a href="https://www.youtube.com/watch?v=TU_ENLACE_DE_VIDEO" target="_blank">
    <img src="1galeria/video-thumbnail.jpg" alt="Video demostrativo de MiraCar" width="60%"/>
    <p>🎥 Ver demostración en YouTube</p>
  </a>
</div>

---

## 📜 Licencia

Este proyecto está bajo la [Licencia MIT](LICENSE).

---

## ✉️ Contacto

**Román Rodríguez Martín**  
📧 [adm.96.rrm@gmail.com](mailto:adm.96.rrm@gmail.com)  
🌐 [www.miracar.com](http://www.miracar.com) *(en construcción)*
```