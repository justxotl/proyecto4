<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\infoper;
use App\Models\User;
use App\Models\PreguntaUser;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;



use Illuminate\Http\Request;

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
        return view('admin.usuarios.register');
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
            'password' => 'required|min:8|max:20|confirmed',
        ]);

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();

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
        $infoper = infoper::all();
        return view('admin.usuarios.edit', compact('usuario', 'infoper'));
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

        $infoPer = infoper::find($usuario->infoper->user_id);
        $infoPer->ci_us = $request->ci_us;
        $infoPer->nombre = $request->nombre;
        $infoPer->apellido = $request->apellido;
        $infoPer->user_id = $usuario->id;
        $infoPer->save();
    
        $preguntas = PreguntaUser::where('user_id', $usuario->id)->first();

        if ($preguntas) {
            // Actualizar
            $preguntas->pregunta_uno = $request->preguntauno;
            $preguntas->pregunta_dos = $request->preguntados;
            $preguntas->respuesta_uno = $request->respuestauno;
            $preguntas->respuesta_dos = $request->respuestados;
            $preguntas->save();
        } else {
            // Crear nuevo
            PreguntaUser::create([
                'user_id' => $usuario->id,
                'pregunta_uno' => $request->preguntauno,
                'pregunta_dos' => $request->preguntados,
                'respuesta_uno' => $request->respuestauno,
                'respuesta_dos' => $request->respuestados,
            ]);
        }

        if ($request->redirect_to === 'perfil') {
            return redirect()->route('admin.perfil')
                ->with('mensaje', 'Usuario actualizado correctamente')
                ->with('icono', 'success');
        }else{
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
}
