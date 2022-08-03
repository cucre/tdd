<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
/*use App\Http\Controllers\StatusController;
use App\Services\Workflow\Facade\WorkflowFacade;*/

// use App\Services\Workflow\PPBWorkflow;
// use App\Services\Workflow\SupervisionWorkflow;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });

//Auth::routes();
/*Route::get('/', function () {
    return view('welcome');
});*/



//Route::get('/ppb', function () {
    // Acceso tradicional instanciando el workflow
        /*$filtros = [
            "taxonomia" => 704,
            "delegacion" => 2
        ];
        $ppbWorkflow = new PPBWorkflow($filtros);
        return $ppbWorkflow->iniciarCaso(); */

    //Usando el subsistema o servicios Workflow directamente
      //return app(App\Services\Workflow\PPBWorkflow::class)->iniciarCaso();

    // Usando el subsistema o servicio Workflow mediante el Service Provider
       //return app('workflow')->iniciarCaso();

    //Usando el subsistema o servicio Workflow mediante el Facade
      //return Workflow::iniciarCaso();

//});

//Route::get('/supervision', function () {

    // Acceso tradicional instanciando el workflow
        /*$filtros = [
            "taxonomia" => 704,
            "delegacion" => 2
        ];
        $supervisionWorkflow = new SupervisionWorkflow($filtros);
        return $supervisionWorkflow->iniciarCaso(); */

    //Usando el subsistema o servicios Workflow directamente
      //return app(App\Services\Workflow\SupervisionWorkflow::class)->iniciarCaso();

    // Usando el subsistema o servicio Workflow mediante el Service Provider
       //return app('workflow')->iniciarCaso();

    // Usando el subsistema o servicio Workflow mediante el Facade
       //return Workflow::iniciarCaso();

//});

/*Route::get('ppb/predio/incentivo/calcular', 'App\Http\Controllers\PPB\PPBController@calcularIncentivo');
Route::get('ppb/predio/ratificar', 'App\Http\Controllers\PPB\PPBController@ratificacion');


Route::get('supervision/cuestionario/crear', 'App\Http\Controllers\Supervision\SupervisionController@crearCuestionario');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->post('statuses', [StatusController::class, 'store'])->name('statuses.store');*/


// Route::post('posts', [PostController::class, 'store'])->name('posts.store');
// Route::get('posts', [PostController::class, 'index'])->name('posts.index');
// Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
// Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
// Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::resource('posts', PostController::class);