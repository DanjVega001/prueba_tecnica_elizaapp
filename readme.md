# 📌 Prueba Técnica - Documentación

## 🚀 Instalación y Ejecución

### 🔹 Opción 1: Ejecutar con Docker (Recomendada)

Para ejecutar el proyecto utilizando Docker, sigue estos pasos:

1. **Clona el repositorio:**
   ```sh
   git clone https://github.com/DanjVega001/prueba_tecnica_elizaapp.git
   cd prueba_tecnica_elizaapp
   ```

2. **Copia el archivo de variables de entorno:**
   ```sh
   cp .env.example .env
   ```

   **O si usas Windows solo cambia el nombre del .env.example a .env**

3. **Levanta los contenedores con Docker Compose:**
   ```sh
   docker compose up -d --build
   ```

4. **Accede a la aplicación:**  
   - Backend API: `http://localhost:80`
   
5. Para detener los contenedores:
   ```sh
   docker compose down
   ```

---

### 🔹 Opción 2: Ejecutar sin Docker (PHP + MySQL + Servidor Embebido)

Si prefieres ejecutar la prueba técnica sin Docker, sigue estos pasos:

#### **1️⃣ Instalación de dependencias**

1. **Clona el repositorio:**
   ```sh
   git clone https://github.com/DanjVega001/prueba_tecnica_elizaapp.git
   cd prueba_tecnica_elizaapp
   ```

2. **Configura el archivo de entorno:**
   ```sh
   cp .env.example .env
   ```

    **O si usas Windows solo cambia el nombre del .env.example a .env**


3. **Edita el archivo `.env` y configura la conexión a la base de datos:**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=prueba_tecnica
   DB_USERNAME=root
   DB_PASSWORD=password
   ```

4. **Crea la base de datos en MySQL:**
   ```sql
   CREATE DATABASE prueba_tecnica;
   ```

#### **2️⃣ Ejecución del servidor embebido**

Para levantar la aplicación, ejecuta:
```sh
php -S localhost:8000 -t app
```

La API estará disponible en: `http://localhost:8000`

---

## 🏗️ Arquitectura del Proyecto

El proyecto sigue una arquitectura basada en MVC con separación de responsabilidades:

```
prueba_tecnica/
│── app/
│   ├── api/
│   │   ├── task/
│   │   │   ├── Task.php          # Modelo de la tarea
│   │   │   ├── TaskController.php # Controlador de tareas
│   │   │   ├── TaskModel.php      # Acceso a la base de datos
|   |   ├── completed_task.php      # Implementa la lógica del completar la tarea      
|   |   ├── create_task.php         # Implementa la lógica del crear la tarea  
|   |   ├── delete_task.php         # Implementa la lógica del eliminar la tarea  
|   |   ├── get_tasks.php           # Implementa la lógica del traer las tarea  
|   |   ├── update_task.php         # Implementa la lógica del actualizar la tarea  
│   ├── database/
│   │   ├── database.php       # Conexión a la base de datos
│   │   ├── migration.php      # Migraciones
│   │──frontend/
│   |   ├── assets/                     # Imágenes y recursos
│   |   ├── css/                         # Hojas de estilo
│   |   ├── js/
│   │   |   ├── completed_task.js        # Lógica de completado de tareas
│   │   |   ├── create_task.js           # Creación de tareas
│   │   |   ├── delete_task.js           # Eliminación de tareas
│   │   |   ├── get_tasks.js             # Obtener tareas
│   │   |   ├── update_task.js           # Actualizar tareas
│   ├── index.php                    # Punto de entrada de la aplicación
│── nginx/
│   ├── nginx.conf                    # Configuración de Nginx
│── .env                               # Variables de entorno
```

Esta estructura permite mantener el código modular y escalable. Se implementa un **Modelo de Datos Relacional** con **PHP y PDO** para el acceso a la base de datos y **JavaScript Vanilla** en el frontend.

---

## ✅ Notas Finales
- Asegúrate de tener **PHP 8+, MySQL 8+** instalado si ejecutas sin Docker.
- Si usas Docker, recuerda liberar los puertos usados en el docker-compose.yml para la ejecución del proyecto.
- Si no usas Docker recuerda habilitar extensión de PDO para MySQL
