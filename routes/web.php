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

//rutas de recuperación de contraseña
Route::get('/recover', [App\Http\Controllers\UsuarioController::class, 'recover'])->name('password.recuperar');
Route::post('/admin/usuarios/recover', [App\Http\Controllers\UsuarioController::class, 'recoverPost'])->name('password.recuperar.post');
Route::post('/admin/usuarios/verificarPreguntas', [App\Http\Controllers\UsuarioController::class, 'verificarPreguntas'])->name('admin.usuarios.verificarPreguntas');
Route::post('admin/usuarios/resetPassword', [App\Http\Controllers\UsuarioController::class, 'resetPassword'])->name('admin.usuarios.resetPassword');

Route::middleware(['auth'])->group(function () {

    // rutas usuario
    Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('admin.usuarios.index');
    Route::get('/admin/usuarios/register', [App\Http\Controllers\UsuarioController::class, 'create'])->name('admin.usuarios.register');
    Route::post('/admin/usuarios/register', [App\Http\Controllers\UsuarioController::class, 'store'])->name('admin.usuarios.store');
    Route::get('admin/usuarios/export', [App\Http\Controllers\UsuarioController::class, 'exportarUsers'])->name('usuarios.exportar');
    Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('admin.usuarios.show');
    Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('admin.usuarios.edit');
    Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('admin.usuarios.update');
    Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy');
    Route::get('/admin/perfil', [App\Http\Controllers\UsuarioController::class, 'perfil'])->name('admin.perfil');
    
    //rutas fichas
    Route::get('/admin/fichas', [App\Http\Controllers\FichaController::class, 'index'])->name('admin.fichas.index');
    Route::get('/admin/fichas/register', [App\Http\Controllers\FichaController::class, 'create'])->name('admin.fichas.register');
    Route::post('/admin/fichas/register', [App\Http\Controllers\FichaController::class, 'store'])->name('admin.fichas.store');
    Route::get('/admin/fichas/export', [App\Http\Controllers\FichaController::class, 'exportarFichas'])->name('fichas.exportar');
    Route::get('/admin/fichas/{id}', [App\Http\Controllers\FichaController::class, 'show'])->name('admin.fichas.show');
    Route::get('/admin/fichas/pdf/{id}', [App\Http\Controllers\FichaController::class, 'pdf'])->name('admin.fichas.pdf');
    Route::get('/admin/fichas/{id}/edit', [App\Http\Controllers\FichaController::class, 'edit'])->name('admin.fichas.edit');
    Route::get('/admin/fichas/{cedula}/get', [App\Http\Controllers\FichaController::class, 'buscarAutor'])->name('admin.fichas.buscarAutor');
    Route::get('/{cedula}/fichasBuscar', [App\Http\Controllers\FichaController::class, 'fichasBuscar'])->name('fichas.buscar');
    Route::put('/admin/fichas/{id}', [App\Http\Controllers\FichaController::class, 'update'])->name('admin.fichas.update');
    Route::delete('/admin/fichas/{id}', [App\Http\Controllers\FichaController::class, 'destroy'])->name('admin.fichas.destroy');
    
    // rutas autor
    Route::get('/admin/autores', [App\Http\Controllers\AutorController::class, 'index'])->name('admin.autores.index');
    Route::get('/admin/autores/register', [App\Http\Controllers\AutorController::class, 'create'])->name('admin.autores.register');
    Route::post('/admin/autores/register', [App\Http\Controllers\AutorController::class, 'store'])->name('admin.autores.store');
    Route::get('/admin/autores/{id}/edit', [App\Http\Controllers\AutorController::class, 'edit'])->name('admin.autores.edit');
    Route::put('/admin/autores/{id}', [App\Http\Controllers\AutorController::class, 'update'])->name('admin.autores.update');
    Route::delete('/admin/autores/{id}', [App\Http\Controllers\AutorController::class, 'destroy'])->name('admin.autores.destroy');
    Route::delete('/quitar_autor/{id}', [App\Http\Controllers\FichaController::class, 'quitar'])->name('fichas.quitar');

    //rutas Carreras
    Route::get('/admin/carreras', [App\Http\Controllers\CarreraController::class, 'index'])->name('admin.carreras.index');
    Route::get('/admin/carreras/register', [App\Http\Controllers\CarreraController::class, 'create'])->name('admin.carreras.register');
    Route::post('/admin/carreras/register', [App\Http\Controllers\CarreraController::class, 'store'])->name('admin.carreras.store');
    Route::get('/admin/carreras/{id}', [App\Http\Controllers\CarreraController::class, 'show'])->name('admin.carreras.show');
    Route::get('/admin/carreras/{id}/edit', [App\Http\Controllers\CarreraController::class, 'edit'])->name('admin.carreras.edit');
    Route::put('/admin/carreras/{id}', [App\Http\Controllers\CarreraController::class, 'update'])->name('admin.carreras.update');
    Route::delete('/admin/carreras/{id}', [App\Http\Controllers\CarreraController::class, 'destroy'])->name('admin.carreras.destroy');

    //rutas roles
    Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('/admin/roles/register', [App\Http\Controllers\RoleController::class, 'create'])->name('admin.roles.register');
    Route::post('/admin/roles/register', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store');
    Route::get('/admin/roles/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::put('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy');

    //rutas de respaldo
    Route::get('/admin/backup', [App\Http\Controllers\BackupController::class, 'index'])->name('admin.backup.index');
    Route::get('/admin/backup/create', [App\Http\Controllers\BackupController::class, 'create'])->name('admin.backup.create');
    Route::get('/admin/backup/descargar/{nombreFile}', [App\Http\Controllers\BackupController::class, 'descargar'])->name('admin.backup.descargar');
    Route::post('/admin/backup/restore', [App\Http\Controllers\BackupController::class, 'restore'])->name('admin.backup.restore');
    Route::delete('/admin/backup/eliminar/{nombreFile}', [App\Http\Controllers\BackupController::class, 'eliminar'])->name('admin.backup.eliminar');
});

require __DIR__ . '/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
