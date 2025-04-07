<?php

namespace App\Http\Controllers;

use App\Models\Autor;
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
            'ci_autor' => 'required|max:8|unique:autors',
            'nombre_autor' => 'required|max:250',
            'apellido_autor' => 'required|max:250',
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
            'ci_autor' => 'required|max:8|unique:autors,ci_autor,' . $autor->id,
            'nombre_autor' => 'required|max:250',
            'apellido_autor' => 'required|max:250',
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
        $autor = Autor::find($id);
        $autor->delete();

        return redirect()->route('admin.autores.index')
            ->with('mensaje', 'Autor eliminado correctamente.')
            ->with('icono', 'success');
    }
}
