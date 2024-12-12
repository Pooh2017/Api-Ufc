# API de Gestión de Usuarios y Vehículos

Este proyecto es la API backend para gestionar usuarios y vehículos. La API permite la autenticación de usuarios, administración de vehículos y la creación de usuarios con datos asociados. Está construida con Laravel y tiene rutas para realizar operaciones CRUD (Crear, Leer, Actualizar y Eliminar) tanto de usuarios como de vehículos.

## Características

### 1. Registro de Usuario
Permite el registro de nuevos usuarios, proporcionando su nombre, correo electrónico y contraseña. El registro está disponible a través de la ruta `/register`.

- **Ruta**: `/register`
- **Método**: `POST`
- **Datos**:
  - `nombre`: Nombre completo del usuario.
  - `correo`: Correo electrónico del usuario.
  - `contraseña`: Contraseña segura del usuario.

### 2. Login de Usuario
Permite a los usuarios autenticarse proporcionando su correo electrónico y contraseña.

- **Ruta**: `/login`
- **Método**: `POST`
- **Datos**:
  - `correo`: Correo electrónico del usuario.
  - `contraseña`: Contraseña del usuario.

### 3. Logout de Usuario
Permite al usuario cerrar sesión en el sistema.

- **Ruta**: `/logout`
- **Método**: `POST`

### 4. CRUD de Usuarios
Los administradores pueden crear, obtener, actualizar y eliminar usuarios. Los usuarios tienen los siguientes campos:
- `nombre`: Nombre del usuario.
- `correo`: Correo electrónico del usuario.
- `contraseña`: Contraseña cifrada del usuario.

- **Rutas**:
  - `GET /usuarios`: Obtener todos los usuarios.
  - `GET /usuarios/{id}`: Obtener un usuario específico.
  - `POST /usuarios`: Crear un nuevo usuario.
  - `PUT /usuarios/{id}`: Actualizar un usuario.
  - `DELETE /usuarios/{id}`: Eliminar un usuario.

### 5. CRUD de Vehículos
Los administradores pueden realizar operaciones CRUD sobre los vehículos. Cada vehículo tiene los siguientes atributos:
- `modelo`: Modelo del vehículo.
- `marca`: Marca del vehículo.
- `placa`: Placa del vehículo.
- `foto`: Imagen del vehículo (opcional).
- `precio_dia`: Precio diario de alquiler del vehículo.

- **Rutas**:
  - `GET /vehiculos`: Obtener todos los vehículos.
  - `GET /vehiculos/{id}`: Obtener un vehículo específico.
  - `POST /vehiculos`: Crear un nuevo vehículo.
  - `PUT /vehiculos/{id}`: Actualizar un vehículo.
  - `DELETE /vehiculos/{id}`: Eliminar un vehículo.

## Instalación

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/carlosupreme/api-prograweb.git
Instalar las dependencias:

   
    composer install
Configurar el archivo .env con las credenciales de tu base de datos y otras variables de entorno.

Ejecutar las migraciones para crear las tablas necesarias:

    php artisan migrate

Iniciar el servidor:


    php artisan serve
    
Tecnologías Utilizadas

- Laravel (PHP)
- MySQL (Base de datos)
- JWT (Autenticación de usuarios)
