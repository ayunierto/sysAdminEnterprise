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

// Rutas de administrador de la pagina
Route::middleware(['auth:sanctum', 'verified', 'CheckMaster'])->group(function ()
{
    Route::resource('dashboard/companies', CompanyController::class);
    Route::resource('dashboard/measures', MeasureController::class);
    Route::resource('dashboard/users', UserController::class);
    Route::resource('dashboard/coins', CoinController::class);
});

// Rutas de administrador de empresa
Route::middleware(['auth:sanctum', 'verified', 'CheckAdmin'])->group(function ()
{
    Route::resource('dashboard/categories', CategoryController::class);
    Route::resource('dashboard/marks', MarkController::class);
    Route::resource('dashboard/providers', ProviderController::class);
    Route::resource('dashboard/customers', CustomerController::class);
    Route::resource('dashboard/presentations', PresentationController::class);
    Route::resource('dashboard/batches', BatchController::class);
});

// Rutas de vendedores
Route::middleware(['auth:sanctum', 'verified'])->group(function ()
{
    Route::resource('dashboard/products', ProductController::class);
    Route::resource('dashboard/proofPayments', ProofPaymentController::class);
});