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
            'ficha_id'             => 'required|exists:fichas,id',
            'ci_prestatario'       => 'required|numeric|digits_between:6,8',
            'nombre_prestatario'   => 'required|string|max:255',
            'apellido_prestatario' => 'required|string|max:255',
            'tlf_prestatario'      => 'required|numeric|digits:11',
            'fecha_prestamo'       => 'required|date',
            'fecha_devolucion'     => 'required|date|after:fecha_prestamo',
        ], [
            'ficha_id.required' => 'Debe seleccionar una ficha a prestar.',
            'ficha_id.exists' => 'La ficha seleccionada no existe.',

            'ci_prestatario.required' => 'Debe ingresar la cédula del prestatario.',
            'ci_prestatario.numeric' => 'La cédula solo puede contener números.',
            'ci_prestatario.digits_between' => 'La cédula debe tener entre 6 y 8 dígitos.',

            'nombre_prestatario.required' => 'Debe ingresar el nombre del prestatario.',
            'nombre_prestatario.string' => 'El nombre del prestatario debe ser texto.',
            'nombre_prestatario.max' => 'El nombre no debe exceder 255 caracteres.',

            'apellido_prestatario.required' => 'Debe ingresar el apellido del prestatario.',
            'apellido_prestatario.string' => 'El apellido del prestatario debe ser texto.',
            'apellido_prestatario.max' => 'El apellido no debe exceder 255 caracteres.',

            'tlf_prestatario.required' => 'Debe ingresar el número de teléfono del prestatario.',
            'tlf_prestatario.numeric' => 'El número de teléfono solo puede contener números.',
            'tlf_prestatario.digits' => 'El número de teléfono debe tener exactamente 11 dígitos.',

            'fecha_prestamo.required' => 'Debe indicar la fecha del préstamo.',
            'fecha_prestamo.date' => 'La fecha de préstamo debe ser válida.',

            'fecha_devolucion.required' => 'Debe indicar la fecha de devolución.',
            'fecha_devolucion.date' => 'La fecha de devolución debe ser válida.',
            'fecha_devolucion.after' => 'La fecha de devolución debe ser posterior a la fecha de préstamo.',
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
            'ficha_id'             => 'required|exists:fichas,id',
            'ci_prestatario'       => 'required|numeric|digits_between:6,8',
            'nombre_prestatario'   => 'required|string|max:255',
            'apellido_prestatario' => 'required|string|max:255',
            'tlf_prestatario'      => 'required|numeric|digits:11',
            'fecha_prestamo'       => 'required|date',
            'fecha_devolucion'     => 'required|date|after:fecha_prestamo',
        ], [
            'ficha_id.required' => 'Debe seleccionar una ficha a prestar.',
            'ficha_id.exists' => 'La ficha seleccionada no existe.',

            'ci_prestatario.required' => 'Debe ingresar la cédula del prestatario.',
            'ci_prestatario.numeric' => 'La cédula solo puede contener números.',
            'ci_prestatario.digits_between' => 'La cédula debe tener entre 6 y 8 dígitos.',

            'nombre_prestatario.required' => 'Debe ingresar el nombre del prestatario.',
            'nombre_prestatario.string' => 'El nombre del prestatario debe ser texto.',
            'nombre_prestatario.max' => 'El nombre no debe exceder 255 caracteres.',

            'apellido_prestatario.required' => 'Debe ingresar el apellido del prestatario.',
            'apellido_prestatario.string' => 'El apellido del prestatario debe ser texto.',
            'apellido_prestatario.max' => 'El apellido no debe exceder 255 caracteres.',

            'tlf_prestatario.required' => 'Debe ingresar el número de teléfono del prestatario.',
            'tlf_prestatario.numeric' => 'El número de teléfono solo puede contener números.',
            'tlf_prestatario.digits' => 'El número de teléfono debe tener exactamente 11 dígitos.',

            'fecha_prestamo.required' => 'Debe indicar la fecha del préstamo.',
            'fecha_prestamo.date' => 'La fecha de préstamo debe ser válida.',

            'fecha_devolucion.required' => 'Debe indicar la fecha de devolución.',
            'fecha_devolucion.date' => 'La fecha de devolución debe ser válida.',
            'fecha_devolucion.after' => 'La fecha de devolución debe ser posterior a la fecha de préstamo.',
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

    public function exportPdf()
    {
        $fecha = Carbon::now()->format('d-m-Y');
        $prestamos = Prestamo::with(['ficha'])->get();
        $nombreArchivo = "listado_de_prestamos_registrados_{$fecha}.pdf";
        $pdf = Pdf::loadView('admin.prestamos.reportepdf', compact('prestamos'))->setOption(['isPhpEnabled' => true]);

        return $pdf->stream($nombreArchivo);
    }

    public function pdf($id)
    {
        $prestamo = Prestamo::with('ficha')->where('id', $id)->first();
        $pdf = Pdf::loadView('admin.prestamos.pdf', compact('prestamo'))
            ->setPaper('letter', 'portrait') // Configura el tamaño y orientación de la página
            ->setOption('isHtml5ParserEnabled', true) // Habilita el parser HTML5
            ->setOption('isPhpEnabled', true); // Habilita el uso de PHP en las vistas

        return $pdf->stream();
    }
}
