# Repository pattern en Laravel

El Repository pattern es un patrón de tipo estructural que abstrae las operaciones sobre nuestros modelos-capa persistencia (operaciones CRUD) con la intención de ocultar la implementación de esas operaciones a las capas superiores. Concretamente en Laravel, el repositorio, se puede ver como una capa intermedia de comunicación entre la entrada de peticiones y la persistencia de datos.

# Tabla de contenido

1. [Guía de inicio rápido](#guía-de-inicio-rápido)
2. [Implementación](#implementación)
3. [Agradecimientos](#agradecimientos)

## Guía de inicio rápido

Comenzaremos con una estructura de carpetas. Por ejemplo, si usamos Eloquent, llamémoslo Eloquent. Entonces, la estructura final del archivo debería verse así:
```
--- app
---- Repositories
------ Eloquent
-------- BaseRepository.php
---- Interfaces
------ EloquentRepositoryInterface.php
```

¿Qué son exactamente `BaseRepository.php` y `EloquentRepositoryInterface.php`? Será solo una clase padre que se extenderá a cada clase de implementación del repositorio `Eloquent`. Esta clase almacenará los métodos que son de uso común en cada repositorio.

Ese es nuestro repositorio base. Inyectamos su clase modelo en el constructor y almacenamiento que pueden usarse en cada repositorio `Eloquent`.

Para que nuestra aplicación sepa qué implementación de qué interfaz queremos usar, necesitamos crear un proveedor de servicios de Laravel. Lo llamaremos `RepositoryServiceProvider.php`, así que vamos a escribirlo en nuestra consola:
```bash
php artisan make:provider RepositoryServiceProvider
```

Después de crear este archivo, vamos a abrirlo y agregar la siguiente línea dentro del método `register`:
```php
  $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
```

El último paso es registrar este proveedor de servicios en nuestro `config/app.php`. Abra este archivo y agregue a los proveedores nuestro proveedor `App\Providers\RepositoryServiceProvider::class`.

Ahora nuestra aplicación sabe qué clase debe usar cuando escribimos objetos por sus interfaces. Entonces podemos modificar el constructor de nuestro controlador:
```php
  private $postRepository;

  public function __construct(PostRepositoryInterface $postRepository)
  {
    $this->postRepository = $postRepository;
  }
```

Y si queremos invocar un método de nuestro repositorio, lo demos realizar de la siguiente manera:
```php
  $this->postRepository->all();
```

Nuestra aplicación sabe que estamos buscando la implementación de `App\Repositories\Eloquent\PostRepository.php`.

## Implementación

Para conocer mayor detalle cómo queda cada archivo de nuestra estructura de carpetas que definimos, da click en el siguiente enlace: [Repository pattern en Laravel](RepositoryPatternEnLaravel.md)

## Agradecimientos

Para mayor referencia visitar: 

1. [Repository pattern en Laravel](https://medium.com/@cesiztel/repository-pattern-en-laravel-f66fcc9ea492).
2. [Laravel Repository Pattern – PHP Design Pattern](https://dev.to/asperbrothers/laravel-repository-pattern-how-to-use-why-it-matters-1g9d).