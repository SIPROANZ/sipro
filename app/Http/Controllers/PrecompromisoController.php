<?php

namespace App\Http\Controllers;

use App\Precompromiso;
use App\Unidadadministrativa;
use App\Tipodecompromiso;
use App\Beneficiario;
use App\detallesprecompromiso;
use App\Ejecucione;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

/**
 * Class PrecompromisoController
 * @package App\Http\Controllers
 */
class PrecompromisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $precompromisos = Precompromiso::where('status', 'EP')->paginate();

        return view('precompromiso.index', compact('precompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $precompromisos->perPage());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprocesadas()
    {
        $precompromisos = Precompromiso::where('status', 'PR')->paginate();

        return view('precompromiso.procesadas', compact('precompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $precompromisos->perPage());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
        $precompromisos = Precompromiso::where('status', 'AN')->paginate();

        return view('precompromiso.anuladas', compact('precompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $precompromisos->perPage());
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexaprobadas()
    {
        $precompromisos = Precompromiso::where('status', 'AP')->paginate();

        return view('precompromiso.aprobadas', compact('precompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $precompromisos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $precompromiso = new Precompromiso();
        $unidades = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $tipocompromisos = Tipodecompromiso::pluck('nombre','id');
        $beneficiarios = Beneficiario::pluck('nombre','id');


        return view('precompromiso.create', compact('precompromiso', 'unidades', 'tipocompromisos', 'beneficiarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Precompromiso::$rules);

        $precompromiso = Precompromiso::create($request->all());

        return redirect()->route('precompromisos.index')
            ->with('success', 'Precompromiso created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $precompromiso = Precompromiso::find($id);
        $unidades = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $tipocompromisos = Tipodecompromiso::pluck('nombre','id');
        $beneficiarios = Beneficiario::pluck('nombre','id');

        return view('precompromiso.show', compact('precompromiso', 'unidades', 'tipocompromisos', 'beneficiarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $precompromiso = Precompromiso::find($id);
        $unidades = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $tipocompromisos = Tipodecompromiso::pluck('nombre','id');
        $beneficiarios = Beneficiario::pluck('nombre','id');

        return view('precompromiso.edit', compact('precompromiso', 'unidades', 'tipocompromisos', 'beneficiarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Precompromiso $precompromiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Precompromiso $precompromiso)
    {
        request()->validate(Precompromiso::$rules);

        $precompromiso->update($request->all());

        return redirect()->route('precompromisos.index')
            ->with('success', 'Precompromiso updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $precompromiso = Precompromiso::find($id)->delete();

        return redirect()->route('precompromisos.index')
            ->with('success', 'Precompromiso deleted successfully');
    }

    /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregar($id)
    {
        $precompromiso = Precompromiso::find($id);

        //Creare una variable de sesion para guardar el id de esta requisicion
        session(['precompromisos' => $id]);

        $detallesprecompromisos = Detallesprecompromiso::where('precompromiso_id', $id)->paginate();

        return view('precompromiso.agregar', compact('detallesprecompromisos', 'precompromiso'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesprecompromisos->perPage());
    }

     /**
     * Crear pdf de la requisicion seleccionada
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        $precompromiso = Precompromiso::find($id);


        $detallesprecompromisos = Detallesprecompromiso::where('precompromiso_id', $id)->paginate();

        $totalcompromiso = $detallesprecompromisos ->sum('montocompromiso');

        
        $status=null;
        
        if($precompromiso->status=='AP'){
            $status='Aprobado';
        }
        elseif($precompromiso->status=='PR'){
            $status='Procesado';    
        }
        elseif($precompromiso->status=='EP'){
            $status='En proceso';    
        }
        elseif($precompromiso->status=='AN'){
            $status='Anulado';    
        }
        elseif($precompromiso->status=='RV '){
            $status='Reservado';    
        }


        $pdf = PDF::loadView('precompromiso.pdf', ['precompromiso'=>$precompromiso, 'detallesprecompromisos'=>$detallesprecompromisos, 'status'=> $status, 'totalcompromiso'=>$totalcompromiso]);
        return $pdf->stream();

    }


     /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function anular($id)
    {
        $precompromiso = Precompromiso::find($id);
        $fecha = Carbon::now();
        $precompromiso->fechaanulacion = $fecha;
        $precompromiso->status = 'AN';
        $precompromiso->save();

        return redirect()->route('precompromisos.index')
            ->with('success', 'Precompromiso Anulado exitosamente.');
     
    }

    /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function modificar($id)
    {
        $precompromiso = Precompromiso::find($id);
       
        $detallesprecompromisos = Detallesprecompromiso::where('precompromiso_id', $id)->get();

        foreach($detallesprecompromisos as $rows){
            $monto =  $rows->montocompromiso;
            $ejecucion_id = $rows->ejecucion_id;
            //Obtenemos el monto en la ejecucion 
            $ejecucion = Ejecucione::find($ejecucion_id);
            $ejecucion->decrement('monto_precomprometido', $monto);

        }

        $precompromiso->status = 'EP';
        $precompromiso->save();

        return redirect()->route('precompromisos.index')
            ->with('success', 'Precompromiso Anulado exitosamente.');
     
    }

     /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada la requisicion
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function aprobar($id)
    {
        $aprobado = 1;
        $procesar = 0; 
        $precompromiso = Precompromiso::find($id);
        $precompromiso->status = 'PR';
        $precompromiso->save();

        $cadena_error ='';
        

        //Obtener el detalle ejecucion y corroborar que haya disponibilidad
        //$detallesayudas = Detallesayuda::where('ayuda_id','=',$id)->get();
        $detallesprecompromisos = Detallesprecompromiso::where('precompromiso_id', $id)->get();
        //Ciclo para validar que todas las partidas tengan disponibilidad
        foreach($detallesprecompromisos as $rows){
            $monto =  $rows->montocompromiso;
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
                $precompromiso->status = 'EP';
                $precompromiso->save();
                $cadena_error .= ' monto a precomprometer: ' . $monto . ' Disponible: ' . $disponible_ejecucion . ' Clasificador: ' . $ejecucion->clasificadorpresupuestario;
            }
            //$cad_resulltados .= ' monto: ' . $monto . ' ejecucion: ' . $ejecucion_id . ' Disponible: ' . $disponible_ejecucion; 
        }

        //Si la bandera procesar aun permanece en 0 quiere decir que si hay disponibilidad y procedo
        //a precomprometer de la ejecucion los montos pasados
        if($procesar == 0){
            foreach($detallesprecompromisos as $rows){
                $monto =  $rows->montocompromiso;
                $ejecucion_id = $rows->ejecucion_id;
                //Obtenemos el monto en la ejecucion 
                $ejecucion = Ejecucione::find($ejecucion_id);
                $ejecucion->increment('monto_precomprometido', $monto);
 
            }
        }
        
        if($aprobado == 1){
            return redirect()->route('precompromisos.index')
            ->with('success', 'Precompromiso Aprobado Exitosamente.');
        }else{
            return redirect()->route('precompromisos.index')
            ->with('success', 'No Aprobado. No hay Disponibilidad o ha ocurrido un error en el registro. ' . $cadena_error);
        }

    }



}
