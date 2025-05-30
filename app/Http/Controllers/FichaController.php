<?php

namespace App\Http\Controllers;

use App\Models\Ficha;
use App\Models\Autor;
use App\Models\Carrera;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
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

    public function fichasBuscar($id)
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
                'ci_autor.*' => 'required|numeric|digits_between:6,8',
                'nombre_autor.*' => 'required|string|max:100',
                'apellido_autor.*' => 'required|string|max:100',
                'titulo' => 'required|string|max:900|unique:fichas,titulo',
                'fecha' => 'required|date',
                'carrera' => 'required',
                'resumen' => 'required|string|max:5000',
            ],
            [
                // CI AUTOR
                'ci_autor.*.required' => 'La cédula del autor es requerida.',
                'ci_autor.*.numeric' => 'La cédula solo puede contener números.',
                'ci_autor.*.digits_between' => 'La cédula debe tener entre 6 y 8 dígitos.',

                // NOMBRE AUTOR
                'nombre_autor.*.required' => 'El nombre del autor es requerido.',
                'nombre_autor.*.string' => 'El nombre del autor debe ser texto.',
                'nombre_autor.*.max' => 'El nombre del autor no debe exceder 100 caracteres.',

                // APELLIDO AUTOR
                'apellido_autor.*.required' => 'El apellido del autor es requerido.',
                'apellido_autor.*.string' => 'El apellido del autor debe ser texto.',
                'apellido_autor.*.max' => 'El apellido del autor no debe exceder 100 caracteres.',

                // TÍTULO
                'titulo.required' => 'El título del trabajo es requerido.',
                'titulo.string' => 'El título debe ser texto.',
                'titulo.max' => 'El título no debe exceder 900 caracteres.',
                'titulo.unique' => 'Ya existe una ficha registrada con este título.',

                // FECHA
                'fecha.required' => 'La fecha del trabajo es requerida.',
                'fecha.date' => 'La fecha debe tener un formato válido.',

                // CARRERA
                'carrera.required' => 'Debes seleccionar una carrera.',

                // RESUMEN
                'resumen.required' => 'El resumen del trabajo es requerido.',
                'resumen.string' => 'El resumen debe ser texto.',
                'resumen.max' => 'El resumen no debe exceder 5000 caracteres.',
            ]
        );
        if ($validacion->fails()) {
            // Si la petición es AJAX, responde con JSON y 422
            if ($request->ajax()) {
                return response()->json(['errors' => $validacion->errors()], 422);
            }
            // Si no es AJAX, sigue como antes
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
     * Generate PDF for the specified resource.
     */
    public function pdf($id)
    {
        $ficha = Ficha::with('autor')->where('id', $id)->first();
        $pdf = Pdf::loadView('admin.fichas.pdf', compact('ficha'))
            ->setPaper('letter', 'portrait') // Configura el tamaño y orientación de la página
            ->setOption('isHtml5ParserEnabled', true) // Habilita el parser HTML5
            ->setOption('isPhpEnabled', true); // Habilita el uso de PHP en las vistas

        return $pdf->stream();
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
                'ci_autor.*' => 'required|numeric|digits_between:6,8',
                'nombre_autor.*' => 'required|string|max:100',
                'apellido_autor.*' => 'required|string|max:100',
                'titulo' => 'required|string|max:900|unique:fichas,titulo,' . $id,
                'fecha' => 'required|date',
                'carrera' => 'required',
                'resumen' => 'required|string|max:5000',
            ],
            [
                // CI AUTOR
                'ci_autor.*.required' => 'La cédula del autor es requerida.',
                'ci_autor.*.numeric' => 'La cédula solo puede contener números.',
                'ci_autor.*.digits_between' => 'La cédula debe tener entre 6 y 8 dígitos.',

                // NOMBRE AUTOR
                'nombre_autor.*.required' => 'El nombre del autor es requerido.',
                'nombre_autor.*.string' => 'El nombre del autor debe ser texto.',
                'nombre_autor.*.max' => 'El nombre del autor no debe exceder 100 caracteres.',

                // APELLIDO AUTOR
                'apellido_autor.*.required' => 'El apellido del autor es requerido.',
                'apellido_autor.*.string' => 'El apellido del autor debe ser texto.',
                'apellido_autor.*.max' => 'El apellido del autor no debe exceder 100 caracteres.',

                // TÍTULO
                'titulo.required' => 'El título del trabajo es requerido.',
                'titulo.string' => 'El título debe ser texto.',
                'titulo.max' => 'El título no debe exceder 900 caracteres.',
                'titulo.unique' => 'Ya existe una ficha registrada con este título.',

                // FECHA
                'fecha.required' => 'La fecha del trabajo es requerida.',
                'fecha.date' => 'La fecha debe tener un formato válido.',

                // CARRERA
                'carrera.required' => 'Debes seleccionar una carrera.',

                // RESUMEN
                'resumen.required' => 'El resumen del trabajo es requerido.',
                'resumen.string' => 'El resumen debe ser texto.',
                'resumen.max' => 'El resumen no debe exceder 5000 caracteres.',
            ]
        );

        if ($validacion->fails()) {
            // Si la petición es AJAX, responde con JSON y 422
            if ($request->ajax()) {
                return response()->json(['errors' => $validacion->errors()], 422);
            }
            // Si no es AJAX, sigue como antes
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

    public function quitar($id)
    {

        try {
            // Buscar la ficha que tiene asociado al autor
            $ficha = Ficha::whereHas('autor', function ($query) use ($id) {
                $query->where('autors.id', $id);
            })->first();

            if (!$ficha) {
                return response()->json(['message' => 'La relación no existe.'], 404);
            }

            // Desasociar al autor de la ficha
            $ficha->autor()->detach($id);

            return response()->json(['message' => 'El autor ha sido eliminado de la ficha correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el autor: ' . $e->getMessage()], 500);
        }
    }

    public function exportarFichas()
    {
        $fecha = Carbon::now()->format('d-m-Y');
        $nombreArchivo = "listado_de_fichas_registradas_{$fecha}.xlsx";
        return Excel::download(new \App\Exports\FichasExport, $nombreArchivo);
    }

    public function exportPdf()
    {
        $fecha = Carbon::now()->format('d-m-Y');
        $fichas = Ficha::with(['carrera', 'autor'])->get();
        $nombreArchivo = "listado_de_fichas_registradas_{$fecha}.pdf";
        $pdf = Pdf::loadView('admin.fichas.reportepdf', compact('fichas'))->setOption(['isPhpEnabled' => true]);

        return $pdf->stream($nombreArchivo);
    }
}
