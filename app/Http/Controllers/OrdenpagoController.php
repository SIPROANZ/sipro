<?php

namespace App\Http\Controllers;

use App\Compromiso;
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


        $nordenpago = Ordenpago::create($request->all());
        //Obtener el ultimo ID
        $ultimo = Ordenpago::latest('id')->first();
        $nordenpago_id = $ultimo->id;

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

        return view('ordenpago.show', compact('ordenpago'));
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

        return view('ordenpago.edit', compact('ordenpago'));
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

    public function agregarordenpago($id)
    {
        $compromiso_id = $id;
        $ordenpago = new Ordenpago();
        //Cambiar el estatus de la compromiso para que no salga mas en el listado a comprometer
        $compromiso = Compromiso::find($compromiso_id);
        $compromiso->status = 'AP';
        $compromiso->save();

/*         $detallesanalisi = Detallesanalisi::find($compromiso->analisis_id);
        $proveedor = $detallesanalisi->proveedor_id; */
        $proveedor = $compromiso->beneficiario->nombre;
        //$proveedor = 1;

        //$tipocompromisos = Tipodecompromiso::pluck('nombre', 'id');

        return view('ordenpago.agregarordenpago', compact('compromiso', 'ordenpago', 'proveedor'));
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
            ->with('success', 'Orden de Pago Anulado exitosamente.');


    }
}
