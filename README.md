
# 🚗 MiraCar

<div align="center">
  <img src="public/galeria/logo.png" alt="MiraCar Logo" width="150" />
  <h1>MiraCar</h1>
  <p>Conectando talleres y clientes para una experiencia automotriz moderna, clara y eficiente.</p>
</div>

---

## ❓ ¿Qué es MiraCar?

**MiraCar** es una aplicación web desarrollada para gestionar la relación entre talleres mecánicos y sus clientes. Permite al taller controlar procesos de reparación, clientes y documentación, y al usuario seguir el estado de su vehículo en tiempo real. Es completamente responsive, compatible con móvil, tablet y escritorio.

---

## 🛠 Tecnologías Utilizadas

| Herramienta     | Descripción                                   |
|-----------------|-----------------------------------------------|
| **Laravel 10**  | Framework PHP backend                         |
| **PHP 8.2**     | Lenguaje del lado del servidor                |
| **MySQL 8.0**   | Sistema de gestión de bases de datos          |
| **XAMPP**       | Servidor local para PHP y MySQL en Windows    |
| **Composer**    | Gestor de dependencias PHP                    |
| **Node.js**     | Entorno JS para desarrollo frontend           |
| **npm**         | Gestor de paquetes de Node.js                 |
| **Git**         | Control de versiones del código fuente        |
| **Bootstrap 5** | Framework CSS responsive                      |

Compatible con **Windows**, y también funcional en **Linux** y **macOS**.

---

## ⚙️ Instalación

### Requisitos

- PHP 8.1 o superior
- Node.js 18.x y npm
- Composer 2.x
- Git
- XAMPP (o equivalente)

### Pasos

```bash
git clone https://github.com/tuusuario/miracar.git
cd miracar

composer install
npm install
npm run build

cp .env.example .env
php artisan key:generate
php artisan migrate --seed

php artisan serve
```

---

## 🖼️ Capturas de Pantalla

### 📂 General (6 capturas)

#### 📱 Móvil
- ![General Móvil 1](<captura-de-pantalla>)
- ![General Móvil 2](<captura-de-pantalla>)

#### 💻 Tablet
- ![General Tablet 1](<captura-de-pantalla>)
- ![General Tablet 2](<captura-de-pantalla>)

#### 🖥️ Monitor
- ![General Monitor 1](<captura-de-pantalla>)
- ![General Monitor 2](<captura-de-pantalla>)

---

### 🔧 Taller (36 capturas)

#### 📱 Móvil
- ![Taller Móvil 1](<captura-de-pantalla>)
- ![Taller Móvil 2](<captura-de-pantalla>)
- ![Taller Móvil 3](<captura-de-pantalla>)
- ![Taller Móvil 4](<captura-de-pantalla>)
- ![Taller Móvil 5](<captura-de-pantalla>)
- ![Taller Móvil 6](<captura-de-pantalla>)
- ![Taller Móvil 7](<captura-de-pantalla>)
- ![Taller Móvil 8](<captura-de-pantalla>)
- ![Taller Móvil 9](<captura-de-pantalla>)
- ![Taller Móvil 10](<captura-de-pantalla>)
- ![Taller Móvil 11](<captura-de-pantalla>)
- ![Taller Móvil 12](<captura-de-pantalla>)

#### 💻 Tablet
- ![Taller Tablet 1](<captura-de-pantalla>)
- ![Taller Tablet 2](<captura-de-pantalla>)
- ![Taller Tablet 3](<captura-de-pantalla>)
- ![Taller Tablet 4](<captura-de-pantalla>)
- ![Taller Tablet 5](<captura-de-pantalla>)
- ![Taller Tablet 6](<captura-de-pantalla>)
- ![Taller Tablet 7](<captura-de-pantalla>)
- ![Taller Tablet 8](<captura-de-pantalla>)
- ![Taller Tablet 9](<captura-de-pantalla>)
- ![Taller Tablet 10](<captura-de-pantalla>)
- ![Taller Tablet 11](<captura-de-pantalla>)
- ![Taller Tablet 12](<captura-de-pantalla>)

#### 🖥️ Monitor
- ![Taller Monitor 1](<captura-de-pantalla>)
- ![Taller Monitor 2](<captura-de-pantalla>)
- ![Taller Monitor 3](<captura-de-pantalla>)
- ![Taller Monitor 4](<captura-de-pantalla>)
- ![Taller Monitor 5](<captura-de-pantalla>)
- ![Taller Monitor 6](<captura-de-pantalla>)
- ![Taller Monitor 7](<captura-de-pantalla>)
- ![Taller Monitor 8](<captura-de-pantalla>)
- ![Taller Monitor 9](<captura-de-pantalla>)
- ![Taller Monitor 10](<captura-de-pantalla>)
- ![Taller Monitor 11](<captura-de-pantalla>)
- ![Taller Monitor 12](<captura-de-pantalla>)

---

### 👤 Usuario (12 capturas)

#### 📱 Móvil
- ![Usuario Móvil 1](<captura-de-pantalla>)
- ![Usuario Móvil 2](<captura-de-pantalla>)
- ![Usuario Móvil 3](<captura-de-pantalla>)
- ![Usuario Móvil 4](<captura-de-pantalla>)

#### 💻 Tablet
- ![Usuario Tablet 1](<captura-de-pantalla>)
- ![Usuario Tablet 2](<captura-de-pantalla>)
- ![Usuario Tablet 3](<captura-de-pantalla>)
- ![Usuario Tablet 4](<captura-de-pantalla>)

#### 🖥️ Monitor
- ![Usuario Monitor 1](<captura-de-pantalla>)
- ![Usuario Monitor 2](<captura-de-pantalla>)
- ![Usuario Monitor 3](<captura-de-pantalla>)
- ![Usuario Monitor 4](<captura-de-pantalla>)

---

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

## 📁 Estructura del Proyecto

```
miracar/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
│   └── galeria/
├── resources/
│   └── views/
├── routes/
├── storage/
├── tests/
├── .env
├── artisan
├── composer.json
├── package.json
└── README.md
```

---

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Puedes:
1. Hacer un fork del repositorio.
2. Crear una nueva rama (`git checkout -b mejora-x`).
3. Realizar tus cambios.
4. Enviar un Pull Request.

---

## 📜 Licencia

Este proyecto está bajo la Licencia MIT. Revisa el archivo LICENSE para más información.

---

## ✉️ Contacto

Proyecto desarrollado por **Román Rodríguez Martín**  
📧 Correo: roman@ejemplo.com  
🌐 Sitio: [www.miracar.com](https://www.miracar.com) *(en construcción)*
