<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// rutas usuario
Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('admin.usuarios.index')->middleware('auth');
Route::get('/admin/usuarios/register', [App\Http\Controllers\UsuarioController::class, 'create'])->name('admin.usuarios.register')->middleware('auth');
Route::post('/admin/usuarios/register', [App\Http\Controllers\UsuarioController::class, 'store'])->name('admin.usuarios.store')->middleware('auth');
Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('admin.usuarios.show')->middleware('auth');
Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('admin.usuarios.edit')->middleware('auth');
Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('admin.usuarios.update')->middleware('auth');
Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('auth');

// rutas autor
Route::get('/admin/autores', [App\Http\Controllers\AutorController::class, 'index'])->name('admin.autores.index')->middleware('auth');
Route::get('/admin/autores/register', [App\Http\Controllers\AutorController::class, 'create'])->name('admin.autores.register')->middleware('auth');
Route::post('/admin/autores/register', [App\Http\Controllers\AutorController::class, 'store'])->name('admin.autores.store')->middleware('auth');
Route::get('/admin/autores/{id}/edit', [App\Http\Controllers\AutorController::class, 'edit'])->name('admin.autores.edit')->middleware('auth');
Route::put('/admin/autores/{id}', [App\Http\Controllers\AutorController::class, 'update'])->name('admin.autores.update')->middleware('auth');
Route::delete('/admin/autores/{id}', [App\Http\Controllers\AutorController::class, 'destroy'])->name('admin.autores.destroy')->middleware('auth');


require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
