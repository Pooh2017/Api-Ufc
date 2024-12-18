# 🥋 API de Gestión de Usuarios y Peleadores de la UFC

Este proyecto es una **API RESTful** desarrollada en **Laravel** para la gestión de **usuarios** y **peleadores** de la UFC. Permite realizar operaciones **CRUD** completas sobre ambas entidades, utilizando las mejores prácticas modernas con Laravel.

---

## 🛠️ Tecnologías Utilizadas

- **PHP 8.1+**: Lenguaje principal de programación.
- **Laravel 10.x**: Framework PHP para desarrollo rápido y robusto.
- **MySQL**: Base de datos relacional.
- **Composer**: Gestor de dependencias de PHP.
- **Laravel Sanctum**: Implementación de autenticación mediante tokens API.
- **Node.js & NPM**: Para Laravel Mix (opcional, si hay integración frontend).

---

## 🚀 Instalación y Configuración

### Requisitos

- **PHP >= 8.1**
- **Composer** (para manejar dependencias)
- **Node.js y npm** (opcional, para compilar recursos con Laravel Mix)
- **MySQL** (o cualquier otra base de datos compatible con Laravel)

### Pasos para Instalar

1. **Clonar el Repositorio**
   ```bash
   git clone <url-del-repositorio>
   cd <nombre-del-repositorio>
   ```

2. **Instalar Dependencias con Composer**
   ```bash
   composer install
   ```

3. **Configurar el Archivo `.env`**
   Copia el archivo de ejemplo y configúralo:
   ```bash
   cp .env.example .env
   ```
   Luego configura tus credenciales de base de datos:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nombre_de_base_de_datos
   DB_USERNAME=usuario_mysql
   DB_PASSWORD=contraseña_mysql
   ```

4. **Ejecutar Migraciones y Rellenar la Base de Datos**
   ```bash
   php artisan migrate --seed
   ```

5. **Iniciar el Servidor de Desarrollo**
   ```bash
   php artisan serve
   ```
   La aplicación estará disponible en `http://127.0.0.1:8000`.

6. **Verificar las Rutas Disponibles**
   ```bash
   php artisan route:list
   ```

---

## 📂 Estructura del Proyecto

### **Migraciones**

- **Tabla: users**
  - `id`
  - `name`
  - `email`
  - `password`
  - **Timestamps** (creado/actualizado)

- **Tabla: fighters**
  - `id`
  - `name`
  - `nickname`
  - `division`
  - `wins`, `losses`, `knockouts`, `submissions`
  - `gender` (Masculino o Femenino)
  - `image` (opcional)
  - **Timestamps** (creado/actualizado)

---

### **Modelos**

- **Modelo: User** (Autenticación y gestión de usuarios)
   ```php
   class User extends Authenticatable
   {
       use HasApiTokens, HasFactory, Notifiable;

       protected $fillable = ['name', 'email', 'password'];
       protected $hidden = ['password', 'remember_token'];
   }
   ```

- **Modelo: Fighter** (Gestión de peleadores)
   ```php
   class Fighter extends Model
   {
       use HasFactory;

       protected $fillable = [
           'name', 'nickname', 'division', 'wins', 'losses',
           'knockouts', 'submissions', 'gender', 'image'
       ];
   }
   ```

---

## 🔗 Endpoints Disponibles

### **Autenticación**

| Método | Endpoint     | Descripción              |
|---------|--------------|--------------------------|
| `POST` | `/register`   | Registro de usuarios      |
| `POST` | `/login`      | Inicio de sesión         |
| `POST` | `/logout`     | Cierre de sesión         |

### **Gestión de Usuarios**

| Método | Endpoint         | Descripción                |
|---------|------------------|----------------------------|
| `GET`   | `/users`         | Listar usuarios            |
| `POST`  | `/users`         | Crear un nuevo usuario     |
| `GET`   | `/users/{id}`    | Mostrar un usuario         |
| `PUT`   | `/users/{id}`    | Actualizar un usuario      |
| `DELETE`| `/users/{id}`    | Eliminar un usuario        |

### **Gestión de Peleadores**

| Método | Endpoint           | Descripción                |
|---------|--------------------|----------------------------|
| `GET`   | `/fighters`        | Listar peleadores          |
| `POST`  | `/fighters`        | Crear un nuevo peleador    |
| `GET`   | `/fighters/{id}`   | Mostrar un peleador        |
| `PUT`   | `/fighters/{id}`   | Actualizar un peleador     |
| `DELETE`| `/fighters/{id}`   | Eliminar un peleador       |

---

## 🧩 Ejemplo de Controlador: FighterController

### **Listar Peleadores**
```php
public function index()
{
    return response()->json(Fighter::all(), 200);
}
```

### **Crear un Nuevo Peleador**
```php
public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'nickname' => 'required|string|max:255',
        'division' => 'required|string',
        'wins' => 'integer|min:0',
        'losses' => 'integer|min:0',
        'knockouts' => 'integer|min:0',
        'submissions' => 'integer|min:0',
        'gender' => 'required|in:Masculino,Femenino',
        'image' => 'nullable|url',
    ]);

    $fighter = Fighter::create($data);
    return response()->json($fighter, 201);
}
```

### **Actualizar un Peleador**
```php
public function update(Request $request, Fighter $fighter)
{
    $data = $request->validate([
        'name' => 'string|max:255',
        'nickname' => 'string|max:255',
        'division' => 'string',
        'wins' => 'integer|min:0',
        'losses' => 'integer|min:0',
        'knockouts' => 'integer|min:0',
        'submissions' => 'integer|min:0',
        'gender' => 'in:Masculino,Femenino',
        'image' => 'url',
    ]);

    $fighter->update($data);
    return response()->json($fighter);
}
```

---

## 🎯 Resultado Final

Con esta API puedes:

1. **Gestionar usuarios**: Registro, autenticación y CRUD completo.
2. **Gestionar peleadores**: Crear, listar, actualizar y eliminar registros.
3. **Autenticación segura**: Tokens de autenticación con Laravel Sanctum.

---

## 🤝 Contribución

Si deseas contribuir a este proyecto, sigue estos pasos:
1. Haz un fork del repositorio.
2. Crea una rama con tus cambios:
   ```bash
   git checkout -b feature/mi-mejora
   ```
3. Envía un Pull Request.

---

##


