<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
})->middleware('guest');

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
Route::get('/admin/perfil', [App\Http\Controllers\UsuarioController::class, 'perfil'])->name('admin.perfil')->middleware('auth');

// rutas autor
Route::get('/admin/autores', [App\Http\Controllers\AutorController::class, 'index'])->name('admin.autores.index')->middleware('auth');
Route::get('/admin/autores/register', [App\Http\Controllers\AutorController::class, 'create'])->name('admin.autores.register')->middleware('auth');
Route::post('/admin/autores/register', [App\Http\Controllers\AutorController::class, 'store'])->name('admin.autores.store')->middleware('auth');
Route::get('/admin/autores/{id}/edit', [App\Http\Controllers\AutorController::class, 'edit'])->name('admin.autores.edit')->middleware('auth');
Route::put('/admin/autores/{id}', [App\Http\Controllers\AutorController::class, 'update'])->name('admin.autores.update')->middleware('auth');
Route::delete('/admin/autores/{id}', [App\Http\Controllers\AutorController::class, 'destroy'])->name('admin.autores.destroy')->middleware('auth');

//rutas fichas
Route::get('/admin/fichas', [App\Http\Controllers\FichaController::class, 'index'])->name('admin.fichas.index')->middleware('auth');
Route::get('/admin/fichas/register', [App\Http\Controllers\FichaController::class, 'create'])->name('admin.fichas.register')->middleware('auth');
Route::post('/admin/fichas/register', [App\Http\Controllers\FichaController::class, 'store'])->name('admin.fichas.store')->middleware('auth');
Route::get('/admin/fichas/{id}', [App\Http\Controllers\FichaController::class, 'show'])->name('admin.fichas.show')->middleware('auth');
Route::get('/admin/fichas/{id}/edit', [App\Http\Controllers\FichaController::class, 'edit'])->name('admin.fichas.edit')->middleware('auth');
Route::get('/admin/fichas/{cedula}/get', [App\Http\Controllers\FichaController::class, 'buscarAutor'])->name('admin.fichas.buscarAutor')->middleware('auth');
Route::put('/admin/fichas/{id}', [App\Http\Controllers\FichaController::class, 'update'])->name('admin.fichas.update')->middleware('auth');
Route::delete('/admin/fichas/{id}', [App\Http\Controllers\FichaController::class, 'destroy'])->name('admin.fichas.destroy')->middleware('auth');

//rutas Carreras
Route::get('/admin/carreras', [App\Http\Controllers\CarreraController::class, 'index'])->name('admin.carreras.index')->middleware('auth');
Route::get('/admin/carreras/register', [App\Http\Controllers\CarreraController::class, 'create'])->name('admin.carreras.register')->middleware('auth');
Route::post('/admin/carreras/register', [App\Http\Controllers\CarreraController::class, 'store'])->name('admin.carreras.store')->middleware('auth');
Route::get('/admin/carreras/{id}', [App\Http\Controllers\CarreraController::class, 'show'])->name('admin.carreras.show')->middleware('auth');
Route::get('/admin/carreras/{id}/edit', [App\Http\Controllers\CarreraController::class, 'edit'])->name('admin.carreras.edit')->middleware('auth');
Route::put('/admin/carreras/{id}', [App\Http\Controllers\CarreraController::class, 'update'])->name('admin.carreras.update')->middleware('auth');
Route::delete('/admin/carreras/{id}', [App\Http\Controllers\CarreraController::class, 'destroy'])->name('admin.carreras.destroy')->middleware('auth');

//rutas roles
Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index')->middleware('auth');
Route::get('/admin/roles/register', [App\Http\Controllers\RoleController::class, 'create'])->name('admin.roles.register')->middleware('auth');
Route::post('/admin/roles/register', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store')->middleware('auth');
Route::get('/admin/roles/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('auth');
Route::put('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update')->middleware('auth');
Route::delete('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy')->middleware('auth');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
