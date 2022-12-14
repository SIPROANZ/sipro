<?php

namespace App\Http\Controllers;

use App\Compromiso;
use App\Detalleordenpago;
use App\Detalleretencione;
use App\Detallescompromiso;
use App\Ejecucione;
use App\Ordenpago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class OrdenpagoController
 * @package App\Http\Controllers
 */
class OrdenpagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenpagos = Ordenpago::where('status', 'EP')->paginate();

        return view('ordenpago.index', compact('ordenpagos'))
            ->with('i', (request()->input('page', 1) - 1) * $ordenpagos->perPage());
    }

    public function indexcompromisos()
    {
       // $compras = Compra::paginate();
        $compromisos = Compromiso::where('status', 'PR')->paginate();


        return view('ordenpago.compromisos', compact('compromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $compromisos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ordenpago = new Ordenpago();

        return view('ordenpago.create', compact('ordenpago'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ordenpago::$rules);

        $max_correlativo = DB::table('ordenpagos')->max('nordenpago');
        $numero_correlativo = $max_correlativo + 1;
        $request->merge(['nordenpago'=>$numero_correlativo]);
        $request->merge(['status'=>'EP']);
        $nordenpago = Ordenpago::create($request->all());
        //Obtener el ultimo ID
        $ultimo = Ordenpago::latest('id')->first();
        $nordenpago_id = $ultimo->id;

        $compromiso = Compromiso::find($nordenpago->compromiso_id);
        //dd($compromiso);
        $compromiso->status = 'AP';
        $compromiso->save();

/*         //Agregar los clasificadores presupuestarios al compomiso
        $compra_id = $request->compra_id;
        //Obtener el detalle de las comprascps
        $detalles_comprascp = Comprascp::where('compra_id', $compra_id)->get();

        foreach($detalles_comprascp as $row){
            //crear el array datos para agregarlo al detalle compromiso
            $detalles_compromisos=[
                'montocompromiso'=> $row->monto,
                'compromiso_id'=> $compromiso_id,
                'unidadadministrativa_id'=> $row->unidadadministrativa_id,
                'ejecucion_id'=> $row->ejecucion_id,
            ];

            //agregar detalles del compromiso
            $detallescompromiso = Detallescompromiso::create($detalles_compromisos); */

        return redirect()->route('ordenpagos.index')
            ->with('success', 'Orden de Pago creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ordenpago = Ordenpago::find($id);
        $detalleretenciones = Detalleretencione::where('ordenpago_id','=',$id)->paginate();

        return view('ordenpago.show', compact('ordenpago','detalleretenciones'))->with('i');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ordenpago = Ordenpago::find($id);
        $compromiso = Compromiso::find($ordenpago->compromiso_id);

        return view('ordenpago.edit', compact('ordenpago','compromiso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ordenpago $ordenpago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ordenpago $ordenpago)
    {
        request()->validate(Ordenpago::$rules);

        $ordenpago->update($request->all());

        return redirect()->route('ordenpagos.index')
            ->with('success', 'Ordenpago updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ordenpago = Ordenpago::find($id)->delete();

        return redirect()->route('ordenpagos.index')
            ->with('success', 'Ordenpago deleted successfully');
    }

        /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregar($id)
    {
        $ordenpago = Ordenpago::find($id);


        //Creare una variable de sesion para guardar el id de esta requisicion
        session(['ordenpago' => $id]);

        //Consulto los datos especificos para la requisicion seleccionada
        $detalleretenciones = Detalleretencione::where('ordenpago_id','=',$id)->paginate();

        return view('ordenpago.agregar', compact('ordenpago', 'detalleretenciones'))
        ->with('i', (request()->input('page', 1) - 1) * $detalleretenciones->perPage());
    }

    public function agregarordenpago($id)
    {
        $compromiso_id = $id;
        $ordenpago = new Ordenpago();

        $compromiso = Compromiso::find($compromiso_id);
/*         $compromiso->status = 'AP';
        $compromiso->save();
        $proveedor = $compromiso->beneficiario->nombre; */

        return view('ordenpago.agregarordenpago', compact('compromiso', 'ordenpago'));
    }


    //Metodo para aprobar un analisis de cotizacion
    /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada la requisicion
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function aprobar($id)
    {
        $aprobado = 1;

        $ordenpago = Ordenpago::find($id);
        $ordenpago->status = 'PR';
        $ordenpago->save();
        //Obtener la compra y tambien actualizar su estado
        $compromiso = Compromiso::find($ordenpago->compromiso_id);
        $compromiso->status = 'AP';
        $compromiso->save();

        //Obtener el detalle de compromiso para aplicar en la ejecucion
        $detallescompromiso = Detallescompromiso::where('compromiso_id','=',$compromiso->id)->get();

        //Ciclo para guardar detalle de orden de pago
        foreach($detallescompromiso as $rows){
            $datos_guardar = [
                'ordenpago_id' => $id,
                'unidadadministrativa_id' => $rows->unidadadministrativa_id,
                'ejecucion_id' => $rows->ejecucion_id,
                'monto' => $rows->montocompromiso,
            ];
            $detalleordenpago = Detalleordenpago::create($datos_guardar);
                            //Obtener la ejecucion
            $ejecucion = Ejecucione::find($rows->ejecucion_id);
            //dd($rows);
            //Hacer el if
            // if($rows->montocompromiso <= $ejecucion->monto_por_causar){
                $ejecucion->increment('monto_causado', $rows->montocompromiso);
                $ejecucion->decrement('monto_por_causar', $rows->montocompromiso);
                $ejecucion->increment('monto_por_pagar', $rows->montocompromiso);
                $ejecucion->save();
/*             }else{
                $aprobado = 0;
            } */
        }

        if($aprobado == 1){
            return redirect()->route('ordenpagos.procesados')
            ->with('success', 'Orden de Pago Aprobada Exitosamente. ');
        }else{
            return redirect()->route('ordenpagos.index')
            ->with('success', 'No Aprobado. No hay Disponibilidad o ha ocurrido un error en el registro');
        }

    }

        /**
     * Display requisiciones procesadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprocesadas()
    {
        $ordenpagos = Ordenpago::where('status', 'PR')->paginate();

        return view('ordenpago.procesados', compact('ordenpagos'))
            ->with('i', (request()->input('page', 1) - 1) * $ordenpagos->perPage());
    }

    /**
     * Display requisiciones anuladas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
        $ordenpagos = Ordenpago::where('status', 'AN')->paginate();

        return view('ordenpago.anulados', compact('ordenpagos'))
            ->with('i', (request()->input('page', 1) - 1) * $ordenpagos->perPage());
    }

    /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function anular($id)
    {

        $ordenpago = Ordenpago::find($id);
        $ordenpago->status = 'AN';
        $ordenpago->save();

        //Obtener el detalle de compromiso para reversar la ejecucion
        $detallescompromiso = Detallescompromiso::where('compromiso_id','=',$ordenpago->compromiso_id)->get();

        //Ciclo para guardar detalle de orden de pago
        foreach($detallescompromiso as $rows){
            $ejecucion = Ejecucione::find($rows->ejecucion_id);
            $ejecucion->decrement('monto_causado', $rows->montocompromiso);
            $ejecucion->increment('monto_por_causar', $rows->montocompromiso);
            $ejecucion->decrement('monto_por_pagar', $rows->montocompromiso);
            $ejecucion->save();
        }

        $detallesordepago = Detalleordenpago::where('ordenpago_id','=',$ordenpago->id)->delete();

        return redirect()->route('ordenpagos.index')
            ->with('success', 'Orden de Pago Anulada exitosamente.');


    }
}
