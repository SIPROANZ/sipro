<?php

namespace App\Http\Controllers;

use App\Compra;
use App\Analisi;
use App\Detallesanalisi;
use App\Comprascp;
use App\Requisicione;
use App\Requidetclaspre;
use App\Ejecucione;
use App\Clasificadorpresupuestario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class CompraController
 * @package App\Http\Controllers
 */
class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compras = Compra::where('status', 'EP')->paginate();
        
        return view('compra.index', compact('compras'))
            ->with('i', (request()->input('page', 1) - 1) * $compras->perPage());
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanalisis()
    {
       // $compras = Compra::paginate();
        $analisis = Analisi::where('estatus', 'PR')->paginate();

        return view('compra.analisis', compact('analisis'))
            ->with('i', (request()->input('page', 1) - 1) * $analisis->perPage());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $compra = new Compra();
        return view('compra.create', compact('compra'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Compra::$rules);

        $compra = Compra::create($request->all());

        return redirect()->route('compras.index')
            ->with('success', 'Compra created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $compra = Compra::find($id);

        return view('compra.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $compra = Compra::find($id);

        return view('compra.edit', compact('compra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Compra $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        request()->validate(Compra::$rules);

        $compra->update($request->all());

        return redirect()->route('compras.index')
            ->with('success', 'Compra updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $compra = Compra::find($id)->delete();

        return redirect()->route('compras.index')
            ->with('success', 'Compra deleted successfully');
    }

    /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregarcompra($id)
    {
        $analisis_id = $id;
        $compra = new Compra();
        $total_base = 0;
        $total_iva = 0;
        $total = 0;

        //Cambiar el estatus del analisis para que no salga mas en el listado de las compras a realizar
        $estado = 'AP';
        $analisi = Analisi::find($analisis_id);
        $analisi->estatus = 'AP';
        $analisi->save();
       
        $detalles_analisis = Detallesanalisi::where('analisis_id', $analisis_id)->get();

        foreach($detalles_analisis as $row){
            $total_base += $row->subtotal;
            $total_iva += $row->iva;
        }
        
        $total = $total_base + $total_iva;

        return view('compra.agregarcompra', compact('compra', 'analisis_id', 'total_base', 'total_iva', 'total'));
    }

    //Metodo para aprobar un analisis de cotizacion
    /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada la requisicion
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function aprobar($id)
    {
        $compra = Compra::find($id);
        $compra->status = 'PR';
        $compra->save();

        $aprobado = 1;
        $procesar = 0;

        //Obtener el Id del analisis
        $analisis_id = $compra->analisis_id;

        


        //Obtener todos los productos relaciones al analisis_id en la tabla detalleanalisis
        $detalles_analisis = Detallesanalisi::where('analisis_id', $analisis_id)->get();
        //cad_analisis para mostrar todos los productos relacionados con el analisis id
        $iva = 0;
        $cad_analisis ='';
        
        foreach($detalles_analisis as $rows){
            $cad_analisis .= ' BOS_ID: ' . $rows->bos_id .' SUBTOTAL: '. $rows->subtotal;
            $iva += $rows->iva;
        }

        //Obtener Requisicion_id y con este valor vamos a obtener el clasificador presupuestario
        //que viene desde la requisicion
        $analisis = Analisi::find($analisis_id);
        $requisicion_id = $analisis->requisicion_id;
        $unidadadministrativa_id = $analisis->unidadadministrativa_id;

        //Obtener ejecucion para el iva
        $cuenta_iva ='4.03.18.01.00';
        $cuenta_ejecucion = Ejecucione::where('clasificadorpresupuestario', $cuenta_iva)->where('unidadadministrativa_id', $unidadadministrativa_id)->first();
        $ejecucion_iva = $cuenta_ejecucion->id;
        $por_comprometer_iva = $cuenta_ejecucion->monto_por_comprometer;

        //Obtener todos los clasificadores presupuestarios que vienen desde la tabla requidetclaspres
        $detalles_req_cp = Requidetclaspre::where('requisicion_id', $requisicion_id)->get();
        $cad_det_clas_pres = '';
        $cad_disp_ejec = '';
        $cad_id_clas_pres ='';
        $cad_subtotales = '';
        $subtotal = 0;

        foreach($detalles_req_cp as $rows){
            //Obtener el ID del clasificador presupuestario
            $cad_det_clas_pres .= ' Cuenta: ' . $rows->claspres;
            $clasificadorpresupuestario = Clasificadorpresupuestario::where('cuenta',$rows->claspres)->first();
            $cad_id_clas_pres .=' ID Clasificador: ' . $clasificadorpresupuestario->id;
            //Obtener Ejecucion para saber el monto disponible
            $ejecucione = Ejecucione::find($rows->ejecucion_id);
            $cad_disp_ejec .= ' Ejecucion: ' . $rows->ejecucion_id . ' Disponible: ' . $ejecucione->monto_por_comprometer;
            $monto_por_comprometer = $ejecucione->monto_por_comprometer;
            $ejecucion_id = $rows->ejecucion_id;
            //inicio
            $detallescomprascps = DB::table('detallesanalisis')
            ->where('analisis_id', $analisis_id)
            ->join('bos', 'bos.id', '=', 'detallesanalisis.bos_id') 
            ->join('productoscps', 'productoscps.producto_id', '=', 'bos.producto_id')
            ->where('productoscps.clasificadorp_id', $clasificadorpresupuestario->id)
            ->select('detallesanalisis.subtotal')
            ->get(); 

            foreach($detallescomprascps as $rows)
            {
                $subtotal += $rows->subtotal;
            }
            //fin
            //Crear del detalle comprascps
            $datos_comprascps = [
                'compra_id' => $id,
                'unidadadministrativa_id' => $unidadadministrativa_id,
                'ejecucion_id' => $ejecucion_id,
                'monto' => $subtotal,
                'disponible' => $monto_por_comprometer
            ];
            
           
        
            //Hay que hacer validaciones, si se puede precomprometer si tiene monto o no
            if($subtotal < $monto_por_comprometer){
                $agregar_cps = Comprascp::create($datos_comprascps);
                //Precomprometer el monto en la ejecucion
                $ejecucione->increment('monto_precomprometido', $subtotal);
            } else {
                $procesar = 1;
            }

            //Luego colocar nuevamente el sub total a cero
             $subtotal = 0;
       
        }

        //Hay que hacer validaciones, si se puede precomprometer si tiene monto o no
        if($iva < $por_comprometer_iva){
            $datos_iva = $datos_comprascps = [
                'compra_id' => $id,
                'unidadadministrativa_id' => $unidadadministrativa_id,
                'ejecucion_id' => $ejecucion_iva,
                'monto' => $iva,
                'disponible' => $por_comprometer_iva
            ];
            $agregar_cps = Comprascp::create($datos_iva);
            //Precomprometer el monto en la ejecucion
            $ejecucione->increment('monto_precomprometido', $subtotal);
        } else {
            $procesar = 1;
        }

        //Obtener Ejecucion para saber el monto disponible
        //Crear detalles comprascps IVA para esta compra
      

        if($procesar == 1) {
            $eliminar = Comprascp::where('compras_id', $id)->delete();
            $aprobado = 0;

        }



        if($aprobado == 1){
            return redirect()->route('compras.index')
            ->with('success', 'Compra Aprobada Exitosamente. Analisis_id: ' . $analisis_id . ' Detalles Analisis: ' . $cad_analisis . ' REQUISICION ID: ' . $requisicion_id . ' Clasificador Presupuestario: ' . $cad_det_clas_pres . ' *** ID Clasificador: '. $cad_id_clas_pres. ' **** ' . $cad_disp_ejec . ' *** SUBTOTAL: ' . $subtotal . ' *** IVA: ' . $iva . ' Unidad Administrativa: ' . $unidadadministrativa_id);
        }else{
            return redirect()->route('compras.index')
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
        $compras = Compra::where('status', 'PR')->paginate();

        return view('compra.procesadas', compact('compras'))
            ->with('i', (request()->input('page', 1) - 1) * $compras->perPage());
    }

    /**
     * Display requisiciones anuladas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
        $compras = Compra::where('status', 'AN')->paginate();

        return view('compra.anuladas', compact('compras'))
            ->with('i', (request()->input('page', 1) - 1) * $compras->perPage());
    }

    /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function anular($id)
    {
        $compra = Compra::find($id);
        $compra->status = 'AN';
        $compra->save();

        return redirect()->route('compras.index')
            ->with('success', 'Compra Anulada exitosamente.');

            
    }

    //Metodo para aprobar un analisis de cotizacion
    /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada la requisicion
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function reversar($id)
    {
        $analisi = Analisi::find($id);
        $analisi->estatus = 'EP';
        $analisi->save();

        return redirect()->route('compras.index')
            ->with('success', 'Analisis de Cotizacion Reversada exitosamente.');
    }
}
