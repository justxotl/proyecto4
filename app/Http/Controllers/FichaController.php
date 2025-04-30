<?php

namespace App\Http\Controllers;

use App\Models\Ficha;
use App\Models\Autor;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FichaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fichas = Ficha::with('autor')->get();
        return view('admin.fichas.index', compact('fichas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carreras = Carrera::all();
        return view('admin.fichas.register', compact('carreras'));
    }

    public function buscarAutor($id)
    {
        $buscarautor = Autor::where('ci_autor', $id)->first();
        if (!$buscarautor) {
            return response()->json('NotFound');
        }

        $ficha = Autor::join('fichas', 'autors.id', '=', 'fichas.autor_id')->where('fichas.autor_id', '=', $buscarautor->id);

        if ($ficha) {
            return response()->json($buscarautor);
        } else {
            return response()->json('NotFound');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nombre = $request->nombre_autor;
        $apellido = $request->apellido_autor;
        $cedula = $request->ci_autor;
        // Validación de los datos
        $validacion = Validator::make(
            $request->all(),
            [
                'ci_autor.*' => 'required',
                'nombre_autor.*' => 'required',
                'apellido_autor.*' => 'required',
                'titulo' => 'required|unique:fichas',
                'fecha' => 'required',
                'carrera' => 'required',
                'resumen' => 'required',
            ],
            [
                'ci_autor.*.required' => 'La cédula es requerida.',
                'nombre_autor.*.required' => 'El nombre es requerido.',
                'apellido_autor.*.required' => 'El apellido es requerido.',
                'titulo.required' => 'El título es requerido.',
                'fecha.required' => 'La fecha es requerida.',
                'carrera.required' => 'La carrera es requerida.',
                'resumen.required' => 'El resumen es requerido.',
            ]
        );

        if ($validacion->fails()) {
            return back()->withErrors($validacion)->withInput();
        }

        DB::beginTransaction();

        try {
            // Crear la ficha
            $ficha = Ficha::create([
                'titulo' => $request->titulo,
                'fecha' => $request->fecha,
                'carrera_id' => $request->carrera,
                'resumen' => $request->resumen,
            ]);

            // Iterar sobre los autores enviados
            foreach ($request->ci_autor as $index => $cedula) {
                // Buscar si el autor ya existe
                $autor = Autor::where('ci_autor', $cedula)->first();

                if (!$autor) {
                    // Si el autor no existe, crearlo
                    $autor = Autor::create([
                        'ci_autor' => $cedula,
                        'nombre_autor' => $request->nombre_autor[$index],
                        'apellido_autor' => $request->apellido_autor[$index],
                    ]);
                }

                // Asociar el autor con la ficha en la tabla pivote
                $ficha->autor()->attach($autor->id);
            }

            DB::commit();
            return response()->json(['response' => 'Ficha y autores procesados correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['response' => 'Error en el servidor: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ficha = Ficha::with('autor')->where('id', $id)->first();
        return view('admin.fichas.show', compact('ficha'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $ficha = Ficha::findOrFail($id);
        $carreras = Carrera::all();
        return view('admin.fichas.edit', compact('ficha', 'carreras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        

        // Validación de los datos
        $validacion =  Validator::make(
            $request->all(),
            [
                'ci_autor.*' => 'required',
                'nombre_autor.*' => 'required',
                'apellido_autor.*' => 'required',
                'titulo' => 'required|unique:fichas,titulo,' . $id,
                'fecha' => 'required',
                'carrera' => 'required',
                'resumen' => 'required',
            ],
            [
                'ci_autor.*.required' => 'La cédula es requerida.',
                'nombre_autor.*.required' => 'El nombre es requerido.',
                'apellido_autor.*.required' => 'El apellido es requerido.',
                'titulo.required' => 'El título es requerido.',
                'fecha.required' => 'La fecha es requerida.',
                'carrera.required' => 'La carrera es requerida.',
                'resumen.required' => 'El resumen es requerido.',
            ]
        );

        if ($validacion->fails()) {
            return back()->withErrors($validacion)->withInput();
        }

        DB::beginTransaction();

        try {
            // Actualizar la ficha
            $ficha = Ficha::findOrFail($id);
            $ficha->update([
                'titulo' => $request->titulo,
                'fecha' => $request->fecha,
                'carrera_id' => $request->carrera,
                'resumen' => $request->resumen,
            ]);

            // Desvincular todos los autores actuales
            $ficha->autor()->detach();

            // Iterar sobre los autores enviados
            foreach ($request->ci_autor as $index => $cedula) {
                // Buscar si el autor ya existe
                $autor = Autor::where('ci_autor', $cedula)->first();

                if (!$autor) {
                    // Si el autor no existe, crearlo
                    $autor = Autor::create([
                        'ci_autor' => $cedula,
                        'nombre_autor' => $request->nombre_autor[$index],
                        'apellido_autor' => $request->apellido_autor[$index],
                    ]);
                }

                // Asociar el autor con la ficha en la tabla pivote
                $ficha->autor()->attach($autor->id);
            }

            DB::commit();
            return redirect()->route('admin.fichas.index')
                ->with('mensaje', 'Ficha actualizada correctamente.')
                ->with('icono', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error en el servidor: ' . $e->getMessage());
        }
            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fichas = Ficha::find($id);
        $fichas->delete();

        return redirect()->route('admin.fichas.index')
            ->with('mensaje', 'Ficha eliminada correctamente.')
            ->with('icono', 'success');
    }
}
