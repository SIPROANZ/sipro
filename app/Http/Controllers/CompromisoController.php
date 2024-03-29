<?php

namespace App\Http\Controllers;

use App\Compromiso;
use App\Analisi;
use App\Requisicione;
use App\Precompromiso;
use App\Clasificadorpresupuestario;
use App\Detallescompromiso;
use App\Compra;
use App\Comprascp;
use App\Tipodecompromiso;
use App\Detallesanalisi;
use App\Ejecucione;
use App\Ayudassociale;
use App\Detallesayuda;
use App\Detallesprecompromiso;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use PDF;

/**
 * Class CompromisoController
 * @package App\Http\Controllers
 */
class CompromisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compromisos = Compromiso::where('status', 'EP')->paginate();

        return view('compromiso.index', compact('compromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $compromisos->perPage());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexcompras()
    {
       // $compras = Compra::paginate();
        $compras = Compra::where('status', 'PR')->paginate();

        $ayudassociales = Ayudassociale::where('status', 'PR')->paginate();

        $precompromisos = Precompromiso::where('status', 'PR')->paginate();

        return view('compromiso.compras', compact('compras', 'ayudassociales', 'precompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $compras->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $compromiso = new Compromiso();
        return view('compromiso.create', compact('compromiso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Compromiso::$rules);
        //Numero de compromisos
        $max_correlativo = DB::table('compromisos')->max('ncompromiso');
        $numero_correlativo = $max_correlativo + 1;
        $request->merge(['ncompromiso'=>$numero_correlativo]);


        $compromiso = Compromiso::create($request->all());
        //Obtener el ultimo ID
        $ultimo = Compromiso::latest('id')->first();
        $compromiso_id = $ultimo->id;

        //Agregar los clasificadores presupuestarios al compromiso
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
            $detallescompromiso = Detallescompromiso::create($detalles_compromisos);

        }

        return redirect()->route('compromisos.index')
            ->with('success', 'Compromiso created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $compromiso = Compromiso::find($id);
        $detallescompromisos = Detallescompromiso::where('compromiso_id', $id)->paginate();
        $concepto = '';

        $status=null;
        
        if($compromiso->status=='AP'){
            $status='APROBADO';
        }
        elseif($compromiso->status=='PR'){
            $status='PROCESADO';    
        }
        elseif($compromiso->status=='EP'){
            $status='EN PROCESO';    
        }
        elseif($compromiso->status=='AN'){
            $status='ANULADO';    
        }
        elseif($compromiso->status=='RV '){
            $status='RESERVADO';    
        }

        if($compromiso->precompromiso_id != NULL){

            $concepto = $compromiso->precompromiso->concepto;

        }
        elseif($compromiso->ayuda_id != NULL){

            $concepto = $compromiso->ayudassociale->concepto;
   
        }
        elseif($compromiso->compra_id != NULL){

            $compra_id = $compromiso->compra_id;
            $rs_compra = Compra::find($compra_id);
            $analisis_id = $rs_compra->analisis_id;
            $rs_analisis = Analisi::find($analisis_id);
            $requisicion_id = $rs_analisis->requisicion_id;
            $rs_requisicion = Requisicione::find($requisicion_id);
            $concepto = $rs_requisicion->concepto;   
        }

        //return view('compromiso.show', compact('compromiso'));
        return view('compromiso.show', compact('status', 'detallescompromisos', 'compromiso', 'concepto'))
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
        $compromiso = Compromiso::find($id);
        $compra = Compra::find($compromiso->compra_id);
       // $tipocompromisos = Tipodecompromiso::find($compromiso->tipocompromiso_id);
        $detallesanalisi = Detallesanalisi::find($compra->analisis_id);
        $proveedor = $detallesanalisi->proveedor_id;

        $tipocompromisos = Tipodecompromiso::pluck('nombre', 'id');

        return view('compromiso.edit', compact('compromiso', 'compra', 'tipocompromisos', 'proveedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Compromiso $compromiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compromiso $compromiso)
    {
        request()->validate(Compromiso::$rules);

        $compromiso->update($request->all());

        return redirect()->route('compromisos.index')
            ->with('success', 'Compromiso updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $compromiso = Compromiso::find($id)->delete();

        return redirect()->route('compromisos.index')
            ->with('success', 'Compromiso deleted successfully');
    }

       /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregarcompromiso($id)
    {
        $compra_id = $id;
        $compromiso = new Compromiso();

        //Cambiar el estatus de la compra para que no salga mas en el listado a comprometer
        $compra = Compra::find($compra_id);
        $compra->status = 'AP';
        $compra->save();

        $detallesanalisi = Detallesanalisi::find($compra->analisis_id);
        $proveedor = $detallesanalisi->proveedor_id;
        $proveedor = 1;

        $tipocompromisos = Tipodecompromiso::pluck('nombre', 'id');

        return view('compromiso.agregarcompromiso', compact('compra', 'compromiso', 'tipocompromisos', 'proveedor'));
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
        $compra->status = 'EP';
        $compra->save();

        return redirect()->route('compromisos.index')
            ->with('success', 'Compra Reversada exitosamente.');
    }

    /**
     * Crear pdf de la requisicion seleccionada
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
      
        $compromiso = Compromiso::find($id);
        $concepto = 'Es Null';

        $detallescompromisos = Detallescompromiso::where('compromiso_id','=',$id)->paginate();
        $totalcompromiso = $detallescompromisos->sum('montocompromiso');

        $datos = array();

        if($compromiso->precompromiso_id != NULL){

            $concepto = $compromiso->precompromiso->concepto;

        }
        elseif($compromiso->ayuda_id != NULL){

            $concepto = $compromiso->ayudassociale->concepto;

            
        }
        elseif($compromiso->compra_id != NULL){

            $compra_id = $compromiso->compra_id;
            $rs_compra = Compra::find($compra_id);
            $analisis_id = $rs_compra->analisis_id;
            $rs_analisis = Analisi::find($analisis_id);
            $requisicion_id = $rs_analisis->requisicion_id;
            $rs_requisicion = Requisicione::find($requisicion_id);
            $concepto = $rs_requisicion->concepto;   
        }
        foreach($detallescompromisos as $rows){
            //Obtener la denominacion a partir de la cuenta
            $ejecucion = Ejecucione::find($rows->ejecucion_id);
            $cuenta = Clasificadorpresupuestario::where('cuenta', $ejecucion->clasificadorpresupuestario)->first();
            $datos = Arr::add($datos, $rows->ejecucion_id, $cuenta->denominacion);

        }

        $status=null;
        
        if($compromiso->status=='AP'){
            $status='Aprobado';
        }
        elseif($compromiso->status=='PR'){
            $status='Procesado';    
        }
        elseif($compromiso->status=='EP'){
            $status='En proceso';    
        }
        elseif($compromiso->status=='AN'){
            $status='Anulado';    
        }
        elseif($compromiso->status=='RV '){
            $status='Reservado';    
        }


        $pdf = PDF::loadView('compromiso.pdf', ['compromiso'=>$compromiso, 'detallescompromisos'=>$detallescompromisos, 'datos'=>$datos, 'totalcompromiso'=>$totalcompromiso, 'concepto'=>$concepto, 'status'=> $status]);
        return $pdf->stream();
 
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
        //Obtener si es una compra, ayuda o precompromiso
        if($compromiso->precompromiso_id != NULL){

            $precompromiso = Precompromiso::find($compromiso->precompromiso_id);
            $precompromiso->status = 'AP';
            $precompromiso->save();

        }
        elseif($compromiso->ayuda_id != NULL){

            $ayuda = Ayudassociale::find($compromiso->ayuda_id);
            $ayuda->status = 'AP';
            $ayuda->save();
   
        }
        elseif($compromiso->compra_id != NULL){
            //Obtener la compra y tambien actualizar su estado
        $compra = Compra::find($compromiso->compra_id);
        $compra->status = 'AP';
        $compra->save();
              
        }


        

        //validar que alguno de los estatus tenga valor


        //Obtener el detalle ejecucion y corroborar que haya disponibilidad
        $detallescompromisos = Detallescompromiso::where('compromiso_id','=',$id)->get();
        //Ciclo para validar que todas las partidas tengan disponibilidad
        foreach($detallescompromisos as $rows){
            //Obtener la ejecucion
            $ejecucion = Ejecucione::find($rows->ejecucion_id);
            //Hacer el if
            if($rows->montocompromiso > $ejecucion->monto_por_comprometer){
                $aprobado = 0;
            }

            }

        if($aprobado == 1){
        //Ciclo para imputar
        foreach($detallescompromisos as $rows){
            //Obtener la ejecucion
                $ejecucion = Ejecucione::find($rows->ejecucion_id);
                $ejecucion->increment('monto_comprometido', $rows->montocompromiso);
                $ejecucion->decrement('monto_por_comprometer', $rows->montocompromiso);
                $ejecucion->decrement('monto_precomprometido', $rows->montocompromiso);
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
        $compromisos = Compromiso::where('status', 'PR')->paginate();

        return view('compromiso.procesados', compact('compromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $compromisos->perPage());
    }

    /**
     * Display requisiciones procesadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexaprobadas()
    {
        $compromisos = Compromiso::where('status', 'AP')->paginate();

        return view('compromiso.procesados', compact('compromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $compromisos->perPage());
    }

    /**
     * Display requisiciones anuladas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
        $compromisos = Compromiso::where('status', 'AN')->paginate();

        return view('compromiso.anulados', compact('compromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $compromisos->perPage());
    }

    /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function anular($id)
    {
        
        $compromiso = Compromiso::find($id);
        $fecha = Carbon::now();
        $compromiso->fechaanulacion = $fecha;
        $compromiso->status = 'AN';
        $compromiso->save();

        return redirect()->route('compromisos.index')
            ->with('success', 'Compromiso Anulado exitosamente.');


    }

    /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function modificar($id)
    {
        
        $compromiso = Compromiso::find($id);
        
        //Obtener el detalle ejecucion y corroborar que haya disponibilidad
        $detallescompromisos = Detallescompromiso::where('compromiso_id','=',$id)->get();

        //Ciclo Contrario al proceso de imputar
        foreach($detallescompromisos as $rows){
            //Obtener la ejecucion 
                $ejecucion = Ejecucione::find($rows->ejecucion_id);
                $ejecucion->decrement('monto_comprometido', $rows->montocompromiso);
                $ejecucion->increment('monto_por_comprometer', $rows->montocompromiso);
                $ejecucion->increment('monto_precomprometido', $rows->montocompromiso);
             }

        $compromiso->status = 'EP';
        $compromiso->save();

        return redirect()->route('compromisos.index')
            ->with('success', 'Compromiso Anulado exitosamente.');

            
    }

    //Agregar Ayuda
      /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregarayuda($id)
    {
        $ayuda_id = $id;
        $compromiso = new Compromiso();

        //Cambiar el estatus de la compra para que no salga mas en el listado a comprometer
        $ayuda = Ayudassociale::find($ayuda_id);
        $ayuda->status = 'AP';
        $ayuda->save();

        $beneficiario = $ayuda->beneficiario_id;

        $tipocompromisos = Tipodecompromiso::pluck('nombre', 'id');

        return view('compromiso.agregarayuda', compact('ayuda', 'compromiso', 'tipocompromisos', 'beneficiario'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeayuda(Request $request)
    {
        request()->validate(Compromiso::$rules);
        //Numero de compromisos
        $max_correlativo = DB::table('compromisos')->max('ncompromiso');
        $numero_correlativo = $max_correlativo + 1;
        $request->merge(['ncompromiso'=>$numero_correlativo]);


        $compromiso = Compromiso::create($request->all());
        //Obtener el ultimo ID
        $ultimo = Compromiso::latest('id')->first();
        $compromiso_id = $ultimo->id;

        //Agregar los clasificadores presupuestarios al compromiso
        $ayuda_id = $request->ayuda_id;
        //Obtener el detalle de las comprascps
        $detalles_ayudacp = Detallesayuda::where('ayuda_id', $ayuda_id)->get();

        foreach($detalles_ayudacp as $row){
            //crear el array datos para agregarlo al detalle compromiso
            $detalles_compromisos=[
                'montocompromiso'=> $row->montocompromiso,
                'compromiso_id'=> $compromiso_id,
                'unidadadministrativa_id'=> $row->unidadadministrativa_id,
                'ejecucion_id'=> $row->ejecucion_id,
            ];

            //agregar detalles del compromiso
            $detallescompromiso = Detallescompromiso::create($detalles_compromisos);

        }

        return redirect()->route('compromisos.index')
            ->with('success', 'Compromiso created successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeprecompromiso(Request $request)
    {
        request()->validate(Compromiso::$rules);
        //Numero de compromisos
        $max_correlativo = DB::table('compromisos')->max('ncompromiso');
        $numero_correlativo = $max_correlativo + 1;
        $request->merge(['ncompromiso'=>$numero_correlativo]);


        $compromiso = Compromiso::create($request->all());
        //Obtener el ultimo ID
        $ultimo = Compromiso::latest('id')->first();
        $compromiso_id = $ultimo->id;

        //Agregar los clasificadores presupuestarios al compromiso
        $precompromiso_id = $request->precompromiso_id;
        //Obtener el detalle de las comprascps
        $detalles_precompromisocp = Detallesprecompromiso::where('precompromiso_id', $precompromiso_id)->get();

        foreach($detalles_precompromisocp as $row){
            //crear el array datos para agregarlo al detalle compromiso
            $detalles_compromisos=[
                'montocompromiso'=> $row->montocompromiso,
                'compromiso_id'=> $compromiso_id,
                'unidadadministrativa_id'=> $row->unidadadministrativa_id,
                'ejecucion_id'=> $row->ejecucion_id,
            ];

            //agregar detalles del compromiso
            $detallescompromiso = Detallescompromiso::create($detalles_compromisos);

        }

        return redirect()->route('compromisos.index')
            ->with('success', 'Compromiso created successfully.');
    }

    //Agregar Ayuda
      /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregarprecompromiso($id)
    {
        $precompromiso_id = $id;
        $compromiso = new Compromiso();

        //Cambiar el estatus de la compra para que no salga mas en el listado a comprometer
        $precompromiso = Precompromiso::find($precompromiso_id);
        $precompromiso->status = 'AP';
        $precompromiso->save();

        $beneficiario = $precompromiso->beneficiario_id;

        $tipocompromisos = Tipodecompromiso::pluck('nombre', 'id');

        return view('compromiso.agregarprecompromiso', compact('precompromiso', 'compromiso', 'tipocompromisos', 'beneficiario'));
    }

}
