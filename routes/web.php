<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\MeasureController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProofPaymentController;
use App\Http\Controllers\UserController;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProofPayment;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
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

    $company_id = Auth::user()->companies_id;

    return Inertia::render('Dashboard', [
        'products' => Product::where('companies_id', $company_id)->count(),
        'company' => Company::find( $company_id ),
    ]);
})->name('dashboard');

Route::resource('dashboard/categorias', CategoryController::class)->names('categories')
    ->middleware(['auth:sanctum', 'verified', 'CheckAdmin']);

Route::resource('dashboard/empresas', CompanyController::class)->names('companies')
    ->middleware(['auth:sanctum', 'verified', 'CheckMaster']);

Route::resource('dashboard/marcas', MarkController::class)->names('marks')
    ->middleware(['auth:sanctum', 'verified', 'CheckAdmin']);

Route::resource('dashboard/unidades_de_medidas', MeasureController::class)->names('measures')
    ->middleware(['auth:sanctum', 'verified', 'CheckMaster']);

Route::resource('dashboard/proveedores', ProviderController::class)->names('providers')
    ->middleware(['auth:sanctum', 'verified', 'CheckAdmin']);

Route::resource('dashboard/clientes', CustomerController::class)->names('customers')
    ->middleware(['auth:sanctum', 'verified', 'CheckAdmin']);

Route::resource('dashboard/presentacion', PresentationController::class)->names('presentations')
    ->middleware(['auth:sanctum', 'verified', 'CheckAdmin']);

Route::resource('dashboard/lotes', BatchController::class)->names('batches')
    ->middleware(['auth:sanctum', 'verified', 'CheckAdmin']);

Route::resource('dashboard/productos', ProductController::class)->names('products')
    ->middleware(['auth:sanctum', 'verified']);

Route::resource('dashboard/comprobantes_pago', ProofPaymentController::class)->names('proofPayments')
    ->middleware(['auth:sanctum', 'verified']);
    
Route::resource('dashboard/usuarios', UserController::class)->names('users')
    ->middleware(['auth:sanctum', 'verified', 'CheckMaster']);
 