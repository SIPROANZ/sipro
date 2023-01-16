<?php

namespace App\Http\Controllers;

use App\Compra;
use App\Analisi;
use App\Detallesanalisi;
use App\Beneficiario;
use App\Comprascp;
use App\Requisicione;
use App\Requidetclaspre;
use App\Ejecucione;
use App\Clasificadorpresupuestario;
use App\Unidadadministrativa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

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

        $max_correlativo = DB::table('compras')->max('numordencompra');
        $numero_correlativo = $max_correlativo + 1;

       // $request->correlativo = $numero_correlativo //18; 
        $request->merge(['numordencompra'  => $numero_correlativo]);

        $compra = Compra::create($request->all());

        //Obtener el ultimo ID
        $ultimo = Compra::latest('id')->first();
        $compra_id = $ultimo->id;

        $comprars = Compra::find($compra_id);

        //Una vez que agregue la compra agrego tambien sus diferentes clasificadores presupuestarios
        $aprobado = 1;
        $procesar = 0;

        //Obtener el Id del analisis
        $analisis_id = $comprars->analisis_id;

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
                'compra_id' => $compra_id,
                'unidadadministrativa_id' => $unidadadministrativa_id,
                'ejecucion_id' => $ejecucion_id,
                'monto' => $subtotal,
                'disponible' => $monto_por_comprometer
            ];
            
            $agregar_cps = Comprascp::create($datos_comprascps);
        
            //Luego colocar nuevamente el sub total a cero
             $subtotal = 0;
       
        }
        // REGISTRAR LA PARTIDA DE IVA DE ESTA UNIDAD ADMINISTRATIVA
        $datos_iva = $datos_comprascps = [
            'compra_id' => $compra_id,
            'unidadadministrativa_id' => $unidadadministrativa_id,
            'ejecucion_id' => $ejecucion_iva,
            'monto' => $iva,
            'disponible' => $por_comprometer_iva
        ];
        $agregar_cps = Comprascp::create($datos_iva);

        
        //Fin de agregar sus clasificadores presupuestarios

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
        session(['mostrarcompra' => $id]);

        $compra = Compra::find($id);

        $comprascps = Comprascp::where('compra_id', $id)->paginate();

        //Obtener el numero de la requisicion
        $analisis = Analisi::find($compra->analisis_id);
        $requisicion_id = $analisis->requisicion_id;
        $unidadadministrativa_id = $analisis->unidadadministrativa_id;
        $requisicion = Requisicione::find($requisicion_id);
        $correlativo = $requisicion->correlativo;
        $uso = $requisicion->uso;
        $undadm = Unidadadministrativa::find($unidadadministrativa_id);
        $departamento = $undadm->unidadejecutora;
        $sub_sector = $undadm->denominacion;
        $sector_actual = $undadm->sector;

        //Para obtener el sector
        $nuevo_sector = Unidadadministrativa::where('sector', $sector_actual )->where('programa', '00')->first();
        $sector = $nuevo_sector->unidadejecutora;

        //PARA OBTENER EL ID DEL PROVEEDOR
        $proveedor = Detallesanalisi::where('analisis_id', $analisis->id)->where('aprobado', 'SI')->first();
        $proveedor_id = $proveedor->beneficiario_id;
        //Ahora busco la razon social y el rif
        $beneficiario = Beneficiario::find($proveedor_id);
        $rif =$beneficiario->caracterbeneficiario . '-' . $beneficiario->rif;
        $razon_social = $beneficiario->nombre;

        //Para ver los detalles de la compra
        //Consulto los datos especificos para la requisicion seleccionada
        $detallesanalisis = Detallesanalisi::where('analisis_id',$analisis->id)->paginate();


       // return view('compra.show', compact('compra'));

        return view('compra.show', compact('compra', 'detallesanalisis', 'comprascps', 'correlativo', 'departamento', 'uso', 'sub_sector', 'sector', 'rif', 'razon_social'))
            ->with('i', (request()->input('page', 1) - 1) * $comprascps->perPage());

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

        $analisis_id = $compra->analisis_id;
        $total_base = 0;
        $total_iva = 0;
        $total = 0;

        //Cambiar el estatus del analisis para que no salga mas en el listado de las compras a realizar
        
       
        $detalles_analisis = Detallesanalisi::where('analisis_id', $analisis_id)->get();

        foreach($detalles_analisis as $row){
            $total_base += $row->subtotal;
            $total_iva += $row->iva;
        }
        
        $total = $total_base + $total_iva;

        return view('compra.edit', compact('compra', 'analisis_id', 'total_base', 'total_iva', 'total'));
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

        $compra_numero = $compra->numordencompra;
        //Hacer el merge para que se guarde el numero de orden de compra y no lo borre a cero
        $request->merge(['numordencompra'  => $compra_numero]);

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
        $estado = 'AP';  //UNA VEZ LISTO EL CODIGO COLOCARLO EN AP
        $analisi = Analisi::find($analisis_id);
        
       
        $detalles_analisis = Detallesanalisi::where('analisis_id', $analisis_id)->get();

        foreach($detalles_analisis as $row){
            $total_base += $row->subtotal;
            $total_iva += $row->iva;
        }

        $analisi->estatus = 'AP';//UNA VEZ LISTO COLOCARLO EN AP
        $analisi->save();
        
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
        $compra->status = 'PR'; //colocar al finalizar las pruebas en PR
        $compra->save();

        $aprobado = 1;
        $procesar = 0;

        $cad_resulltados ='';

        //Obtener todos los valores que vienen de la tabla compracps y los verifico con su ejecucio
        //para saber si hay disponibilidad
        $comprascps = Comprascp::where('compra_id', $id)->get();
       //  $comprascpsprecomprometer = Comprascp::where('compra_id', $id);
        //Primero verifico que todas las partidas tengan disponibilidad, si es seguro, entonces precomprometo
        foreach($comprascps as $rows){
            $monto =  $rows->monto;
            $ejecucion_id = $rows->ejecucion_id;
            //Obtenemos el monto en la ejecucion 
            $ejecucion = Ejecucione::find($ejecucion_id);
            $monto_por_comprometer = $ejecucion->monto_por_comprometer;
            $monto_precomprometido = $ejecucion->monto_precomprometido;
            $disponible_ejecucion = $monto_por_comprometer - $monto_precomprometido;
            //Valido que tenga disponibilidad
            if($monto > $disponible_ejecucion)
            {
                $procesar = 1; //Hubo falta de disponibilidad en alguna ejecucion
                $aprobado = 0;
                $compra->status = 'EP';
                $compra->save();
            }
            $cad_resulltados .= ' monto: ' . $monto . ' ejecucion: ' . $ejecucion_id . ' Disponible: ' . $disponible_ejecucion; 
        }

        //Si la bandera procesar aun permanece en 0 quiere decir que si hay disponibilidad y procedo
        //a precomprometer de la ejecucion los montos pasados
        if($procesar == 0){
            foreach($comprascps as $rows){
                $monto =  $rows->monto;
                $ejecucion_id = $rows->ejecucion_id;
                //Obtenemos el monto en la ejecucion 
                $ejecucion = Ejecucione::find($ejecucion_id);
                $ejecucion->increment('monto_precomprometido', $monto);

              //  $cad_resulltados .= ' monto: ' . $monto . ' ejecucion: ' . $ejecucion_id; 
            }
        }
      



        if($aprobado == 1){
            return redirect()->route('compras.index')
            ->with('success', 'Compra Aprobada Exitosamente. Resultados: ' . $cad_resulltados);
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
     * Display requisiciones procesadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexaprobadas()
    {
        $compras = Compra::where('status', 'AP')->paginate();

        return view('compra.aprobadas', compact('compras'))
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
        $fecha = Carbon::now();
        $compra->fechaanulacion = $fecha;
        $compra->status = 'AN';
        $compra->save();

        return redirect()->route('compras.index')
            ->with('success', 'Compra Anulada exitosamente.');

            
    }

    

    /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function modificar($id)
    {
        $compra = Compra::find($id);
       
        //Disminuir la ejecucion
        $comprascps = Comprascp::where('compra_id', $id)->get();
        foreach($comprascps as $rows){
            $monto =  $rows->monto;
            $ejecucion_id = $rows->ejecucion_id;
            //Obtenemos el monto en la ejecucion 
            $ejecucion = Ejecucione::find($ejecucion_id);
            $ejecucion->decrement('monto_precomprometido', $monto);

          //  $cad_resulltados .= ' monto: ' . $monto . ' ejecucion: ' . $ejecucion_id; 
        }


        $compra->status = 'EP';
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

     /**
     * Crear pdf de la requisicion seleccionada
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        
        $compra = Compra::find($id);

        $comprascps = Comprascp::where('compra_id','=',$id)->paginate();

        //Obtener el numero de la requisicion
        $analisis = Analisi::find($compra->analisis_id);
        $requisicion_id = $analisis->requisicion_id;
        $unidadadministrativa_id = $analisis->unidadadministrativa_id;
        $requisicion = Requisicione::find($requisicion_id);
        $correlativo = $requisicion->correlativo;
        $uso = $requisicion->uso;
        $undadm = Unidadadministrativa::find($unidadadministrativa_id);
        $departamento = $undadm->unidadejecutora;
        $sub_sector = $undadm->denominacion;
        $sector_actual = $undadm->sector;

        //Para obtener el sector
        $nuevo_sector = Unidadadministrativa::where('sector', $sector_actual )->where('programa', '00')->first();
        $sector = $nuevo_sector->unidadejecutora;

        //PARA OBTENER EL ID DEL PROVEEDOR
        $proveedor = Detallesanalisi::where('analisis_id', $analisis->id)->where('aprobado', 'SI')->first();
        $proveedor_id = $proveedor->beneficiario_id;
        //Ahora busco la razon social y el rif
        $beneficiario = Beneficiario::find($proveedor_id);
        $rif =$beneficiario->caracterbeneficiario . '-' . $beneficiario->rif;
        $razon_social = $beneficiario->nombre;

        //Para ver los detalles de la compra
        //Consulto los datos especificos para la requisicion seleccionada
        $detallesanalisis = Detallesanalisi::where('analisis_id',$analisis->id)->paginate();
      

        $pdf = PDF::loadView('compra.pdf', ['compra'=>$compra, 'detallesanalisis'=>$detallesanalisis , 'comprascps'=>$comprascps, 'correlativo'=>$correlativo, 'departamento'=>$departamento, 'uso'=>$uso, 'sub_sector'=>$sub_sector, 'sector'=>$sector, 'rif'=>$rif, 'razon_social'=>$razon_social]);
        return $pdf->stream();

    }

    /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function actualizar($id)
    {
        $compra = Compra::find($id);

        $compra_id = $id;

        //Obtener los datos del detalle de analisis para actualizar la compra
        $analisis_id = $compra->analisis_id;
        $total_base = 0;
        $total_iva = 0;
        $total = 0;

        //Cambiar el estatus del analisis para que no salga mas en el listado de las compras a realizar
        $analisi = Analisi::find($analisis_id);
        
        $detalles_analisis = Detallesanalisi::where('analisis_id', $analisis_id)->get();

        foreach($detalles_analisis as $row){
            $total_base += $row->subtotal;
            $total_iva += $row->iva;
        }

        $analisi->estatus = 'AP';//UNA VEZ LISTO COLOCARLO EN AP
        $analisi->save();
        
        $total = $total_base + $total_iva;

        //FIN
        $datos_compra = [
            'id'=>$id,
            'analisis_id'=>$analisis_id,
            'numordencompra'=>$compra->numordencompra,
            'status'=>$compra->status,
            'fechaanulacion'=>$compra->fechaanulacion,
            'montobase'=>$total_base,
            'montoiva'=>$total_iva,
            'montototal'=>$total
        ];

        $compra->update($datos_compra);

        //Eliminar los datos del clasificador comprascp
        $comprascp = Comprascp::where('compra_id', $id)->delete();
        //Fin Eliminar

        //Agregar nuevamnete los datos
        //Una vez que agregue la compra agrego tambien sus diferentes clasificadores presupuestarios
        $aprobado = 1;
        $procesar = 0;

        //Obtener el Id del analisis
        //$analisis_id = $comprars->analisis_id;

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
                'compra_id' => $compra_id,
                'unidadadministrativa_id' => $unidadadministrativa_id,
                'ejecucion_id' => $ejecucion_id,
                'monto' => $subtotal,
                'disponible' => $monto_por_comprometer
            ];
            
            $agregar_cps = Comprascp::create($datos_comprascps);
        
            //Luego colocar nuevamente el sub total a cero
             $subtotal = 0;
       
        }
        // REGISTRAR LA PARTIDA DE IVA DE ESTA UNIDAD ADMINISTRATIVA
        $datos_iva = $datos_comprascps = [
            'compra_id' => $compra_id,
            'unidadadministrativa_id' => $unidadadministrativa_id,
            'ejecucion_id' => $ejecucion_iva,
            'monto' => $iva,
            'disponible' => $por_comprometer_iva
        ];
        $agregar_cps = Comprascp::create($datos_iva);

        

        //Fin de Agregar nuevo ComprasCP

        
        

        return redirect()->route('compras.index')
            ->with('success', 'Compra Actualizada exitosamente.');

            
    }
}
