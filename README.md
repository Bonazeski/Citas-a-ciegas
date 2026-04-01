# Citas a Ciegas

**Citas a Ciegas** es una aplicación web desarrollada en PHP que simula una plataforma de conexión entre personas, permitiendo registrar usuarios, crear perfiles, explorar coincidencias y organizar encuentros de forma estructurada.

El proyecto fue pensado como una práctica de desarrollo web orientada a la construcción de una aplicación con lógica real de interacción entre usuarios, integrando funcionalidades de autenticación, gestión de perfiles y selección de ubicaciones mediante Google Maps.

---

## Vista general

La aplicación permite que los usuarios puedan:

- registrarse e iniciar sesión
- completar y editar su perfil
- visualizar otros perfiles disponibles
- solicitar citas
- organizar encuentros con fecha, hora y ubicación
- seleccionar un punto de encuentro directamente desde un mapa interactivo

---

## Tecnologías utilizadas

- **PHP**
- **MySQL**
- **HTML5**
- **CSS3**
- **Bootstrap 5**
- **JavaScript**
- **Composer**
- **Google Maps API**

---

## Objetivo del proyecto

Este proyecto fue desarrollado con fines académicos y de práctica profesional, aplicando una estructura basada en el patrón **MVC (Modelo - Vista - Controlador)** para organizar mejor la lógica, la presentación y el acceso a datos.

Además, se incorporaron buenas prácticas para publicación en GitHub, como:

- uso de variables de entorno (`.env`)
- protección de credenciales sensibles
- exclusión de archivos privados mediante `.gitignore`
- documentación básica de instalación y estructura

---

## Funcionalidades principales

- Registro de usuarios
- Inicio y cierre de sesión
- Gestión de perfiles personales
- Edición de datos de usuario
- Exploración de perfiles
- Solicitud de citas
- Organización de encuentros
- Integración con Google Maps para ubicación de citas

---

## Estructura del proyecto

```bash
citasaciegas/
│
├── controlador/
├── modelo/
├── vista/
├── config/
├── sql/
├── img/
├── documentacion/
├── vendor/
│
├── .env.example
├── .gitignore
├── composer.json
├── composer.lock
├── README.md
├── LICENSE
```

---

## Instalación local

### 1. Clonar el repositorio

```bash
git clone https://github.com/Bonazeski/Citas-a-ciegas.git
```

### 2. Mover el proyecto a `htdocs`

Si usás XAMPP, colocá la carpeta dentro de:

```bash
xampp/htdocs/
```

### 3. Crear la base de datos

Creá una base de datos en MySQL con el nombre:

```bash
citasaciegas
```

### 4. Importar el script SQL

Importá el archivo ubicado en:

```bash
sql/citasaciegas.sql
```

### 5. Crear el archivo `.env`

Tomá como base el archivo:

```bash
.env.example
```

Y completá tus datos locales de configuración.

### 6. Instalar dependencias

```bash
composer install
```

### 7. Ejecutar Apache y MySQL

Iniciá ambos servicios desde XAMPP y accedé al proyecto desde tu navegador.

---

## Variables de entorno

Este proyecto utiliza variables de entorno para proteger información sensible.

Ejemplo de configuración:

```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=citasaciegas
DB_USER=root
DB_PASS=

GOOGLE_MAPS_API_KEY=tu_api_key_aqui
```

---

## Seguridad

Para evitar exponer datos sensibles en GitHub:

- la conexión a la base de datos se maneja desde `.env`
- la API Key de Google Maps no se sube al repositorio
- el archivo `.env` está excluido mediante `.gitignore`

---

## Estado del proyecto

Proyecto funcional en etapa de mejora y documentación.

---

## Autor

**Luz Nicohol Bonazeski**
