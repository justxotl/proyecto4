<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carreras = Carrera::all();
        return view('admin.carreras.index', compact('carreras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.carreras.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_carrera' => 'required|string|max:255|unique:carreras,nombre',
        ]);

        $carrera = new Carrera();
        $carrera->nombre = $request->nombre_carrera;
        $carrera->save();

        return redirect()->route('admin.carreras.index')
            ->with('mensaje', 'Carrera registrada correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Carrera $carrera)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $carreras = Carrera::find($id);
        return view('admin.carreras.edit', compact('carreras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'nombre_carrera' => 'required|string|max:255|unique:carreras,nombre',
        ]);
        $carrera = Carrera::find($id);
        $carrera->nombre = $request->nombre_carrera;
        $carrera->save();
        
        return redirect()->route('admin.carreras.index')
            ->with('mensaje', 'Carrera Editada correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $carreras = Carrera::find($id);
        $carreras->delete();

        return redirect()->route('admin.carreras.index')
            ->with('mensaje', 'Carrera eliminada correctamente.')
            ->with('icono', 'success');
    }
}
