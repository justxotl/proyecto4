@php

public function update(Request $request, $id)
{
    $usuario = User::findOrFail($id);

    // Detecta si es el usuario autenticado actual editando su perfil
    $esPerfilPropio = auth()->id() === $usuario->id;

    // Validación dinámica
    $rules = [
        'name' => ['required', 'max:250'],
        'email' => ['required', 'email', Rule::unique('users')->ignore($usuario->id)],
    ];

    if (!$esPerfilPropio) {
        // Validaciones adicionales solo si es un admin editando a otro usuario
        $rules['ci_us'] = ['required', Rule::unique('infopers', 'ci_us')->ignore($usuario->infoper->id)];
        $rules['nombre'] = ['required'];
        $rules['apellido'] = ['required'];
    }

    // Campos opcionales de seguridad
    $rules['password'] = ['nullable', 'min:8', 'max:20', 'confirmed'];
    $rules['preguntauno'] = ['nullable', 'string', 'max:255'];
    $rules['preguntados'] = ['nullable', 'string', 'max:255'];
    $rules['respuestauno'] = ['nullable', 'string', 'max:255'];
    $rules['respuestados'] = ['nullable', 'string', 'max:255'];

    $request->validate($rules);

    // Actualización de datos
    $usuario->name = $request->name;
    $usuario->email = $request->email;
    $usuario->rol = $usuario->rol ?? 1;

    if ($request->filled('password')) {
        $usuario->password = Hash::make($request->password);
    }

    // Guardar preguntas y respuestas si vienen del perfil
    $usuario->preguntauno = $request->preguntauno;
    $usuario->preguntados = $request->preguntados;
    $usuario->respuestauno = $request->respuestauno;
    $usuario->respuestados = $request->respuestados;

    $usuario->save();

    // Actualiza los datos personales si no es perfil propio
    if (!$esPerfilPropio) {
        $infoPer = $usuario->infoper;
        $infoPer->ci_us = $request->ci_us;
        $infoPer->nombre = $request->nombre;
        $infoPer->apellido = $request->apellido;
        $infoPer->save();
    }

    return redirect()->back()->with([
        'mensaje' => $esPerfilPropio ? 'Perfil actualizado correctamente' : 'Usuario actualizado correctamente',
        'icono' => 'success'
    ]);
}
