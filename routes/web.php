<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\MeasureController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomizerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProofPaymentController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SettingController;
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

// Rutas de administrador de la pagina
Route::middleware(['auth:sanctum', 'verified', 'CheckMaster'])->group(function ()
{
    Route::resource('dashboard/companies', CompanyController::class)->except('create', 'edit', 'show');
    Route::resource('dashboard/measures', MeasureController::class)->except('create', 'edit', 'show');
    Route::resource('dashboard/users', UserController::class)->except('create', 'edit', 'show');
    Route::resource('dashboard/coins', CoinController::class)->except('create', 'edit', 'show');
    Route::resource('dashboard/paymentMethods', PaymentMethodController::class)->except('create', 'edit', 'show');
    Route::resource('dashboard/vouchers', VoucherController::class)->except('create', 'edit', 'show');
    Route::resource('dashboard/customizers', CustomizerController::class)->except('create', 'edit', 'show');
    Route::resource('dashboard/documents', DocumentController::class)->except('create', 'edit', 'show');
});

// Rutas de administrador de empresa
Route::middleware(['auth:sanctum', 'verified', 'CheckAdmin'])->group(function ()
{
    Route::resource('dashboard/categories', CategoryController::class)->except('create', 'edit', 'show');
    Route::resource('dashboard/marks', MarkController::class)->except('create', 'edit', 'show');
    Route::resource('dashboard/providers', ProviderController::class)->except('create', 'edit', 'show');
    Route::resource('dashboard/customers', CustomerController::class)->except('create', 'edit', 'show');
    Route::resource('dashboard/presentations', PresentationController::class)->except('create', 'edit', 'show');
});

// Rutas de vendedores
Route::middleware(['auth:sanctum', 'verified'])->group(function ()
{
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('dashboard/products', ProductController::class)->except('create', 'edit', 'show');
    Route::resource('dashboard/proofPayments', ProofPaymentController::class)->except('create', 'edit', 'show');
    Route::resource('dashboard/orders', OrderController::class)->except('create', 'edit', 'show');
});
