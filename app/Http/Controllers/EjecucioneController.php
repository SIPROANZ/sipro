<?php

namespace App\Http\Controllers;

use App\Ejecucione;
use App\Ejercicio;
use App\Unidadadministrativa;
use App\Meta;
use App\Financiamiento;
use App\Poa;
use App\Detallescompromiso;
use App\Detalleordenpago;
use App\Detallepagado;
use App\Detallesmodificacione;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;


/**
 * Class EjecucioneController
 * @package App\Http\Controllers
 */
class EjecucioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ejecuciones = Ejecucione::orderBy('unidadadministrativa_id', 'asc')->paginate();

        $total_presupuestario = DB::table('ejecuciones')->sum('monto_actualizado');
        $total_comprometido = DB::table('ejecuciones')->sum('monto_comprometido');
        $total_causado = DB::table('ejecuciones')->sum('monto_causado');
        $total_pagado = DB::table('ejecuciones')->sum('monto_pagado');
        $total_disponible = $total_presupuestario - $total_comprometido;
        $porc_comprometido = ( $total_comprometido * 100 ) / $total_presupuestario;
        $porc_causado = ( $total_causado * 100 ) / $total_presupuestario;
        $porc_pagado = ( $total_pagado * 100 ) / $total_presupuestario;
        $porc_disponible = ( $total_disponible * 100 ) / $total_presupuestario;

        $tpcomprometido = $porc_comprometido;
        $tpcausado = $porc_causado;
        $tppagado = $porc_pagado;
        $tpdisponible = $porc_disponible;

        $total_presupuestario = number_format($total_presupuestario, 2, ",", ".");
        $total_comprometido = number_format($total_comprometido, 2, ",", ".");
        $total_causado = number_format($total_causado, 2, ",", ".");
        $total_pagado = number_format($total_pagado, 2, ",", ".");
        $total_disponible = number_format($total_disponible, 2, ",", ".");
        $porc_comprometido = number_format($porc_comprometido, 2, ",", ".");
        $porc_causado = number_format($porc_causado, 2, ",", ".");
        $porc_pagado = number_format($porc_pagado, 2, ",", ".");
        $porc_disponible = number_format($porc_disponible, 2, ",", ".");


        $datos = [
            'total_presupuestario'=>$total_presupuestario,
            'total_comprometido'=>$total_comprometido,
            'total_causado'=>$total_causado,
            'total_pagado'=>$total_pagado,
            'total_disponible'=>$total_disponible,
            'porc_comprometido'=>$porc_comprometido,
            'porc_causado'=>$porc_causado,
            'porc_pagado'=>$porc_pagado,
            'porc_disponible'=>$porc_disponible,
            'tpcomprometido'=>$tpcomprometido,
            'tpcausado'=>$tpcausado,
            'tppagado'=>$tppagado,
            'tpdisponible'=>$tpdisponible
        ];

        return view('ejecucione.index', compact('ejecuciones', 'datos'))
            ->with('i', (request()->input('page', 1) - 1) * $ejecuciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ejecucione = new Ejecucione();
        $ejercicio = Ejercicio::pluck('nombreejercicio', 'id'); 
        $unidadadministrativa = Unidadadministrativa::pluck('sector' , 'id'); 
        $meta = Meta::pluck('meta' , 'id'); 
        $financiamiento = Financiamiento::pluck('nombre', 'id'); 
        $poa = Poa::pluck('proyecto', 'id');

        return view('ejecucione.create', compact('ejecucione' , 'ejercicio' , 'unidadadministrativa' , 'meta' , 'financiamiento' , 'poa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ejecucione::$rules);

        $ejecucione = Ejecucione::create($request->all());

        return redirect()->route('ejecuciones.index')
            ->with('success', 'Ejecución creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ejecucione = Ejecucione::find($id);

        $detallescompromisos = Detallescompromiso::where('ejecucion_id', $id)->paginate();
        $detalleordenpagos = Detalleordenpago::where('ejecucion_id', $id)->paginate();
        $detallepagados = Detallepagado::where('ejecucion_id', $id)->paginate();
        $detallesmodificaciones = Detallesmodificacione::where('ejecucion_id', $id)->paginate();

        return view('ejecucione.show', compact('detallescompromisos', 'ejecucione', 'detalleordenpagos', 'detallepagados', 'detallesmodificaciones'))
            ->with('i', (request()->input('page', 1) - 1) * $detallescompromisos->perPage());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ejecucione = Ejecucione::find($id);

        return view('ejecucione.edit', compact('ejecucione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ejecucione $ejecucione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ejecucione $ejecucione)
    {
        request()->validate(Ejecucione::$rules);

        $ejecucione->update($request->all());

        return redirect()->route('ejecuciones.index')
            ->with('success', 'Ejecución actualizada con éxito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ejecucione = Ejecucione::find($id)->delete();

        return redirect()->route('ejecuciones.index')
            ->with('success', 'Ejecución eliminada con éxito');
    }

    /**
     * Crear pdf de la requisicion seleccionada
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf()
    {
      
        $ejecuciones = Ejecucione::orderBy('unidadadministrativa_id', 'asc')->get();


        $pdf = PDF::loadView('ejecucione.pdf', ['ejecuciones'=>$ejecuciones]);
        return $pdf->stream();
 
    }
}
