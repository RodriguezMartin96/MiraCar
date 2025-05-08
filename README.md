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
| [XAMPP](https://www.apachefriends.org/es/index.html) | Entorno local (Apache + MySQL + PHP) | 8.2.4    | [Descargar](https://www.apachefriends.org/es/index.html) |
| [Composer](https://getcomposer.org/) | Gestión de dependencias PHP          | 2.x      | [Instalar](https://getcomposer.org/) |
| [Node.js](https://nodejs.org/es) | Gestión frontend y assets JS         | 18.x     | [Descargar](https://nodejs.org/es) |
| Bootstrap                | Framework CSS responsivo             | 5        | -      |
| [Git](https://git-scm.com/) | Control de versiones                 | 2.x      | [Descargar](https://git-scm.com/) |

*Nota: Todos los enlaces se abren en nueva pestaña*

Compatible con **Windows, macOS y Linux**.

---

## ⚙️ Instalación y Configuración

### Requisitos Previos
- PHP 8.1+
- MySQL 5.7+
- [Node.js](https://nodejs.org/es) + npm
- [Composer](https://getcomposer.org/)
- [Git](https://git-scm.com/)
- [XAMPP](https://www.apachefriends.org/es/index.html) o similar

### Pasos de Instalación

1. **Instalar XAMPP** (entorno de desarrollo local):
   - Descargar XAMPP desde [Apache Friends](https://www.apachefriends.org/es/index.html)
   - Ejecutar el instalador como administrador
   - Seleccionar componentes esenciales:
     - **Apache** (servidor web)
     - **MySQL** (base de datos)
     - **PHP** (versión 8.2+ recomendada)
     - **phpMyAdmin** (opcional para gestión de bases de datos)
   - Completar la instalación y abrir el panel de control
   - Iniciar los servicios de **Apache** y **MySQL**

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
   - Crear base de datos `miracar` en phpMyAdmin ([http://localhost/phpmyadmin](http://localhost/phpmyadmin))
   - Configurar `.env`:
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
   Acceder a [http://localhost:8000](http://localhost:8000)

---

## 🖼️ Capturas de Pantalla

### Panel de Inicio de Sesión & Registro

#### Monitor
<div align="center">
  <img src="1galeria/monitor/general/1.png" alt="General Monitor 1" width="45%"/>
  <img src="1galeria/monitor/general/5.png" alt="General Monitor 2" width="45%"/>
  
  <img src="1galeria/monitor/general/2.png" alt="General Monitor 3" width="30%"/>
  <img src="1galeria/monitor/general/3.png" alt="General Monitor 4" width="30%"/>
  <img src="1galeria/monitor/general/4.png" alt="General Monitor 5" width="30%"/>
</div>

#### Tablet
<div align="center">
  <img src="1galeria/table/general/1.png" alt="General Tablet 1" width="45%"/>
  <img src="1galeria/table/general/5.png" alt="General Tablet 2" width="45%"/>
  
  <img src="1galeria/table/general/2.png" alt="General Tablet 3" width="30%"/>
  <img src="1galeria/table/general/3.png" alt="General Tablet 4" width="30%"/>
  <img src="1galeria/table/general/4.png" alt="General Tablet 5" width="30%"/>
</div>

#### Móvil
<div align="center">
  <img src="1galeria/movil/general/1.png" alt="General Móvil 1" width="45%"/>
  <img src="1galeria/movil/general/5.png" alt="General Móvil 2" width="45%"/>
  
  <img src="1galeria/movil/general/2.png" alt="General Móvil 3" width="30%"/>
  <img src="1galeria/movil/general/3.png" alt="General Móvil 4" width="30%"/>
  <img src="1galeria/movil/general/4.png" alt="General Móvil 5" width="30%"/>
</div>

---

## 🚀 Uso del Programa

### Para Talleres
- Registrar clientes, vehículos y siniestros
- Adjuntar documentos y fotos
- Controlar estado de reparaciones
- Comunicación con clientes
- Gestión de inventario
- Búsqueda avanzada de datos

### Para Usuarios
- Seguimiento en tiempo real
- Notificaciones automáticas
- Historial de servicios
- Documentación digitalizada

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

- [Documentación Completa](0documentos/Documentación%20Del%20Proyecto.pdf)
- [Diagrama de Casos de Uso](0documentos/Diagrama%20de%20casos%20de%20uso.png)
- [Modelo Entidad-Relación](0documentos/Modelo%20Entidad%20&%20Relación.png)
- [Prototipo de Interfaz](0documentos/Prototipo.jpg)

---

## 📜 Licencia

[MIT License](LICENSE) © 2023 MiraCar

---

## ✉️ Contacto

**Equipo MiraCar**  
📧 [contacto@miracar.com](mailto:contacto@miracar.com)  
🌐 [www.miracar.com](http://www.miracar.com)