<?php

namespace App\Http\Controllers;

use App\Pagado;
use App\Ordenpago;
use App\Detallepagado;
use App\Beneficiario;
use App\Detalleordenpago;
use App\Tipomovimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

/**
 * Class PagadoController
 * @package App\Http\Controllers
 */
class PagadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagados = Pagado::paginate();

        return view('pagado.index', compact('pagados'))
            ->with('i', (request()->input('page', 1) - 1) * $pagados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagado = new Pagado();
      
        return view('pagado.create', compact('pagado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Pagado::$rules);

        //Numero de PAGADOS
        $max_correlativo = DB::table('pagados')->max('correlativo');
        $numero_correlativo = $max_correlativo + 1;
        $request->merge(['correlativo'=>$numero_correlativo]);

        $pagado = Pagado::create($request->all());

        $ultimo = Pagado::latest('id')->first();
        $pagado_id = $ultimo->id;

        $ordenpago_id = $request->ordenpago_id;
        $detalleordenpago = Detalleordenpago::where('ordenpago_id', $ordenpago_id)->get();

        foreach($detalleordenpago as $row){
          
            $detalles_pagados=[
                'pagado_id'=> $pagado_id,
                'ordenpago_id'=> $ordenpago_id,
                'unidadadministrativa_id'=> $row->unidadadministrativa_id,
                'ejecucion_id'=> $row->ejecucion_id,
                'montopagado'=> $row->monto
            ];

            
            $detalles_paga = Detallepagado::create($detalles_pagados);

        }



        return redirect()->route('pagados.index')
            ->with('success', 'Pagado created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pagado = Pagado::find($id);

        return view('pagado.show', compact('pagado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pagado = Pagado::find($id);
      
        return view('pagado.edit', compact('pagado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Pagado $pagado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagado $pagado)
    {
        request()->validate(Pagado::$rules);

        $pagado->update($request->all());

        return redirect()->route('pagados.index')
            ->with('success', 'Pagado updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pagado = Pagado::find($id)->delete();

        return redirect()->route('pagados.index')
            ->with('success', 'Pagado deleted successfully');
    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agregar()
    {
        $ordenpagos = Ordenpago::paginate();

        return view('pagado.agregar', compact('ordenpagos'))
            ->with('i', (request()->input('page', 1) - 1) * $ordenpagos->perPage());
    }

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agregarorden($id)
    {
        $pagado = new Pagado();
      
        $ordenpagos = Ordenpago::find($id);

       
        return view('pagado.create', compact('pagado', 'ordenpagos'));
    }


}
