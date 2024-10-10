<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\AdministradoController as Administrado;
use App\Http\Controllers\Api\V1\CategoriaController as Categoria;
use App\Http\Controllers\Api\V1\NegocioController as Negocio;
use App\Http\Controllers\Api\V1\SubCategoriaController as SubCategoria;

use App\Http\Controllers\Api\V1\AuthController as Usuario;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/v1/administrado', Administrado::class);
    Route::apiResource('/v1/categoria', Categoria::class);
    Route::apiResource('/v1/negocio', Negocio::class);
    Route::apiResource('/v1/subCategoria', SubCategoria::class);
    Route::apiResource('/v1/usuario', Usuario::class);
    
    Route::post('/v1/auth1', [Usuario::class, 'authToken']);
    Route::post('/v1/register',[Usuario::class, 'register1']);

    Route::get('/v1/actividad-economica', [Negocio::class, 'indexActividad']);

    //Route::get('/v1/exportar-excel', [Negocio::class,'exportar']);
});

Route::post('/v1/login1', [Usuario::class, 'login']); // El login no necesita estar protegido por auth:sanctum

Route::get('/v1/exportar-excel/{id}', [Negocio::class,'exportar']);
Route::get('/v1/buscar-negocio', [Negocio::class,'buscar']); 

Route::get('/v1/ver-subcategorias',[SubCategoria::class,'index']);
