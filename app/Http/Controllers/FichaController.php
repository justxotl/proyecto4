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
        $fichas = Ficha::all();
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
        $ficha = Autor::join('fichas', 'autors.id', '=', 'fichas.autor_id')->where('fichas.autor_id', '=', $buscarautor->id);

        if ($ficha) {
            return response()->json($buscarautor);
        } else {
            return response()->json(['No sirve']);
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
        $buscarautor = Autor::where('ci_autor', $request->ci_autor)->first();
        if (empty($buscarautor)) {
            $validacion = Validator::make(
                $request->all(),
                [
                    'ci_autor' => 'required|unique:autors',
                    'nombre_autor' => 'required',
                    'apellido_autor' => 'required',
                    'titulo' => 'required|unique:fichas',
                    'fecha' => 'required',
                    'carrera' => 'required',
                    'resumen' => 'required',
                ],
                [
                    'ci_autor.required' => 'La cédula es requerida.',
                    'ci_autor.unique' => 'La cédula ya existe dentro del sistema.',
                    'nombre_autor.required' => 'El nombre es requerido',
                    'apellido_autor.required' => 'El apellido es requerido',
                    'titulo.required' => 'El Titulo es requerido',
                    'fecha.required' => 'La fecha es requerida',
                    'carrera.required' => 'La carrera es requerida.',
                    'resumen.required' => 'El resumen es requerido.',
                ]
            );
            if ($request->ajax()) {
                if ($validacion->fails()) {
                    return response()->json(['error' => $validacion->errors()]);
                }

                DB::beginTransaction();

                try {


                    // Crear ficha
                    $ficha = Ficha::create([
                        'titulo' => $request->titulo,
                        'fecha' => $request->fecha,
                        'carrera_id' => $request->carrera,
                        'resumen' => $request->resumen,
                    ]);

                    // Iterar sobre autores
                    foreach ($request->ci_autor as $index => $cedula) {
                        // Crear Estudiante
                        $autor = Autor::create([
                            'ci_autor' => $cedula,
                            'nombre_autor' => $request->nombre_autor[$index],
                            'apellido_autor' => $request->apellido_autor[$index],
                            'ficha_id' => $ficha->id,
                        ]);
                    }

                    DB::commit();
                    return response()->json(['response' => 'Autores creados correctamente.']);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->json(['response' => 'Error en el servidor: ' . $e->getMessage()]);
                }
            } else {
                if ($validacion->fails()) {
                    return back()->with($validacion)->withInput();
                }
            }
        } else {
            $validacion = Validator::make(
                $request->all(),
                [
                    'ci_autor' => 'required|unique:autors',
                    'nombre_autor' => 'required',
                    'apellido_autor' => 'required',
                    'titulo' => 'required|unique:fichas',
                    'fecha' => 'required',
                    'carrera' => 'required',
                    'resumen' => 'required',
                ],
                [
                    'ci_autor.required' => 'La cedula es requerido',
                    'ci_autor.unique' => 'La cedula ya existe',
                    'nombre_autor.required' => 'El nombre es requerido',
                    'apellido_autor.required' => 'El apellido es requerido',
                    'titulo.required' => 'El Titulo es requerido',
                    'fecha.required' => 'La fecha es requerida',
                    'carrera.required' => 'La carrera es requerido',
                    'resumen.required' => 'El resumen es requerido',
                ]
            );
            if ($request->ajax()) {
                if ($validacion->fails()) {
                    return response()->json(['error' => $validacion->errors()]);
                }

                
            } else {
                if ($validacion->fails()) {
                    return back()->with($validacion)->withInput();
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ficha $ficha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ficha $ficha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ficha $ficha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ficha $ficha)
    {
        //
    }
}
