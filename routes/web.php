<?php

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;
use App\Models\Order;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Ruta para obteneer sesion
Route::get('/get_session', function () {
    $user = Auth::check();
    if ($user) {
        // Hay una sesión activa, puedes hacer algo aquí si es necesario.
        $data_user = Auth::user();
        return response()->json(['success'=> true, 'user'=> $data_user]);
    } else {
        // No hay sesión activa.
        return response()->json(['success'=> false, 'message'=> "No hay sesión"]);
    }
});
//funciones de inicio
Route::get('/logout', [UserController::class,'userLogout'])->name('logout');
//funciones de registro
Route::middleware(['superadmin'])->group(function () {
    Route::get('/register', [UserController::class, 'viewRegister'])->name('view.register');
    Route::post('/register', [UserController::class, 'userRegister'])->name('register');
    //Route::get('/create_superadmin', [UserController::class, 'createUser'])->name('crear.superadmin');
});
Route::get('/create_superadmin', [UserController::class, 'createUser'])->name('crear.superadmin');
Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
            return view('auth.home');
    })->name('home');
    //Obtener usuarios de vairas formas
    Route::get('/get_user_filter',[UserController::class, 'getAllUsersForFilter'])->name('get.user.forFilter');
    //Mira panita, quien este haciendo filtro y busqueda en vue la url debe quedar asi:
    Route::get('/get_paginate', [ProductController::class, 'paginateProducts'])->name('get.paginate');
    //Marcas 
    //Este get brands es el de gustavo eso si este ge_all brands me choca en algunas vistas
    //Route::get('/home/all_brands',[BrandsController::class,'viewBrands'])->name('view.brands');
    //este get_brands lo modifico diego, a tento a ello
    Route::get('/home/get_brands',[BrandsController::class,'viewBrands'])->name('get.brands');
    Route::post('/home/create_brand',[BrandsController::class,'createBrand'])->name('create.brand');
    Route::put('/home/update_brand/{id_brand}', [BrandsController::class, 'updateBrand'])->name('update.brand');
    Route::delete('/home/delete_brand/{id_brand}', [BrandsController::class, 'deleteBrand'])->name('delete.brand');
    //Categorias
    //Route::get('/home/all_categories',[CategoriesController::class,'viewCategories'])->name('view.categories');
    Route::get('/home/get_categories',[CategoriesController::class,'viewCategories'])->name('get.categories');
    Route::post('/home/create_category',[CategoriesController::class,'createCategory'])->name('create.category');
    Route::put('/home/update_category/{id_category}', [CategoriesController::class, 'updateCategory'])->name('update.category');
    Route::delete('/home/delete_category/{id_category}', [CategoriesController::class, 'deleteCategory'])->name('delete.category');
    //Proveedores aun no vas en eso estas en categorias
    //el original
    //Route::get('/home/all_providers', [ProvidersController::class, 'viewProviders'])->name('view.providers');
    Route::get('/home/get_providers', [ProvidersController::class, 'viewProviders'])->name('get.providers');
    Route::post('/home/create_provider', [ProvidersController::class, 'createProvider'])->name('create.provider');
    Route::put('/home/update_provider/{id_provider}', [ProvidersController::class, 'updateProvider'])->name('update.provider');
    Route::delete('/home/delete_provider/{id_provider}', [ProvidersController::class, 'deleteProvider'])->name('delete.provider');
    //Productos
    //el original
    //Route::get('/home/all_products', [ProductController::class, 'viewProducts'])->name('view.products');
    Route::get('/home/get_products', [ProductController::class, 'viewProducts'])->name('get.products');
    Route::post('/home/create_product', [ProductController::class, 'createProduct'])->name('create.product');
    Route::put('/home/update_product/{id_product}', [ProductController::class, 'updateProduct'])->name('update.product');
    Route::delete('/home/delete_product/{id_product}', [ProductController::class, 'deleteProduct'])->name('delete.product');
    Route::put('/home/update_stock', [ProductController::class, 'updateStock'])->name('update.stock');
    //Ventas
    Route::post('/home/confirm_purchase',[SalesController::class, 'createSale'])->name('confirm.purchase');
    Route::get('/home/get_sells',[SalesController::class,'getSells'])->name('get.sells');
});

//el que hizo gustavo
 Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
         return view('welcome');
     })->name('welcome');
     //funciones de login y logout
     Route::get('/login', [UserController::class,'userLogin'])->name('login');
 });
Route::get('/{any}', function () {
    return view('welcome'); // Debes apuntar a tu vista principal de Vue aquí
})->where('any', '.*');

//Route::get('/login', [UserController::class,'userLogin'])->name('login');

// Route::middleware(['guest'])->group(function () {
//      Route::get('/', function () {
//          return view('welcome');
//      })->name('welcome');
//     Route::post('/login', [UserController::class, 'userLogin'])->name('login');
// });

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

// Route::post('/login', [UserController::class, 'userLogin'])->name('login');

// Route::get('/{any}', function () {
//     return view('welcome');
// })->where('any', '.*');