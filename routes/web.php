<?php

use App\Http\Controllers\BackupController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
})->middleware('guest');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified', 'can:Ver Estadísticas del Sistema'])->name('home');

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
    Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->middleware('can:Ver Lista de Usuarios')->name('admin.usuarios.index');
    Route::get('/admin/usuarios/register', [App\Http\Controllers\UsuarioController::class, 'create'])->middleware('can:Registrar Usuario')->name('admin.usuarios.register');
    Route::post('/admin/usuarios/register', [App\Http\Controllers\UsuarioController::class, 'store'])->middleware('can:Registrar Usuario')->name('admin.usuarios.store');
    Route::get('admin/usuarios/export', [App\Http\Controllers\UsuarioController::class, 'exportarUsers'])->middleware('can:Exportar Reporte de Usuarios')->name('usuarios.exportar');
    Route::get('/admin/usuarios/exportPdf', [App\Http\Controllers\UsuarioController::class, 'exportPdf'])->middleware('can:Exportar Reporte de Usuarios')->name('usuarios.exportar.pdf');
    Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->middleware('can:Ver Información de Usuario')->name('admin.usuarios.show');
    Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->middleware('can:Editar Usuario')->name('admin.usuarios.edit');
    Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->middleware('can:Editar Usuario')->name('admin.usuarios.update');
    Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->middleware('can:Eliminar Usuario')->name('admin.usuarios.destroy');
    Route::get('/admin/perfil', [App\Http\Controllers\UsuarioController::class, 'perfil'])->middleware('can:Ver Perfil de Usuario')->name('admin.perfil');
    
    
    // rutas autor
    Route::get('/admin/autores', [App\Http\Controllers\AutorController::class, 'index'])->middleware('can:Ver Lista de Autores')->name('admin.autores.index');
    Route::get('/admin/autores/register', [App\Http\Controllers\AutorController::class, 'create'])->middleware('can:Registrar Autor')->name('admin.autores.register');
    Route::post('/admin/autores/register', [App\Http\Controllers\AutorController::class, 'store'])->middleware('can:Registrar Autor')->name('admin.autores.store');
    Route::get('/admin/autores/export', [App\Http\Controllers\AutorController::class, 'exportarAutores'])->middleware('can:Exportar Reporte de Autores')->name('autores.exportar');
    Route::get('/admin/autores/exportPdf', [App\Http\Controllers\AutorController::class, 'exportPdf'])->middleware('can:Exportar Reporte de Autores')->name('autores.exportar.pdf');
    Route::get('/admin/autores/{id}/edit', [App\Http\Controllers\AutorController::class, 'edit'])->middleware('can:Editar Autor')->name('admin.autores.edit');
    Route::put('/admin/autores/{id}', [App\Http\Controllers\AutorController::class, 'update'])->middleware('can:Editar Autor')->name('admin.autores.update');
    Route::delete('/admin/autores/{id}', [App\Http\Controllers\AutorController::class, 'destroy'])->middleware('can:Eliminar Autor')->name('admin.autores.destroy');
    
    //rutas Carreras
    Route::get('/admin/carreras', [App\Http\Controllers\CarreraController::class, 'index'])->middleware('can:Ver Lista de Carreras')->name('admin.carreras.index');
    Route::get('/admin/carreras/register', [App\Http\Controllers\CarreraController::class, 'create'])->middleware('can:Registrar Carrera')->name('admin.carreras.register');
    Route::post('/admin/carreras/register', [App\Http\Controllers\CarreraController::class, 'store'])->middleware('can:Registrar Carrera')->name('admin.carreras.store');
    Route::get('/admin/carreras/export', [App\Http\Controllers\CarreraController::class, 'exportarCarreras'])->middleware('can:Exportar Reporte de Carreras')->name('carreras.exportar');
    Route::get('/admin/carreras/exportPdf', [App\Http\Controllers\CarreraController::class, 'exportPdf'])->middleware('can:Exportar Reporte de Carreras')->name('carreras.exportar.pdf');
    Route::get('/admin/carreras/{id}/edit', [App\Http\Controllers\CarreraController::class, 'edit'])->middleware('can:Editar Carrera')->name('admin.carreras.edit');
    Route::put('/admin/carreras/{id}', [App\Http\Controllers\CarreraController::class, 'update'])->middleware('can:Editar Carrera')->name('admin.carreras.update');
    Route::delete('/admin/carreras/{id}', [App\Http\Controllers\CarreraController::class, 'destroy'])->middleware('can:Eliminar Carrera')->name('admin.carreras.destroy');
    
    //rutas fichas
    Route::get('/admin/fichas', [App\Http\Controllers\FichaController::class, 'index'])->middleware('can:Ver Lista de Fichas')->name('admin.fichas.index');
    Route::get('/admin/fichas/register', [App\Http\Controllers\FichaController::class, 'create'])->middleware('can:Registrar Ficha')->name('admin.fichas.register');
    Route::post('/admin/fichas/register', [App\Http\Controllers\FichaController::class, 'store'])->middleware('can:Registrar Ficha')->name('admin.fichas.store');
    Route::get('/admin/fichas/export', [App\Http\Controllers\FichaController::class, 'exportarFichas'])->middleware('can:Exportar Reporte de Fichas')->name('fichas.exportar');
    Route::get('/admin/fichas/exportPdf', [App\Http\Controllers\FichaController::class, 'exportPdf'])->middleware('can:Exportar Reporte de Fichas')->name('fichas.exportar.pdf');
    Route::get('/admin/fichas/{id}', [App\Http\Controllers\FichaController::class, 'show'])->middleware('can:Ver Información de Ficha')->name('admin.fichas.show');
    Route::get('/admin/fichas/pdf/{id}', [App\Http\Controllers\FichaController::class, 'pdf'])->middleware('can:Exportar Reporte de Ficha Única')->name('admin.fichas.pdf');
    Route::get('/admin/fichas/{id}/edit', [App\Http\Controllers\FichaController::class, 'edit'])->middleware('can:Editar Ficha')->name('admin.fichas.edit');
    Route::get('/admin/fichas/{cedula}/get', [App\Http\Controllers\FichaController::class, 'buscarAutor'])->middleware('can:Registrar Ficha')->name('admin.fichas.buscarAutor');
    Route::get('/{cedula}/fichasBuscar', [App\Http\Controllers\FichaController::class, 'fichasBuscar'])->middleware('can:Registrar Ficha')->name('fichas.buscar');
    Route::put('/admin/fichas/{id}', [App\Http\Controllers\FichaController::class, 'update'])->middleware('can:Editar Ficha')->name('admin.fichas.update');
    Route::delete('/admin/fichas/{id}', [App\Http\Controllers\FichaController::class, 'destroy'])->middleware('can:Eliminar Ficha')->name('admin.fichas.destroy');
    Route::delete('/quitar_autor/{id}', [App\Http\Controllers\FichaController::class, 'quitar'])->middleware('can:Editar Ficha')->name('fichas.quitar');
    
    //rutas prestamos
    Route::get('/admin/prestamos', [App\Http\Controllers\PrestamoController::class, 'index'])->middleware('can:Ver Lista de Préstamos')->name('admin.prestamos.index');
    Route::get('/admin/prestamos/register', [App\Http\Controllers\PrestamoController::class, 'create'])->middleware('can:Registrar Préstamo')->name('admin.prestamos.register');
    Route::post('/admin/prestamos/register', [App\Http\Controllers\PrestamoController::class, 'store'])->middleware('can:Registrar Préstamo')->name('admin.prestamos.store');
    Route::get('/admin/prestamos/export', [App\Http\Controllers\PrestamoController::class, 'exportarPrestamos'])->middleware('can:Exportar Reporte de Préstamos')->name('prestamos.exportar');
    Route::get('/admin/prestamos/exportPdf', [App\Http\Controllers\PrestamoController::class, 'exportPdf'])->middleware('can:Exportar Reporte de Préstamos')->name('prestamos.exportar.pdf');
    Route::get('/admin/prestamos/pdf/{id}', [App\Http\Controllers\PrestamoController::class, 'pdf'])->middleware('can:Exportar Reporte de Préstamos')->name('admin.prestamos.pdf');
    Route::get('/admin/prestamos/{id}', [App\Http\Controllers\PrestamoController::class, 'show'])->middleware('can:Ver Información de Préstamo')->name('admin.prestamos.show');
    Route::put('/admin/prestamos/{id}/devolver', [App\Http\Controllers\PrestamoController::class, 'devolver'])->middleware('can:Marcar Préstamo como Devuelto')->name('admin.prestamos.devolver');
    Route::get('/admin/prestamos/{id}/edit', [App\Http\Controllers\PrestamoController::class, 'edit'])->middleware('can:Editar Préstamo')->name('admin.prestamos.edit');
    Route::put('/admin/prestamos/{id}', [App\Http\Controllers\PrestamoController::class, 'update'])->middleware('can:Editar Préstamo')->name('admin.prestamos.update');
    Route::delete('/admin/prestamos/{id}', [App\Http\Controllers\PrestamoController::class, 'destroy'])->middleware('can:Eliminar Préstamo')->name('admin.prestamos.destroy');
    
    //rutas de prestatario
    Route::get('/admin/prestatarios/buscar', [App\Http\Controllers\PrestatarioController::class, 'buscarPorCedula'])->middleware('can:Registrar Préstamo')->name('prestatarios.buscar');
    Route::put('/prestatarios/{id}', [App\Http\Controllers\PrestatarioController::class, 'update'])->middleware('can:Editar Préstamo')->name('prestatarios.update');
    Route::delete('/admin/prestatarios/{id}', [App\Http\Controllers\PrestatarioController::class, 'destroy'])->middleware('can:Eliminar Préstamo')->name('prestatarios.destroy');
    
    //rutas roles
    Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->middleware('can:Ver Lista de Roles')->name('admin.roles.index');
    Route::get('/admin/roles/register', [App\Http\Controllers\RoleController::class, 'create'])->middleware('can:Registrar Rol')->name('admin.roles.register');
    Route::post('/admin/roles/register', [App\Http\Controllers\RoleController::class, 'store'])->middleware('can:Registrar Rol')->name('admin.roles.store');
    Route::get('/admin/roles/export', [App\Http\Controllers\RoleController::class, 'exportarRoles'])->middleware('can:Exportar Reporte de Roles')->name('roles.exportar');
    Route::get('/admin/roles/exportPdf', [App\Http\Controllers\RoleController::class, 'exportPdf'])->middleware('can:Exportar Reporte de Roles')->name('roles.exportar.pdf');
    Route::get('/admin/roles/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->middleware('can:Editar Rol')->name('admin.roles.edit');
    Route::put('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'update'])->middleware('can:Editar Rol')->name('admin.roles.update');
    Route::get('/admin/roles/{id}/asignar', [App\Http\Controllers\RoleController::class, 'asignar'])->middleware('can:Editar Rol')->name('admin.roles.asignar');
    Route::put('/admin/roles/asignar/{id}', [App\Http\Controllers\RoleController::class, 'otorgar'])->middleware('can:Editar Rol')->name('admin.roles.otorgar');
    Route::delete('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->middleware('can:Eliminar Rol')->name('admin.roles.destroy');

    //rutas de respaldo
    Route::get('/admin/backup', [App\Http\Controllers\BackupController::class, 'index'])->middleware('can:Ver Lista de Respaldos')->name('admin.backup.index');
    Route::get('/admin/backup/create', [App\Http\Controllers\BackupController::class, 'create'])->middleware('can:Crear Respaldo')->name('admin.backup.create');
    Route::post('/admin/backup/restore', [App\Http\Controllers\BackupController::class, 'restore'])->middleware('can:Restaurar Respaldo')->name('admin.backup.restore');
    Route::post('/admin/backup/upload', [App\Http\Controllers\BackupController::class, 'uploadRestore'])->middleware('can:Restaurar Respaldo desde Dispositivo')->name('admin.backup.upload');
    Route::get('/admin/backup/descargar/{nombreFile}', [App\Http\Controllers\BackupController::class, 'descargar'])->middleware('can:Descargar Respaldo')->name('admin.backup.descargar');
    Route::delete('/admin/backup/eliminar/{nombreFile}', [App\Http\Controllers\BackupController::class, 'eliminar'])->middleware('can:Eliminar Respaldo')->name('admin.backup.eliminar');

});

require __DIR__ . '/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'can:Ver Estadísticas del Sistema'])->name('home');
