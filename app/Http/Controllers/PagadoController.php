<?php

namespace App\Http\Controllers;

use App\Pagado;
use App\Ordenpago;
use App\Detallepagado;
use App\Beneficiario;
use App\Tipomovimiento;
use App\Detalleordenpago;
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
        $pagados = Pagado::where('status', 'EP')->paginate();

        return view('pagado.index', compact('pagados'))
            ->with('i', (request()->input('page', 1) - 1) * $pagados->perPage());
    }

    /**
     * Display pagados procesadas
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprocesadas()
    {
        $pagados = Pagado::where('status', 'PR')->paginate();

        return view('pagado.procesados', compact('pagados'))
            ->with('i', (request()->input('page', 1) - 1) * $pagados->perPage());
     }
    
     /**
     * Display pagados procesadas
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
        $pagados = Pagado::where('status', 'AN')->paginate();

        return view('pagado.anulados', compact('pagados'))
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

        $tipomovimientos = Tipomovimiento::pluck('descripcion', 'id');

        return view('pagado.create', compact('pagado','tipomovimientos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request);
        request()->validate(Pagado::$rules);


        //Numero de PAGADOS
        $tipo_pago = $request->tipomovimiento_id;

        $max_correlativo = DB::table('pagados')->where('tipomovimiento_id', $tipo_pago)->max('correlativo');
        $numero_correlativo = $max_correlativo + 1;
        $request->merge(['correlativo'=>$numero_correlativo]);
   
   $pagado = Pagado::create($request->all());


        $ultimo = Pagado::latest('id')->first();
        $pagado_id = $ultimo->id;

        $ordenpago_id = $request->ordenpago_id;
        $detalle_ordenpago = Detalleordenpago::where('ordenpago_id', $ordenpago_id)->get();

        foreach($detalle_ordenpago as $row){
          
            $detalles_pagados=[
                'pagado_id'=> $pagado_id,
                'ordenpago_id'=> $ordenpago_id,
                'unidadadministrativa_id'=> $row->unidadadministrativa_id,
                'ejecucion_id'=> $row->ejecucion_id,
                'montopagado'=> $row->monto
            ];

            
            $detallepagado = Detallepagado::create($detalles_pagados);

        }



        return redirect()->route('pagados.index')
            ->with('success', 'Pagado creado exitosamente.');
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
        $detallepagados = Detallepagado::where('pagado_id', $id)->paginate();

        return view('pagado.show', compact('detallepagados','pagado'))
        ->with('i', (request()->input('page', 1) - 1) * $detallepagados->perPage());
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
        $ordenpagos = Ordenpago::find($pagado->ordenpago_id);
      
        $tipomovimientos = Tipomovimiento::pluck('descripcion', 'id');
        return view('pagado.edit', compact('pagado', 'ordenpagos','tipomovimientos'));
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
        $ordenpagos = Ordenpago::where('status', 'PR')->paginate();

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
     
      // $pagado = new Pagado();
       $ordenpago_id = $id;
        $pagado = new Pagado();

       $ordenpagos = Ordenpago::find($ordenpago_id);
       $tipomovimientos = Tipomovimiento::pluck('descripcion', 'id');

       return view('pagado.agregarorden', compact('pagado','ordenpagos','tipomovimientos'));

    }


    //Metodo para aprobar un pagado
    /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada el pagado
     * @throws \Exception
     */
    public function aprobar($id)
    {
        $aprobado = 1;

        $pagado = Pagado::find($id);
        $pagado->status = 'PR';
        $pagado->save();
        //pagado
        $ordenpago = Ordenpago::find($pagado->ordenpago_id);
        $ordenpago->status = 'AP';
        $ordenpago->save();

        //Obtener el detalle de orden de pago para aplicar en la ejecucion
        $detalleordenpago = Detalleordenpago::where('ordenpago_id','=',$ordenpago->id)->get();

        //Ciclo para guardar detalle de orden de pago
        foreach($detalleordenpago as $row){
            $datos_guardar = [
                'pagado_id'=> $id,
                'ordenpago_id'=> $id,
                'unidadadministrativa_id'=> $row->unidadadministrativa_id,
                'ejecucion_id'=> $row->ejecucion_id,
                'montopagado'=> $row->monto,
            ];
            $detallepagado = Detallepagado::create($datos_guardar);
                            //Obtener la ejecucion
        //    $ejecucion = Ejecucione::find($rows->ejecucion_id);
            
        //        $ejecucion->save();
       
        }

        if($aprobado == 1){
            return redirect()->route('pagados.procesados')
            ->with('success', 'Pago Aprobada Exitosamente. ');
        }else{
            return redirect()->route('pagados.index')
            ->with('success', 'No Aprobado. No hay Disponibilidad o ha ocurrido un error en el registro');
        }

    }

}
