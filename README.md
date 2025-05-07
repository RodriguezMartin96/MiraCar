<div align="center">
  <img src="galeria/logo.png" alt="MiraCar Logo" width="300" height="400" />
  <h1>🚗 MiraCar</h1>
  <p>Conectando talleres y clientes para una experiencia automotriz moderna, clara y eficiente.</p>

  <div>
    <a href="#-qué-es-miracar">¿Qué es MiraCar?</a> •
    <a href="#-tecnologías-utilizadas">Tecnologías</a> •
    <a href="#%EF%B8%8F-instalación">Instalación</a> •
    <a href="#-guía-xampp">Guía XAMPP</a> •
    <a href="#%EF%B8%8F-capturas">Capturas</a> •
    <a href="#-uso">Uso</a> •
    <a href="#-contacto">Contacto</a>
  </div>
  <br/>
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

## ❓ ¿Qué es MiraCar?

**MiraCar** es una aplicación web multiplataforma que conecta talleres automotrices con sus clientes, mejorando la comunicación, la gestión de reparaciones y la trazabilidad del historial de vehículos. El sistema es responsivo y adaptable a cualquier dispositivo, orientado tanto a talleres como a usuarios finales.

---

## 🛠 Tecnologías Utilizadas

| Herramienta | Propósito |
|-------------|-----------|
| **Laravel 10** | Framework backend (PHP) |
| **PHP 8.2** | Lenguaje del servidor |
| **MySQL** | Base de datos relacional |
| **XAMPP** | Entorno local (Apache + MySQL + PHP) |
| **Bootstrap 5.3** | Framework CSS responsivo |
| **Node.js & npm** | Gestión frontend |
| **Composer** | Gestión de dependencias PHP |
| **Git** | Control de versiones |

Compatible con **Windows, macOS y Linux**.

---

## ⚙️ Instalación

### Requisitos Previos
- PHP 8.1+, MySQL 5.7+, Node.js, Composer, Git, XAMPP

### Pasos Básicos

```bash
# Clonar el proyecto
git clone https://github.com/tuusuario/miracar.git
cd miracar

# Instalar dependencias
composer install
npm install && npm run build

# Configurar entorno
cp .env.example .env
php artisan key:generate
php artisan migrate --seed

# Iniciar servidor
php artisan serve
```

---

## 📚 Guía XAMPP

### Instalación Rápida

1. **Descargar XAMPP**: Visita [apachefriends.org](https://www.apachefriends.org/download.html)
2. **Instalar**: Ejecuta el instalador como administrador
3. **Componentes mínimos**: Apache, MySQL, PHP, phpMyAdmin
4. **Iniciar servicios**: Usa el panel de control para iniciar Apache y MySQL


### Restaurar Proyecto Laravel

1. **Copiar código**: Coloca el proyecto en `C:\xampp\htdocs\`
2. **Restaurar base de datos**: Usa phpMyAdmin para importar
3. **Configurar .env**:

```plaintext
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=miracar
DB_USERNAME=root
DB_PASSWORD=
```


4. **Instalar dependencias**: `composer install`
5. **Generar clave**: `php artisan key:generate`


### Solución de Problemas Comunes

- **MySQL no inicia**: Verifica que el puerto 3306 esté libre
- **Apache no inicia**: Verifica puertos 80/443 o cambia en httpd.conf
- **vendor/autoload.php no encontrado**: Ejecuta `composer install`
- **Redirecciones incorrectas**: Verifica .htaccess y mod_rewrite


---

## 🖼️ Capturas

### 📂 General

#### 🖥️ Monitor

















#### 💻 Tablet

















#### 📱 Móvil

















### 🔧 Taller

#### 🖥️ Monitor






































#### 💻 Tablet






































#### 📱 Móvil






































### 👤 Usuario

#### 🖥️ Monitor














#### 💻 Tablet














#### 📱 Móvil














---

## 🚀 Uso

### Para el Taller:

- Registro de clientes, vehículos y siniestros
- Gestión de documentos y fotos
- Control de estado de reparaciones
- Comunicación con clientes


### Para el Usuario:

- Seguimiento de reparaciones
- Acceso a documentación
- Recepción de notificaciones


---

## 📜 Licencia

Este proyecto está bajo la Licencia MIT.

---

## ✉️ Contacto

Proyecto desarrollado por **Román Rodríguez Martín**

📧 Correo: [adm.96.rrm@gmail.com](mailto:adm.96.rrm@gmail.com)

🌐 Sitio: [www.miracar.com](http://www.miracar.com) *(en construcción)*