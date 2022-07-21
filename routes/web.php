<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\MeasureController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::resource('dashboard/categorias', CategoryController::class)->names('categories');
Route::resource('dashboard/empresas', CompanyController::class)->names('companies');
Route::resource('dashboard/marcas', MarkController::class)->names('marks');
Route::resource('dashboard/unidades_de_medidas', MeasureController::class)->names('measures');

Route::get('/test', function () {
   return Inertia::render('test');
 });
