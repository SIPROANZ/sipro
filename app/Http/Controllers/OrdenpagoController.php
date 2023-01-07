<?php

namespace App\Http\Controllers;

use App\Compromiso;
use App\Detalleretencione;
use App\Detallesanalisi;
use App\Ordenpago;
use App\Tipodecompromiso;
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
    public function reversar($id)
    {
        $compra = Compra::find($id);
        $compra->estatus = 'EP';
        $compra->save();

        return redirect()->route('compromisos.index')
            ->with('success', 'Compra Reversada exitosamente.');
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

        $compromiso = Compromiso::find($id);
        $compromiso->status = 'PR';
        $compromiso->save();
        //Obtener la compra y tambien actualizar su estado
        $compra = Compra::find($compromiso->compra_id);
        $compra->status = 'AP';
        $compra->save();

        //Obtener el detalle ejecucion y corroborar que haya disponibilidad
        $detallescompromisos = Detallescompromiso::where('compromiso_id','=',$id)->get();

        //Ciclo para imputar
        foreach($detallescompromisos as $rows){
            //Obtener la ejecucion
            $ejecucion = Ejecucione::find($rows->ejecucion_id);
            //Hacer el if
            if($rows->montocompromiso <= $ejecucion->monto_por_comprometer){
                $ejecucion->increment('monto_comprometido', $rows->montocompromiso);
                $ejecucion->decrement('monto_por_comprometer', $rows->montocompromiso);
                $ejecucion->decrement('monto_precomprometido', $rows->montocompromiso);

            }else{
                $aprobado = 0;
            }

        }




        if($aprobado == 1){
            return redirect()->route('compromisos.index')
            ->with('success', 'Compromiso Aprobado Exitosamente. ');
        }else{
            return redirect()->route('compromisos.index')
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

        return redirect()->route('ordenpagos.index')
            ->with('success', 'Orden de Pago Anulada exitosamente.');


    }
}
