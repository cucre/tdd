# Repository pattern en Laravel

El Repository pattern es un patrón de tipo estructural que abstrae las operaciones sobre nuestros modelos-capa persistencia (operaciones CRUD) con la intención de ocultar la implementación de esas operaciones a las capas superiores. Concretamente en Laravel, el repositorio, se puede ver como una capa intermedia de comunicación entre la entrada de peticiones y la persistencia de datos. Las ventajas que le veo a este patrón pueden ser:

* La centralización de la lógica de acceso a los datos facilita el mantenimiento del código.
* La lógica de negocio y de acceso a datos se puede probar por separado.
* Siguiendo el beneficio de programar orientados a interfaces, la implementación es fácilmente reemplazable.
* Las operaciones estarán encapsuladas en un único sitio, por lo que el código es reusable.
* La implementación tiene un único propósito. No habrá lógica de negocio en nuestros repositorios, sólo operaciones sobre la capa de persistencia.

# Tabla de contenido

1. [Implementación](#implementación)
2. [Agradecimientos](#agradecimientos)

## Implementación

Comenzaremos con una estructura de carpetas. Deberíamos comenzar creando una carpeta de repositorio en la carpeta de nuestra aplicación. Dentro de una carpeta recién creada, deberíamos crear otra carpeta con una implementación de repositorios actual. Por ejemplo, si usamos Eloquent, llamémoslo Eloquent. Entonces, la estructura final del archivo debería verse así:
```
-- app
---- Repositories
------ Eloquent
-------- BaseRepository.php
---- Interfaces
------ EloquentRepositoryInterface.php
```

¿Qué son exactamente `BaseRepository.php` y `EloquentRepositoryInterface.php`? Será solo una clase padre que se extenderá a cada clase de implementación del repositorio `Eloquent`. Esta clase almacenará los métodos que son de uso común en cada repositorio. Entonces, la interface `EloquentRepositoryInterface.php` se verá de la siguiente manera:
```php
<?php
namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

/**
* Interface EloquentRepositoryInterface
*
* @package App\Interfaces
*/
interface EloquentRepositoryInterface
{
   /**
    * @param array $attributes
    *
    * @return Model
    */
   public function create(array $attributes): Model;

   /**
    * @param $id
    *
    * @return Model
    */
   public function find($id): ?Model;

   /**
    * @param $attributes
    * @param $id
    *
    * @return Model
    */
   public function update(array $attributes, $id): ?Model;

    /**
    * @param $id
    *
    * @return void
    */
   public function delete($id): void;

   /**
    * @param array $relations
    *
    * @return Model
    */
    public function with(array $relations): ?Model;

    /**
    * @return Model
    */
    public function getModel(): ?Model;
}
```

Y la clase `BaseRepository.php` se verá así:
```php
<?php   

namespace App\Repositories\Eloquent;   

use App\Interfaces\EloquentRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   

class BaseRepository implements EloquentRepositoryInterface 
{     
    /**      
     * @var Model      
     */     
     protected $model;       

    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */     
    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }
 
    /**
    * @param array $attributes
    *
    * @return Model
    */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }
    
    /**
    * @param array $attributes
    * @param $id
    *
    * @return Model
    */
    public function update(array $attributes, $id): ?Model
    {
        $record = $this->model->findOrFail($id);
        $record->update($attributes);

        return $record;
    }

    /**
    * @param $id
    *
    * @return Model
    */
    public function find($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    /**
    * @param $id
    *
    * @return void
    */
    public function delete($id): void
    {
        $this->model->destroy($id);
    }

    /**
    * @return Model
    */
    public function getModel(): ?Model
    {
        return $this->model;
    }

    /**
    * @param array $relations
    *
    * @return Model
    */
    public function with(array $relations): ?Model
    {
        return $this->model->with($relations);
    }
}
```

Ese es nuestro repositorio base. Inyectamos su clase modelo en el constructor y almacenamiento que pueden usarse en cada repositorio `Eloquent`.

Para que nuestra aplicación sepa qué implementación de qué interfaz queremos usar, necesitamos crear un proveedor de servicios de Laravel. Lo llamaremos `RepositoryServiceProvider.php`, así que vamos a escribirlo en nuestra consola:
```bash
php artisan make:provider RepositoryServiceProvider
```

Después de crear este archivo, vamos a abrirlo y deberá de quedar de la siguiente manera:
```php
<?php

namespace App\Providers;

use App\Interfaces\EloquentRepositoryInterface; 
use App\Repositories\Eloquent\BaseRepository; 
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
```

El último paso es registrar este proveedor de servicios en nuestro `config/app.php`. Abra este archivo y agregue a los proveedores nuestro proveedor `App\Providers\RepositoryServiceProvider::class`.

Ahora nuestra aplicación sabe qué clase debe usar cuando escribimos objetos por sus interfaces. Entonces podemos usar esa interface de la siguiente manera en nuestro controlador:
```php
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Interfaces\PostRepositoryInterface;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
       $this->postRepository = $postRepository;
    }

    public function index() 
    {
        $posts = $this->postRepository->all();

        return view('posts.index', compact('posts'));
    }
}
```

Nuestra aplicación sabe que estamos buscando la implementación de `App\Repositories\Eloquent\PostRepository.php`. En caso de que queramos utilizar otra implementación que no sea `Eloquent`, cambiamos `App\Repositories\Eloquent\PostRepository.php` en nuestro proveedor de servicios a, por ejemplo `App\Repositories\Mongo\PostRepository.php`. Nuestra aplicación funcionará de la misma manera que antes, incluso si el motor de datos ha cambiado y no hemos cambiado ni una línea de código en nuestro controlador ni en ningún otro lugar.

Ahora puede agregar nuevos repositorios para los otros modelos que están utilizando en la aplicación.

Finalmente, un resumen de lo que vale la pena señalar al implementar un patrón de repositorio:
* ¡Cada repositorio debe tener su propia interfaz implementada! Nunca cree un repositorio sin implementar su propia interfaz y no cree una interfaz para todos los repositorios. ¡No es una buena práctica!.
* Sería útil si siempre inyectara su repositorio usando `Dependency Injection` en lugar de crear una instancia usando la nueva palabra clave. Como tipo, usa siempre la interfaz, no una implementación. Si inyecta objetos en la clase, es más fácil escribir pruebas unitarias, está advirtiendo `SRP (Single Responsibility Principle - Principio de responsabilidad única)` y el código se ve más limpio.
* Haz que tu código sea reutilizable. Si hay más repositorios que el que utilizan algún método, debe implementar este método en la clase `BaseRepository.php` para evitar el principio `DRY (Don't Repeat Yourself - No repitas)`.
* En tu repositorio, inyecte el modelo en un constructor, no use una clase estática. ¡Al hacerlo, puede simular fácilmente su modelo en sus pruebas unitarias!.

## Agradecimientos

Para mayor referencia visitar: 

1. [Repository pattern en Laravel](https://medium.com/@cesiztel/repository-pattern-en-laravel-f66fcc9ea492).
2. [Laravel Repository Pattern – PHP Design Pattern](https://dev.to/asperbrothers/laravel-repository-pattern-how-to-use-why-it-matters-1g9d).