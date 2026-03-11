<?php 
 
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route; 
 
// Une seule ligne génère les 5 routes CRUD 
// Route::apiResource('products', ProductController::class); 

// Route::get('/products',[ProductController::class,'index']);
// Route::post('/products',[ProductController::class,'store']);

// Route::get('/todos',[TodoController::class,'index']);
// Route::post('/todos',[TodoController::class,'store']);
// Route::get('/todos/{id}',[TodoController::class,'show']);
// Route::put('/todos/{id}',[TodoController::class,'update']);
// Route::delete('/todos/{id}',[TodoController::class,'destroy']);

// Route::apiResource('todos', TodoController::class);

// Route::patch('/todos/{id}/complete',[TodoController::class,'patched']);

Route::apiResource('loans', LoanController::class);
Route::patch('/loans/{id}/return',[LoanController::class,'patched']);

// Route::post('/loans',[LoanController::class,'store']);

// Équivaut à : 
// GET    /api/products          → index()   (liste) 
// POST   /api/products          → store()   (créer) 
// GET    /api/products/{id}     → show()    (détail) 
// PUT    /api/products/{id}     → update()  (modifier) 
// DELETE /api/products/{id}     → destroy() (supprimer) 