<?php

namespace App\Http\Controllers;

use App\Analisi;
use App\Unidadadministrativa;
use App\Requisicione;
use App\Criterio;
use Illuminate\Http\Request;

/**
 * Class AnalisiController
 * @package App\Http\Controllers
 */
class AnalisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $analisis = Analisi::paginate();

        return view('analisi.index', compact('analisis'))
            ->with('i', (request()->input('page', 1) - 1) * $analisis->perPage());
    }

    /**
     * Display requisiciones procesadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprocesadas()
    {
        $analisis = Analisi::where('estatus', 'PR')->paginate();

        return view('analisi.procesadas', compact('analisis'))
            ->with('i', (request()->input('page', 1) - 1) * $analisis->perPage());
    }

    /**
     * Display requisiciones anuladas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
        $analisis = Analisi::where('estatus', 'AN')->paginate();

        return view('analisi.anuladas', compact('analisis'))
            ->with('i', (request()->input('page', 1) - 1) * $analisis->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $analisi = new Analisi();

        $unidadesadministrativas = Unidadadministrativa::pluck('denominacion', 'id');
        $requisiciones = Requisicione::pluck('concepto', 'id');
        $criterios = Criterio::pluck('nombre', 'id');

        return view('analisi.create', compact('analisi', 'unidadesadministrativas', 'requisiciones', 'criterios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Analisi::$rules);

        $analisi = Analisi::create($request->all());

        return redirect()->route('analisis.index')
            ->with('success', 'Analisi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $analisi = Analisi::find($id);

        return view('analisi.show', compact('analisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $analisi = Analisi::find($id);

        $unidadesadministrativas = Unidadadministrativa::pluck('denominacion', 'id');
        $requisiciones = Requisicione::pluck('concepto', 'id');
        $criterios = Criterio::pluck('nombre', 'id');

        return view('analisi.edit', compact('analisi', 'unidadesadministrativas', 'requisiciones', 'criterios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Analisi $analisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Analisi $analisi)
    {
        request()->validate(Analisi::$rules);

        $analisi->update($request->all());

        return redirect()->route('analisis.index')
            ->with('success', 'Analisi updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $analisi = Analisi::find($id)->delete();

        return redirect()->route('analisis.index')
            ->with('success', 'Analisi deleted successfully');
    }

    /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function anular($id)
    {
        $analisi = Analisi::find($id);
        $analisi->estatus = 'AN';
        $analisi->save();

        return redirect()->route('analisis.index')
            ->with('success', 'Analisis de Cotizacion Anulada exitosamente.');
    }

    //Metodo para aprobar un analisis de cotizacion
    /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada la requisicion
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function aprobar($id)
    {
        $analisi = Analisi::find($id);
        $analisi->estatus = 'PR';
        $analisi->save();

        return redirect()->route('analisis.index')
            ->with('success', 'Analisis de Cotizacion Procesada exitosamente.');
    }
}
