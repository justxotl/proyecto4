<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
        ], [
            'name.required' => 'Debe ingresar el nombre del rol.',
            'name.string' => 'El nombre del rol debe ser texto.',
            'name.max' => 'El nombre del rol no debe exceder los 255 caracteres.',
            'name.unique' => 'Ya existe un rol registrado con ese nombre.',
        ]);

        $rol = new Role();
        $rol->name = $request->name;
        $rol->save();

        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Rol registrado correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rol = Role::find($id);
        return view('admin.roles.edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rol = Role::find($id);

        if ($rol->name === 'MASTER') {
            return redirect()->route('admin.roles.index')
                ->with('mensaje', 'No está permitido modificar este rol.')
                ->with('icono', 'error');
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
        ], [
            'name.required' => 'Debe ingresar el nombre del rol.',
            'name.string' => 'El nombre del rol debe ser texto.',
            'name.max' => 'El nombre del rol no debe exceder los 255 caracteres.',
            'name.unique' => 'Ya existe un rol registrado con ese nombre.',
        ]);

        $rol->name = $request->name;
        $rol->save();

        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Rol actualizado correctamente.')
            ->with('icono', 'success');
    }

    public function asignar($id)
    {
        $rol = Role::find($id);
        //$permisos = Permission::all();

        $permisos = Permission::all()->groupBy(function ($permiso) {

            if (stripos($permiso->name, 'usuario') !== false) {
                return "Usuarios";
            } elseif (stripos($permiso->name, 'autor') !== false) {
                return "Autores";
            } elseif (stripos($permiso->name, 'carrera') !== false) {
                return "Carreras";
            } elseif (stripos($permiso->name, 'ficha') !== false) {
                return "Fichas";
            } elseif (stripos($permiso->name, 'préstamo') !== false) {
                return "Préstamos";
            } elseif (stripos($permiso->name, 'rol') !== false) {
                return "Roles";
            } elseif (stripos($permiso->name, 'sistema') !== false) {
                return "Estadística";
            } elseif (stripos($permiso->name, 'respaldo') !== false) {
                return "Respaldos de Base de Datos";
            }
        });
        return view('admin.roles.asignar', compact('rol', 'permisos'));
    }

    public function otorgar(Request $request, $id)
    {
        //dd($request, $id);    
        $rol = Role::find($id);

        if ($rol->name === 'MASTER') {
            return redirect()->back()
                ->with('mensaje', 'No está permitido modificar los permisos de este rol.')
                ->with('icono', 'error');
        }

        $request->validate([
            'permisos' => 'required|array',
        ], [
            'permisos.required' => 'Debe seleccionar al menos un permiso.',
            'permisos.array' => 'El formato de los permisos no es válido.',
        ]);

        $rol->permissions()->sync($request->input('permisos'));

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()->back()
            ->with('mensaje', 'Permisos asignados correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $rol = Role::findOrFail($id);

        $userCount = DB::table('model_has_roles')
            ->where('role_id', $id)
            ->count();

        if ($userCount > 0) {
            return redirect()->back()
                ->with('mensaje', 'No se puede eliminar el rol porque tiene usuarios asociados.')
                ->with('icono', 'error');
        }

        if ($rol->name === 'MASTER') {
            return redirect()->back()
                ->with('mensaje', 'No se puede eliminar el rol porque es el principal.')
                ->with('icono', 'error');
        }

        $rol->delete();

        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Rol eliminado correctamente.')
            ->with('icono', 'success');
    }

    public function exportarRoles()
    {
        $fecha = Carbon::now()->format('d-m-Y');
        $nombreArchivo = "listado_de_roles_registrados_{$fecha}.xlsx";
        return Excel::download(new \App\Exports\RolesExport, $nombreArchivo);
    }

    public function exportPdf()
    {
        $fecha = Carbon::now()->format('d-m-Y');
        $roles = Role::with('permissions')->get();
        $nombreArchivo = "listado_de_roles_registrados_{$fecha}.pdf";
        $pdf = Pdf::loadView('admin.roles.reportepdf', compact('roles'))->setOption(['isPhpEnabled' => true]);

        return $pdf->stream($nombreArchivo);
    }
}
