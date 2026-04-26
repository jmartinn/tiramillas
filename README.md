# Tira Millas

Plataforma colaborativa de turismo rural y cultural en España. Permite descubrir,
crear y compartir rutas, puntos de interés y negocios locales por toda la geografía
española.

Proyecto PIM (Proyecto de Integración Multidisciplinar).

## Requisitos

- PHP **8.2 o superior** con las extensiones `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `curl` y `zip`.
- [Composer](https://getcomposer.org/).
- [Node.js](https://nodejs.org/) con `npm`.
- Acceso a la base de datos compartida en Aiven (la contraseña se comparte por canal privado).

## Puesta en marcha

```bash
# 1. Clonar el repositorio
git clone git@github.com:Loreber/tiramillas.git
cd tiramillas

# 2. Instalar dependencias de PHP
composer install

# 3. Instalar dependencias de JavaScript
npm install

# 4. Crear el archivo de entorno
cp .env.example .env

# 5. Editar .env y rellenar el campo DB_PASSWORD con la contraseña compartida

# 6. Generar la clave de la aplicación
php artisan key:generate

# 7. Crear el enlace simbólico para las imágenes subidas
php artisan storage:link

# 8. Compilar los recursos CSS y JS
npm run build

# 9. Arrancar el servidor de desarrollo
php artisan serve
```

Visitar [http://127.0.0.1:8000](http://127.0.0.1:8000) en el navegador.

## Comandos útiles

```bash
# Servidor de desarrollo con recarga automática del frontend (en otra terminal)
npm run dev

# Volver a compilar los recursos tras cambios de CSS/JS
npm run build

# Listar todas las rutas registradas
php artisan route:list

# Refrescar la base de datos local (solo si no se usa la compartida)
php artisan migrate:fresh --seed
```

## Usuarios de prueba

Todos los usuarios sembrados tienen la contraseña `password`:

- `lorena@tiramillas.test`
- `maria@tiramillas.test`
- `pedro@tiramillas.test`
- `carlos@tiramillas.test`
- `ana@tiramillas.test`
- `sergio@tiramillas.test`

## Estructura del proyecto

```
app/
  Http/
    Controllers/    Controladores (Auth, Ruta, Punto, Negocio, Review, Favorito, Mapa, Home)
    Requests/       Validación de formularios (RutaRequest, PuntoRequest, etc.)
  Models/           Modelos de Eloquent (User, Region, Ruta, Punto, Negocio, Review, Favorito)
  Policies/         Reglas de autorización (solo el autor edita/elimina)
config/             Configuración de Laravel
database/
  certs/            Certificado CA para la conexión SSL con Aiven
  factories/        Factories para generar datos de prueba
  migrations/       Migraciones de las tablas
  seeders/          Seeders con datos reales españoles
  esquema.sql       Esquema completo de la base de datos en SQL plano
lang/es/            Traducciones de los mensajes de validación al castellano
resources/
  css/              Hoja de estilos en CSS plano
  js/               JavaScript de cliente (eventos, mapa, widget de estrellas)
  views/            Vistas Blade
routes/web.php      Definición de rutas HTTP
```

## Notas

- La base de datos vive en Aiven y se comparte entre el equipo. No hace falta tener
  MySQL instalado en local.
- Las imágenes subidas se guardan en `storage/app/public/` y se sirven desde
  `public/storage/` gracias al enlace simbólico creado con `storage:link`.
- Los mapas usan [Leaflet](https://leafletjs.com/) cargado por CDN solo en las páginas
  que lo necesitan (`/mapa` y los formularios de creación/edición).
