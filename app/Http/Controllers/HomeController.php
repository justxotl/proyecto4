<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ficha;
use App\Models\Carrera;
use App\Models\Autor;
use App\Models\Prestamo;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        $fichas = Ficha::all();
        $autores = Autor::all();
        $carreras = Carrera::all();
        $prestamoActivo = Prestamo::where('estado', 'prestado')->count();

        $hascarreras = Carrera::withCount('ficha')->get();
        $fichasPorYear = Ficha::select(
            DB::raw('YEAR(fecha) as year'),
            DB::raw('COUNT(*) as cantidad')
        )
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $prestamosPorMes = Prestamo::selectRaw('YEAR(fecha_prestamo) as year, MONTH(fecha_prestamo) as month, COUNT(*) as cantidad')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->groupBy('year');

        return view('home', compact('users', 'roles', 'fichas', 'carreras', 'autores', 'hascarreras', 'fichasPorYear', 'prestamoActivo', 'prestamosPorMes'));
    }
}
