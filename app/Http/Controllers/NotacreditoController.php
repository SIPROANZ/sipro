<?php

namespace App\Http\Controllers;

use App\Notacredito;
use App\Ejercicio;
use App\Cuentasbancaria;
use App\Beneficiario;
use App\Institucione;
use Illuminate\Http\Request;

/**
 * Class NotacreditoController
 * @package App\Http\Controllers
 */
class NotacreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notacreditos = Notacredito::paginate();

        return view('notacredito.index', compact('notacreditos'))
            ->with('i', (request()->input('page', 1) - 1) * $notacreditos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notacredito = new Notacredito();

        $ejercicios = Ejercicio::pluck('nombreejercicio' , 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        $cuentasbancarias = Cuentasbancaria::pluck('cuenta', 'id');
        $beneficiarios = Beneficiario::pluck('nombre', 'id');
        return view('notacredito.create', compact('notacredito', 'ejercicios', 'instituciones', 'cuentasbancarias', 'beneficiarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Notacredito::$rules);

        $notacredito = Notacredito::create($request->all());

        return redirect()->route('notacreditos.index')
            ->with('success', 'Nota credito creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notacredito = Notacredito::find($id);

        return view('notacredito.show', compact('notacredito'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notacredito = Notacredito::find($id);
        $ejercicios = Ejercicio::pluck('nombreejercicio' , 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        $cuentasbancarias = Cuentasbancaria::pluck('cuenta', 'id');
        $beneficiarios = Beneficiario::pluck('nombre', 'id');
        return view('notacredito.edit', compact('notacredito', 'ejercicios', 'instituciones', 'cuentasbancarias', 'beneficiarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Notacredito $notacredito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notacredito $notacredito)
    {
        request()->validate(Notacredito::$rules);

        $notacredito->update($request->all());

        return redirect()->route('notacreditos.index')
            ->with('success', 'Nota credito actualizada exitosamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $notacredito = Notacredito::find($id)->delete();

        return redirect()->route('notacreditos.index')
            ->with('success', 'Nota credito eliminada exitosamente');
    }
}
