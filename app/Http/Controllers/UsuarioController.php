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
        $usuarios = User::where('id', '!=', Auth::user()->id)->get();
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
            'name' => 'required|max:20',
            'ci_us' => 'required|digits_between:6,8|numeric|unique:infopers,ci_us',
            'nombre' => 'required|max:250|regex:/^[\pL\s\-]+$/u',
            'apellido' => 'required|max:250|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|max:250|unique:users,email',
            'rol' => 'required',
            'password' => 'required|min:8|max:20|confirmed',
        ], [
            'name.required' => 'El nombre de usuario es obligatorio.',
            'name.max' => 'El nombre de usuario no puede tener más de 20 caracteres.',

            'ci_us.required' => 'La cédula es obligatoria.',
            'ci_us.digits_between' => 'La cédula debe tener entre 6 y 8 dígitos.',
            'ci_us.numeric' => 'La cédula debe contener solo números.',
            'ci_us.unique' => 'Esta cédula ya está registrada.',

            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 250 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras, espacios y guiones.',

            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.max' => 'El apellido no puede tener más de 250 caracteres.',
            'apellido.regex' => 'El apellido solo puede contener letras, espacios y guiones.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.max' => 'El correo electrónico no puede tener más de 250 caracteres.',
            'email.unique' => 'Este correo electrónico ya está registrado.',

            'rol.required' => 'El rol es obligatorio.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña no puede tener más de 20 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
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

    public function update(Request $request, $id)
    {
        $desdePerfil = $request->redirect_to === 'perfil';

        if ($desdePerfil && $id != Auth::id()) {
            abort(403, 'No autorizado');
        }

        if ($desdePerfil) {
            $id = Auth::id();
        }

        $usuario = User::find($id);

        $rules = [
            'name' => 'required|max:20',
            'email' => 'required|max:250|unique:users,email,' . $usuario->id,
            'password' => 'nullable|min:8|max:20|confirmed',
        ];

        if (!$desdePerfil) {
            $rules['nombre'] = 'required|max:250|regex:/^[\pL\s\-]+$/u';
            $rules['apellido'] = 'required|max:250|regex:/^[\pL\s\-]+$/u';
            $rules['ci_us'] = 'required|digits_between:6,8|numeric|unique:infopers,ci_us,' . $usuario->infoper->user_id;
        }

        if ($desdePerfil) {
            $rules['preguntauno'] = 'required|string|max:255';
            $rules['preguntados'] = 'required|string|max:255';
            $rules['respuestauno'] = 'required|string|max:255';
            $rules['respuestados'] = 'required|string|max:255';
        }

        $request->validate($rules, [
            'name.required' => 'Debes ingresar un nombre de usuario.',
            'name.max' => 'El nombre de usuario no debe exceder 20 caracteres.',

            'nombre.required' => 'Debes ingresar el(los) nombre(s) del usuario.',
            'nombre.max' => 'El(los) nombre(s) no debe(n) exceder 250 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras, espacios y guiones.',

            'apellido.required' => 'Debes ingresar el(los) apellido(s) del usuario.',
            'apellido.max' => 'El(los) apellido(s) no debe(n) exceder 250 caracteres.',
            'apellido.regex' => 'El apellido solo puede contener letras, espacios y guiones.',

            'ci_us.required' => 'Debes ingresar la cédula del usuario.',
            'ci_us.digits_between' => 'La cédula debe tener entre 6 y 8 dígitos.',
            'ci_us.numeric' => 'La cédula solo puede contener números.',
            'ci_us.unique' => 'La cédula ya está registrada.',

            'email.required' => 'Debes ingresar el correo del usuario.',
            'email.unique' => 'El correo ya está registrado.',
            'email.max' => 'El correo no debe exceder 250 caracteres.',

            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña no debe exceder 20 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',

            'preguntauno.required' => 'Debes ingresar la pregunta de seguridad #1.',
            'preguntados.required' => 'Debes ingresar la pregunta de seguridad #2.',
            'respuestauno.required' => 'Debes ingresar la respuesta de seguridad #1.',
            'respuestados.required' => 'Debes ingresar la respuesta de seguridad #2.',
            'preguntauno.string' => 'La pregunta de seguridad #1 debe ser texto.',
            'preguntados.string' => 'La pregunta de seguridad #2 debe ser texto.',
            'respuestauno.string' => 'La respuesta de seguridad #1 debe ser texto.',
            'respuestados.string' => 'La respuesta de seguridad #2 debe ser texto.',
            'preguntauno.max' => 'La pregunta de seguridad #1 no debe exceder 255 caracteres.',
            'preguntados.max' => 'La pregunta de seguridad #2 no debe exceder 255 caracteres.',
            'respuestauno.max' => 'La respuesta de seguridad #1 no debe exceder 255 caracteres.',
            'respuestados.max' => 'La respuesta de seguridad #2 no debe exceder 255 caracteres.',
        ]);

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request['password']);
        }
        $usuario->save();

        if ($request->has('rol')) {
            $rolMaster = Role::where('name', 'MASTER')->first();

            if ($rolMaster) {
                $hasMaster = $usuario->hasRole('MASTER');
                $rolUpdate = (array) $request->rol;
                $masterRemove = $hasMaster && !in_array($rolMaster->id, $rolUpdate);

                if ($masterRemove) {
                    $usuariosConMaster = $rolMaster->users()
                        ->where('id', '!=', $usuario->id)
                        ->count();

                    if ($usuariosConMaster === 0) {
                        return redirect()->back()
                            ->with('mensaje', 'Debe existir al menos un usuario con el rol MASTER.')
                            ->with('icono', 'error');
                    }
                }
            }

            $usuario->syncRoles($rolUpdate);
        }

        $infoPer = infoper::find($usuario->infoper->user_id);
        if (!$desdePerfil) {
            $infoPer->ci_us = $request->ci_us;
            $infoPer->nombre = $request->nombre;
            $infoPer->apellido = $request->apellido;
        }
        $infoPer->user_id = $usuario->id;
        $infoPer->save();

        if ($desdePerfil) {
            $preguntas = \App\Models\PreguntaUser::firstOrNew(['user_id' => $usuario->id]);
            $preguntas->pregunta_uno = $request->preguntauno;
            $preguntas->pregunta_dos = $request->preguntados;
            $preguntas->respuesta_uno = $request->respuestauno;
            $preguntas->respuesta_dos = $request->respuestados;
            $preguntas->save();
        }

        if ($desdePerfil) {
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
        $usuario = User::findOrFail($id);

        if (Auth::id() == $id) {
            return redirect()->back()
                ->with('mensaje', 'No se puede eliminar el usuario actual.')
                ->with('icono', 'error');
        }

        if ($usuario->hasRole('MASTER')) {
            $rolMaster = Role::where('name', 'MASTER')->first();
            if ($rolMaster->users()->count() <= 1) {
                return redirect()->back()
                    ->with('mensaje', 'Debe existir al menos un usuario con el rol MASTER.')
                    ->with('icono', 'error');
            }
        }

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
        $request->validate([
            'password' => 'required|string|min:8|max:20|confirmed',
        ], [
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña no puede tener más de 20 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

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
