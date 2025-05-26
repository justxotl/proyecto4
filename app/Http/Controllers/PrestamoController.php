<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Ficha;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prestamos = Prestamo::with('ficha')->get();
        $prestamos->each(function ($prestamo) {
            $prestamo->fecha_prestamo = Carbon::parse($prestamo->fecha_prestamo)->format('d/m/Y');
            $prestamo->fecha_devolucion = Carbon::parse($prestamo->fecha_devolucion)->format('d/m/Y');
        });
        return view('admin.prestamos.index', compact('prestamos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fichas = Ficha::all();
        return view('admin.prestamos.register', compact('fichas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'ficha_id'           => 'required|exists:fichas,id',
            'ci_prestatario'     => 'required|string|max:8',
            'nombre_prestatario' => 'required|string|max:255',
            'apellido_prestatario' => 'required|string|max:255',
            'tlf_prestatario'    => 'required|string|max:11',
            'fecha_prestamo'     => 'required|date',
            'fecha_devolucion'   => 'required|date|after:fecha_prestamo',
        ]);

        $prestamo = new Prestamo();
        $prestamo->ficha_id = $request->ficha_id;
        $prestamo->ci_prestatario = $request->ci_prestatario;
        $prestamo->nombre_prestatario = $request->nombre_prestatario;
        $prestamo->apellido_prestatario = $request->apellido_prestatario;
        $prestamo->tlf_prestatario = $request->tlf_prestatario;
        $prestamo->fecha_prestamo = $request->fecha_prestamo;
        $prestamo->fecha_devolucion = $request->fecha_devolucion;
        $prestamo->save();

        return redirect()->route('admin.prestamos.index')
            ->with('success', 'Préstamo registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $prestamo = Prestamo::with('ficha')->findOrFail($id);

        return view('admin.prestamos.show', compact('prestamo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $prestamo = Prestamo::with('ficha')->findOrFail($id);
        $fichas = Ficha::all();
        return view('admin.prestamos.edit', compact('prestamo', 'fichas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de los campos
        $request->validate([
            'ficha_id'           => 'required|exists:fichas,id',
            'ci_prestatario'     => 'required|string|max:8',
            'nombre_prestatario' => 'required|string|max:255',
            'apellido_prestatario' => 'required|string|max:255',
            'tlf_prestatario'    => 'required|string|max:11',
            'fecha_prestamo'     => 'required|date',
            'fecha_devolucion'   => 'required|date|after:fecha_prestamo',
        ]);

        $prestamo = Prestamo::findOrFail($id);
        $prestamo->ficha_id = $request->ficha_id;
        $prestamo->ci_prestatario = $request->ci_prestatario;
        $prestamo->nombre_prestatario = $request->nombre_prestatario;
        $prestamo->apellido_prestatario = $request->apellido_prestatario;
        $prestamo->tlf_prestatario = $request->tlf_prestatario;
        $prestamo->fecha_prestamo = $request->fecha_prestamo;
        $prestamo->fecha_devolucion = $request->fecha_devolucion;
        $prestamo->save();

        return redirect()->route('admin.prestamos.index')
            ->with(['mensaje' => 'Préstamo actualizado correctamente.', 'icono' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $prestamo = Prestamo::find($id);
        $prestamo->delete();

        return redirect()->route('admin.prestamos.index')
            ->with('mensaje', 'Préstamo eliminado correctamente.')
            ->with('icono', 'success');
    }

    public function devolver(Request $request, $id)
    {
        $prestamo = Prestamo::findOrFail($id);
        $prestamo->estado = 'devuelto';
        $prestamo->fecha_entrega = Carbon::now();
        $prestamo->save();

        return redirect()->route('admin.prestamos.index')
            ->with('mensaje', 'Préstamo marcado como devuelto.')
            ->with('icono', 'success');
    }

    public function exportarPrestamos()
    {
        $fecha = Carbon::now()->format('d-m-Y');
        $nombreArchivo = "listado_de_prestamos_registrados_{$fecha}.xlsx";
        return Excel::download(new \App\Exports\PrestamoExport, $nombreArchivo);
    }
}
