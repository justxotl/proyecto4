<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestatario;

class PrestatarioController extends Controller
{
    public function store (Request $request){
        // Validación de campos
        $request->validate([
            'ci_prestatario' => 'required|numeric|digits_between:6,8|unique:prestatarios,ci_prestatario',
            'nombre_prestatario' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'apellido_prestatario' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'tlf_prestatario' => 'required|numeric|digits:11|unique:prestatarios,tlf_prestatario',
        ], [
            'ci_prestatario.required' => 'La cédula es obligatoria.',
            'ci_prestatario.numeric' => 'La cédula debe ser numérica.',
            'ci_prestatario.digits_between' => 'La cédula debe tener entre 6 y 8 dígitos.',
            'ci_prestatario.unique' => 'La cédula ya se encuentra registrada.',

            'nombre_prestatario.required' => 'El nombre es obligatorio.',
            'nombre_prestatario.string' => 'El nombre debe ser un texto.',
            'nombre_prestatario.max' => 'El nombre no debe exceder 255 caracteres.',
            'nombre_prestatario.regex' => 'El nombre del prestatario solo puede contener letras, espacios y guiones.',

            'apellido_prestatario.required' => 'El apellido es obligatorio.',
            'apellido_prestatario.string' => 'El apellido debe ser un texto.',
            'apellido_prestatario.max' => 'El apellido no debe exceder 255 caracteres.',
            'apellido_prestatario.regex' => 'El apellido del prestatario solo puede contener letras, espacios y guiones.',

            'tlf_prestatario.required' => 'El teléfono es obligatorio.',
            'tlf_prestatario.numeric' => 'El teléfono debe ser numérico.',
            'tlf_prestatario.digits' => 'El teléfono debe tener exactamente 11 dígitos.',
            'tlf_prestatario.unique' => 'El teléfono ya se encuentra registrado en otro prestatario.',
        ]);

        Prestatario::create($request->only(['ci_prestatario', 'nombre_prestatario', 'apellido_prestatario', 'tlf_prestatario']));

        return response()->json(['success' => true]);
    }

    public function buscarPorCedula(Request $request)
    {
        $prestatario = \App\Models\Prestatario::where('ci_prestatario', $request->ci_prestatario)->first();
        return response()->json($prestatario);
    }

    public function update(Request $request, $id)
    {
        // Validación de campos
        $request->validate([
            'ci_prestatario' => 'required|numeric|digits_between:6,8|unique:prestatarios,ci_prestatario,' . $id,
            'nombre_prestatario' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'apellido_prestatario' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'tlf_prestatario' => 'required|numeric|digits:11|unique:prestatarios,tlf_prestatario,' . $id,
        ], [
            'ci_prestatario.required' => 'La cédula es obligatoria.',
            'ci_prestatario.numeric' => 'La cédula debe ser numérica.',
            'ci_prestatario.digits_between' => 'La cédula debe tener entre 6 y 8 dígitos.',
            'ci_prestatario.unique' => 'La cédula ya se encuentra registrada en otro prestatario.',

            'nombre_prestatario.required' => 'El nombre es obligatorio.',
            'nombre_prestatario.string' => 'El nombre debe ser un texto.',
            'nombre_prestatario.max' => 'El nombre no debe exceder 255 caracteres.',
            'nombre_prestatario.regex' => 'El nombre del prestatario solo puede contener letras, espacios y guiones.',

            'apellido_prestatario.required' => 'El apellido es obligatorio.',
            'apellido_prestatario.string' => 'El apellido debe ser un texto.',
            'apellido_prestatario.max' => 'El apellido no debe exceder 255 caracteres.',
            'apellido_prestatario.regex' => 'El apellido del prestatario solo puede contener letras, espacios y guiones.',

            'tlf_prestatario.required' => 'El teléfono es obligatorio.',
            'tlf_prestatario.numeric' => 'El teléfono debe ser numérico.',
            'tlf_prestatario.digits' => 'El teléfono debe tener exactamente 11 dígitos.',
            'tlf_prestatario.unique' => 'El teléfono ya se encuentra registrado en otro prestatario.',
        ]);

        $prestatario = Prestatario::findOrFail($id);
        $prestatario->update($request->only(['ci_prestatario', 'nombre_prestatario', 'apellido_prestatario', 'tlf_prestatario']));

        return response()->json(['success' => true]);
    }


    public function destroy($id)
    {
        $prestatario = Prestatario::findOrFail($id);

        if ($prestatario->prestamos()->count() > 0) {
            return redirect()->back()->with('mensaje', 'No se puede eliminar el prestatario porque tiene préstamos asociados.')->with('icono', 'error');
        }

        $prestatario->delete();
        return redirect()->back()->with('mensaje', 'Prestatario eliminado correctamente.')->with('icono', 'success');
    }
}
