<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// Essas rotas exigem autenticação
Route::middleware('auth:sanctum')->group(function () {

    // Efetua o login e retorna um token
    Route::post('/logout', [UserController::class, 'logout']);

    // Lista todas as categorias de um usuário
    Route::get('/categorys', [CategoryController::class, 'index']);

    // Cria nova categoria
    Route::post('/categorys', [CategoryController::class, 'store']);

    // Atualiza categoria existente
    Route::put('/categorys/{id}', [CategoryController::class, 'update']);

    // Deleta categoria
    Route::delete('/categorys/{id}', [CategoryController::class, 'destroy']);

    // Lista subcategorias de uma categoria específica
    Route::get('/categorys/{categoryId}/subcategorys', [SubcategoryController::class, 'index']);

    //Cria nova subcategoria dentro de uma categoria
    Route::post('/categorys/{categoryId}/subcategorys', [SubcategoryController::class, 'store']);

    // Atualiza subcategoria existente
    Route::put('/subcategorys/{id}', [SubcategoryController::class, 'update']);

    // Deleta subcategoria
    Route::delete('/subcategorys/{id}', [SubcategoryController::class, 'destroy']);

});

