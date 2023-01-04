<?php

namespace App\Http\Controllers;

use App\Modificacione;
use App\Tipomodificacione;
use App\Detallesmodificacione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

/**
 * Class ModificacioneController
 * @package App\Http\Controllers
 */
class ModificacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modificaciones = Modificacione::paginate();

        return view('modificacione.index', compact('modificaciones'))
            ->with('i', (request()->input('page', 1) - 1) * $modificaciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modificacione = new Modificacione();
        $tipomodificaciones = Tipomodificacione::pluck('nombre','id');

        return view('modificacione.create', compact('modificacione', 'tipomodificaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Modificacione::$rules);

        //Tomar el numero de modificacion y aumentarlo a uno para registrar dicho valor
        $max_correlativo = DB::table('modificaciones')->max('numero');
        $numero_correlativo = $max_correlativo + 1;
        $request->merge(['numero'=>$numero_correlativo]);
        $request->merge(['status'=>'EP']);



        $modificacione = Modificacione::create($request->all());

        return redirect()->route('modificaciones.index')
            ->with('success', 'Modificacione created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modificacione = Modificacione::find($id);

        return view('modificacione.show', compact('modificacione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modificacione = Modificacione::find($id);

        return view('modificacione.edit', compact('modificacione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Modificacione $modificacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modificacione $modificacione)
    {
        request()->validate(Modificacione::$rules);

        $modificacione->update($request->all());

        return redirect()->route('modificaciones.index')
            ->with('success', 'Modificacione updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $modificacione = Modificacione::find($id)->delete();

        return redirect()->route('modificaciones.index')
            ->with('success', 'Modificacione deleted successfully');
    }

      /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregarmodificacion($id)
    {   session(['modificacion' => $id]);
        $modificacione = Modificacione::find($id);
        $detallesmodificaciones = Detallesmodificacione::paginate();

        return view('modificacione.agregarmodificacion', compact('modificacione', 'detallesmodificaciones'));
    }
}
