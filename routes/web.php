<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\MeasureController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
Route::get('/', function() {
    return redirect()->route('login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::resource('dashboard/categorias', CategoryController::class)->names('categories')
    ->middleware(['auth:sanctum']);

Route::resource('dashboard/empresas', CompanyController::class)->names('companies')
    ->middleware(['auth:sanctum']);

Route::resource('dashboard/marcas', MarkController::class)->names('marks')
    ->middleware(['auth:sanctum']);

Route::resource('dashboard/unidades_de_medidas', MeasureController::class)->names('measures')
    ->middleware(['auth:sanctum']);

Route::resource('dashboard/proveedores', ProviderController::class)->names('providers')
    ->middleware(['auth:sanctum']);

Route::resource('dashboard/presentacion', PresentationController::class)->names('presentations')
    ->middleware(['auth:sanctum']);

Route::resource('dashboard/lotes', BatchController::class)->names('batches')
    ->middleware(['auth:sanctum']);

Route::resource('dashboard/compañias', CompanyController::class)->names('batches')
    ->middleware(['auth:sanctum']);

Route::resource('dashboard/productos', ProductController::class)->names('products')
    ->middleware(['auth:sanctum']);
    
Route::resource('dashboard/usuarios', UserController::class)->names('users')
    ->middleware(['auth:sanctum']);
 