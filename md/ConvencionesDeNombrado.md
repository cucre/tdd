# Convenciones de nombrado

En el mundo de la programación hay muchos estilos que se emplean para reemplazar los ***espacios ( )*** de las palabras a la hora de definir elementos tales como nombres de variables, funciones, clases, codificar urls, etc. Algunas de las más utilizadas son las siguientes:

**1. camelCase**

Este estilo elimina los espacios aplicando una mayúscula para juntar la palabra siguiente. Notar que la primera letra va siempre en minúscula. El nombre viene por la forma de la joroba de un camello / \ / \ (camel).

>Bien: estoEstaBien.
>Mal: EstoNoEsCorrecto, esto_tampoco

**2. PascalCase**

También llamado StudlyCase. Es muy similar al anterior, solo que en este caso la primera letra va en mayúscula. El nombre proviene del lenguaje de programación.

>Bien: EstoEstaBien
>Mal: estoYaNo, esto_menos

**3. snake_case**

En este estilo, se reemplazan los espacios por sub-guiones (_), todo el texto se escribe en minúsculas. Tal como indica su nombre, se le llama así por la similitud con el movimiento de las serpientes.

>Bien: esto_esta_bien.
>Mal: estoNo, EstoMuchoMenos, ni-hablar-de-esto-otro.

**4. kebab-case**

Este estilo es similar al anterior (snake_case) teniendo como única diferencia la utilización de guiones (-) en lugar de los sub-guiones. De este modo el texto toma la forma de una brocheta, de ahí el origen del nombre (kebab).

>Bien: ahora-si-me-toco-a-mi
>Mal: EstoNoEstaBien, estoMuchoMenos, este_se_parece_pero_noup

## Mejores prácticas - Nomenclatura Microservicios (Laravel)

**1. Nombrando a los Controllers**

Los controladores deben estar en singular, sin espacios entre palabras, la primera letra de cada palabra debe ser mayúscula (PascalCase) y deben terminar con la palabra Controller.

>Bien: UserController, CreatePostController, BlogController
>Mal: UsersController, User, usercontroller

**2. Nombrando a los Métodos (Funciones)**

Los métodos en tus proyectos deben ser camelCase, pero con el primer carácter en minúscula (camelCase).

>Bien: public function get(), public function getAll()
>Mal: public function GetPosts(), public function get_posts()

**3. Nombrando Variables**

Las variables normales deben estar en camelCase (pero con primera letra en minúscula) - camelCase.

>Bien: $user, $allPosts
>Mal: $User, $all_posts

Por otro lado, si la variable es un array o una colección de elementos, la variable debe estar en plural. De lo contrario, debería estar en singular.

>Bien: $users = User::all(), $user = User::first()
>Mal: $user = User::all(), $users = User::first()

**4. Nomenclatura para Modelos**

Los modelos deben estar en singular, sin espacios entre palabras y en mayúscula (PascalCase).

>Bien: User, ForumThread,Comment
>Mal: Users, ForumPosts, blogpost, blog_post, Blog_posts

  - **Propiedades de los Modelos**
  Los nombres de los atributos tanto los recibidos de la base de datos como los computados, deben ser nombrados siguiendo snake_case:

    >Bien: $user->name, $order->created_at
    >Mal: $invoice->createdAt, $book->LaunchDate

  - **Métodos de los modelos**
  El resto de métodos del modelo siguen las mismas reglas que el nombrado de una función común: camelCase. Esto se aplica para los accesores, mutadores, query scopes, etc.

**5. Nomenclatura para Relaciones**
- **Relaciones hasOne y belongsTo**
Estos deben estar en singular y seguir las mismas convenciones de nomenclatura de los métodos del modelo (camelCase, con primera letra en minúscula).

  >Por ejemplo: public function postAuthor(), public function phone()

- **Relaciones hasMany, belongsToMany, hasManyThrough**
Su nomenclatura debe ser igual a las anteriores, pero deben estar en plural (camelCase, con primera letra en minúscula).

  >Por ejemplo: public function comments(), public function roles()

- **Relaciones Polimorfas**
Para estas relaciones es recomendable utilizar la nomenclatura que nos recomienda Laravel. Si por ejemplo, tenemos este código:

  ```php
  public function category()
  {
      return $this->morphMany(Category::class, 'categoryable');
  }
  ```

  Laravel asumirá que tenemos una columna categoryable_id y otra llamada  categoryable_type.

**6. Archivos Blade**

Los archivos blade deben estar en minúsculas, snake_case (subrayado entre palabras). Y, si son templates de elementos que normalmente se renderizan por medio de una interación (con **@foreach**, por ejemplo), se les debe agregar un guión bajo al comienzo.

>Por ejemplo: all.blade.php, _item.blade.php

**7. Rutas**

Los sustantivos en las rutas deben ser indicadas en plural, aplicando durante todo esto kebab-case.

>Bien: /customers/23, /orders
>Mal: user/15

**8. Pruebas**

Para nombrar los métodos de prueba ante pondremos test, el resto del nombre debe ser una descripción del tipo de prueba que se realice, siguiendo lo ya mencionado en la sección métodos (funciones). Para el estilo nombrado se emplea snake_case.

>Bien: test_create_and_assign_roles_to_a_user()
>Mal: getUserOderHistory(), testGetUserOrderHistory()