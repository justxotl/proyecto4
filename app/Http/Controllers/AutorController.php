<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $autores = Autor::all();
        return view('admin.autores.index', compact('autores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.autores.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ci_autor' => 'required|numeric|digits_between:6,8|unique:autors',
            'nombre_autor' => 'required|string|max:250|regex:/^[\pL\s\-]+$/u',
            'apellido_autor' => 'required|string|max:250|regex:/^[\pL\s\-]+$/u',
        ], [
            'ci_autor.required' => 'Debe ingresar la cédula del autor.',
            'ci_autor.numeric' => 'La cédula solo puede contener números.',
            'ci_autor.digits_between' => 'La cédula debe tener entre 6 y 8 dígitos.',
            'ci_autor.unique' => 'Ya existe un autor registrado con esta cédula.',

            'nombre_autor.required' => 'Debe ingresar el nombre del autor.',
            'nombre_autor.string' => 'El nombre del autor debe ser texto.',
            'nombre_autor.max' => 'El nombre no debe exceder los 250 caracteres.',
            'nombre_autor.regex' => 'El nombre del autor solo puede contener letras, espacios y guiones.',

            'apellido_autor.required' => 'Debe ingresar el apellido del autor.',
            'apellido_autor.string' => 'El apellido del autor debe ser texto.',
            'apellido_autor.max' => 'El apellido no debe exceder los 250 caracteres.',
            'apellido_autor.regex' => 'El apellido del autor solo puede contener letras, espacios y guiones.',
        ]);

        $autor = new Autor();
        $autor->ci_autor = $request->ci_autor;
        $autor->nombre_autor = $request->nombre_autor;
        $autor->apellido_autor = $request->apellido_autor;
        $autor->save();

        return redirect()->route('admin.autores.index')
            ->with('mensaje', 'Autor registrado correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Autor $autor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $autor = Autor::findOrFail($id);
        return view('admin.autores.edit', compact('autor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $autor = Autor::find($id);
        $request->validate([
            'ci_autor' => 'required|numeric|digits_between:6,8|unique:autors,ci_autor,' . $autor->id,
            'nombre_autor' => 'required|string|max:250|regex:/^[\pL\s\-]+$/u',
            'apellido_autor' => 'required|string|max:250|regex:/^[\pL\s\-]+$/u',
        ], [
            'ci_autor.required' => 'Debe ingresar la cédula del autor.',
            'ci_autor.numeric' => 'La cédula solo puede contener números.',
            'ci_autor.digits_between' => 'La cédula debe tener entre 6 y 8 dígitos.',
            'ci_autor.unique' => 'Ya existe un autor registrado con esta cédula.',

            'nombre_autor.required' => 'Debe ingresar el nombre del autor.',
            'nombre_autor.string' => 'El nombre del autor debe ser texto.',
            'nombre_autor.max' => 'El nombre no debe exceder los 250 caracteres.',
            'nombre_autor.regex' => 'El nombre del autor solo puede contener letras, espacios y guiones.',

            'apellido_autor.required' => 'Debe ingresar el apellido del autor.',
            'apellido_autor.string' => 'El apellido del autor debe ser texto.',
            'apellido_autor.max' => 'El apellido no debe exceder los 250 caracteres.',
            'apellido_autor.regex' => 'El apellido del autor solo puede contener letras, espacios y guiones.',
        ]);

        $autor = Autor::find($id);
        $autor->ci_autor = $request->ci_autor;
        $autor->nombre_autor = $request->nombre_autor;
        $autor->apellido_autor = $request->apellido_autor;
        $autor->save();

        return redirect()->route('admin.autores.index')
            ->with('mensaje', 'Autor actualizado correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $autor = Autor::findOrFail($id);

        if ($autor->ficha()->count() > 0) {
            return redirect()->back()->with('mensaje', 'No se puede eliminar el autor porque tiene fichas asociadas.')->with('icono', 'error');
        }
        
        $autor->delete();

        return redirect()->route('admin.autores.index')
            ->with('mensaje', 'Autor eliminado correctamente.')
            ->with('icono', 'success');
    }

    public function exportarAutores()
    {
        $fecha = Carbon::now()->format('d-m-Y');
        $nombreArchivo = "listado_de_autores_registrados_{$fecha}.xlsx";
        return Excel::download(new \App\Exports\AutorExport, $nombreArchivo);
    }

    public function exportPdf()
    {
        $fecha = Carbon::now()->format('d-m-Y');
        $autores = Autor::all();
        $nombreArchivo = "listado_de_autores_registrados_{$fecha}.pdf";
        $pdf = Pdf::loadView('admin.autores.reportepdf', compact('autores'))->setOption(['isPhpEnabled' => true]);

        return $pdf->stream($nombreArchivo);
    }
}
