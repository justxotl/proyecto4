<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\infoper;
use App\Models\User;
use App\Models\PreguntaUser;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios.register', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:250',
            'ci_us' => 'required|max:8|unique:infopers,ci_us',
            'nombre' => 'required|max:250',
            'apellido' => 'required|max:250',
            'email' => 'required|max:250|unique:users,email',
            'rol' => 'required',
            'password' => 'required|min:8|max:20|confirmed',
        ]);

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();
        $usuario->assignRole($request->rol);

        $infoPer = new infoper();
        $infoPer->ci_us = $request->ci_us;
        $infoPer->nombre = $request->nombre;
        $infoPer->apellido = $request->apellido;
        $infoPer->user_id = $usuario->id;
        $infoPer->save();

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario creado correctamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = User::find($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles = Role::all();
        $infoper = infoper::all();
        return view('admin.usuarios.edit', compact('usuario', 'infoper', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuario = User::find($id);
        $request->validate([
            'name' => 'required|max:20' . $usuario->id,
            'nombre' => 'required',
            'apellido' => 'required',
            'ci_us' => 'required|unique:infopers,ci_us,' . $usuario->id,
            'email' => 'required|unique:users,email,' . $usuario->id,
            'password' => 'nullable|min:8|max:20|confirmed',
            'preguntauno' => 'nullable|string|max:255',
            'respuestauno' => 'nullable|string|max:255',
            'preguntados' => 'nullable|string|max:255',
            'respuestados' => 'nullable|string|max:255',
        ]);

        $usuario = User::find($usuario->id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request['password']);
        }
        $usuario->save();

        if ($request->has('rol')) {
            $usuario->syncRoles($request->rol);
        }

        $infoPer = infoper::find($usuario->infoper->user_id);
        $infoPer->ci_us = $request->ci_us;
        $infoPer->nombre = $request->nombre;
        $infoPer->apellido = $request->apellido;
        $infoPer->user_id = $usuario->id;
        $infoPer->save();

        if ($request->has(['preguntauno', 'preguntados', 'respuestauno', 'respuestados'])) {
            $preguntas = PreguntaUser::firstOrNew(['user_id' => $usuario->id]);
            $preguntas->pregunta_uno = $request->preguntauno;
            $preguntas->pregunta_dos = $request->preguntados;
            $preguntas->respuesta_uno = $request->respuestauno;
            $preguntas->respuesta_dos = $request->respuestados;
            $preguntas->save();
        }

        if ($request->redirect_to === 'perfil') {
            return redirect()->route('admin.perfil')
                ->with('mensaje', 'Usuario actualizado correctamente')
                ->with('icono', 'success');
        } else {
            return redirect()->route('admin.usuarios.index')
                ->with('mensaje', 'Usuario actualizado correctamente')
                ->with('icono', 'success');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario eliminado correctamente')
            ->with('icono', 'success');
    }

    public function perfil()
    {
        $preguntas = PreguntaUser::firstOrNew(
            ['user_id' => Auth::user()->id],
            [
                'pregunta_uno' => '',
                'pregunta_dos' => '',
                'respuesta_uno' => '',
                'respuesta_dos' => '',
            ]
        );

        return view('admin.perfil', compact('preguntas'));
    }

    public function recover()
    {
        return view('recover');
    }

    public function recoverPost(Request $request)
    {
        $request->validate([
            'ci_recover' => 'required|max:8',
        ]);

        // Buscar el usuario por la cédula en infoper
        $usuario = User::whereHas('infoper', function ($query) use ($request) {
            $query->where('ci_us', $request->ci_recover);
        })->first();

        if (!$usuario) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró ningún usuario con esa cédula.',
            ]);
        }

        // Buscar las preguntas asociadas al usuario
        $preguntas = PreguntaUser::where('user_id', $usuario->id)->first();

        if (!$preguntas) {
            return response()->json([
                'success' => false,
                'message' => 'El usuario no tiene preguntas de seguridad registradas.',
            ]);
        }

        return response()->json([
            'success' => true,
            'user_id' => $usuario->id,
            'pregunta_uno' => $preguntas->pregunta_uno,
            'pregunta_dos' => $preguntas->pregunta_dos,
        ]);
    }

    public function verificarPreguntas(Request $request)
    {
        $user = User::find($request->user_id);
        $preguntas = $user->preguntasUser;

        if (
            $preguntas &&
            strtolower(trim($preguntas->respuesta_uno)) === strtolower(trim($request->respuesta_uno)) &&
            strtolower(trim($preguntas->respuesta_dos)) === strtolower(trim($request->respuesta_dos))
        ) {
            return response()->json(['status' => 'ok']);
        }

        return response()->json(['status' => 'fail']);
    }

    public function resetPassword(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['status' => 'ok']);
        }

        return response()->json(['status' => 'fail']);
    }

    public function exportarUsers()
    {
        $fecha = Carbon::now()->format('d-m-Y');
        $nombreArchivo = "listado_de_usuarios_registrados_{$fecha}.xlsx";
        return Excel::download(new \App\Exports\UsersExport, $nombreArchivo);
    }

    public function exportPdf()
{
    $fecha = Carbon::now()->format('d-m-Y');
    $usuarios = User::with(['roles', 'infoper'])->get();
    $nombreArchivo = "listado_de_usuarios_registrados_{$fecha}.pdf";
    $pdf = Pdf::loadView('admin.usuarios.reportepdf', compact('usuarios'))->setOption(['isPhpEnabled' => true]);

    return $pdf->stream($nombreArchivo);
}
}
