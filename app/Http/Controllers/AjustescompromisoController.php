<?php

namespace App\Http\Controllers;

use App\Ajustescompromiso;
use App\Compromiso;
use App\Detallescompromiso;
use App\Detallesajuste;
use App\Ejecucione;
use Illuminate\Http\Request;

/**
 * Class AjustescompromisoController
 * @package App\Http\Controllers
 */
class AjustescompromisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ajustescompromisos = Ajustescompromiso::where('status', 'EP')->paginate();
        

        return view('ajustescompromiso.index', compact('ajustescompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $ajustescompromisos->perPage());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprocesadas()
    {
        $ajustescompromisos = Ajustescompromiso::where('status', 'PR')->paginate();
        

        return view('ajustescompromiso.procesadas', compact('ajustescompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $ajustescompromisos->perPage());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
        $ajustescompromisos = Ajustescompromiso::where('status', 'AN')->paginate();
        

        return view('ajustescompromiso.anuladas', compact('ajustescompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $ajustescompromisos->perPage());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agregar()
    {
        $compromisos = Compromiso::where('status', 'PR')->paginate();

        return view('ajustescompromiso.agregar', compact('compromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $compromisos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ajustescompromiso = new Ajustescompromiso();
        return view('ajustescompromiso.create', compact('ajustescompromiso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ajustescompromiso::$rules);

        $ajustescompromiso = Ajustescompromiso::create($request->all());
        //Obtener el ultimo ID
        $ultimo = Ajustescompromiso::latest('id')->first();
        $ajuste_id = $ultimo->id;

        $compromiso_id = $request->compromiso_id;
        //Obtener el detalle compromiso
        $detalles_compromisos = Detallescompromiso::where('compromiso_id', $compromiso_id)->get();

        foreach($detalles_compromisos as $rows){
            
            $insertar_datos = [
                'montoajuste'=>0,
                'ajustes_id'=>$ajuste_id,
                'unidadadministrativa_id'=>$rows->unidadadministrativa_id,
                'ejecucion_id'=> $rows->ejecucion_id

            ];

            $detallesajustes = Detallesajuste::create($insertar_datos);

        }




        return redirect()->route('ajustescompromisos.index')
            ->with('success', 'Ajustescompromiso created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ajustescompromiso = Ajustescompromiso::find($id);

        //return view('ajustescompromiso.show', compact('ajustescompromiso'));

        $detallesajustes = Detallesajuste::where('ajustes_id', $id)->paginate();

        //Creo mi variable de sesion para guardar el id del ajuste del compromiso
        session(['ajustecompromiso' => $id]);

        return view('ajustescompromiso.show', compact('detallesajustes', 'ajustescompromiso'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesajustes->perPage());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ajustescompromiso = Ajustescompromiso::find($id);

        $compromiso = Compromiso::find($ajustescompromiso->compromiso_id);

        return view('ajustescompromiso.edit', compact('ajustescompromiso', 'compromiso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ajustescompromiso $ajustescompromiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ajustescompromiso $ajustescompromiso)
    {
        request()->validate(Ajustescompromiso::$rules);

        $ajustescompromiso->update($request->all());

        return redirect()->route('ajustescompromisos.index')
            ->with('success', 'Ajustescompromiso updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ajustescompromiso = Ajustescompromiso::find($id)->delete();

        return redirect()->route('ajustescompromisos.index')
            ->with('success', 'Ajustescompromiso deleted successfully');
    }


      /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregarcompromiso($id)
    {
        $compromiso_id = $id;
        $compromiso = Compromiso::find($compromiso_id);
        
        $ajustescompromiso = new Ajustescompromiso();
        return view('ajustescompromiso.create', compact('ajustescompromiso' , 'compromiso'));
       
        
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
        //Variable para guardar el monto total del ajuste
        $totalajustar = 0;

        //Obtener los datos de la tabla ajustescompromisos
        $ajustescompromiso = Ajustescompromiso::find($id);

        //Obtener los datos del ajuste del compromiso
        $detallesajustes = Detallesajuste::where('ajustes_id', $ajustescompromiso->id)->get();

        //Consultar que tipo de ajuste es, si es 1 q es aumento, consultar primero disponibilidad
        //Si es 2 que es disminucion proceder a hacer el ajuste.
        if($ajustescompromiso->tipo==1){
            //Chequeo si hay disponibilidad en las partidas
            foreach($detallesajustes as $rows){
                //Obtener la ejecucion 
                $ejecucion = Ejecucione::find($rows->ejecucion_id);
                //Hacer el if
                    if($rows->montoajuste > $ejecucion->monto_por_comprometer){
                     $aprobado = 0;
                    }
                }

                //Una vez chequeado la disponibilidad se procede a modificar la ejecucion
                if($aprobado == 1){
                    $compromiso = Compromiso::find($ajustescompromiso->compromiso_id);
                    //Ciclo para imputar
                    foreach($detallesajustes as $rows){
                        //Obtener la ejecucion 
                            $ejecucion = Ejecucione::find($rows->ejecucion_id);
                            $ejecucion->increment('monto_comprometido', $rows->montoajuste);
                            $ejecucion->decrement('monto_por_comprometer', $rows->montoajuste);
                            $ejecucion->decrement('monto_precomprometido', $rows->montoajuste);

                            //Obtener el detalle compromiso para incrementarle el valor que viene obteniendo
                            $detallescompromisos = Detallescompromiso::where('compromiso_id',$compromiso->id)->where('ejecucion_id',$rows->ejecucion_id)->first();
                            $detallescompromisos->increment('montocompromiso', $rows->montoajuste);
                         }
                         $totalajustar = $detallesajustes->sum('montoajuste');
                         //Sumarle el valor al monto del compromiso primero obtener el compromiso
                         
                         $compromiso->increment('montocompromiso', $totalajustar);

                         //y actualizar el  valor de la tabla ajuste compromiso
                         $ajustescompromiso->montoajuste =  $totalajustar;
                         $ajustescompromiso->status =  'PR';
                         $ajustescompromiso->save();


                         
                     }


        }else{

            $compromiso = Compromiso::find($ajustescompromiso->compromiso_id);
            //Ciclo para imputar
            foreach($detallesajustes as $rows){
                //Obtener la ejecucion 
                    $ejecucion = Ejecucione::find($rows->ejecucion_id);
                    $ejecucion->decrement('monto_comprometido', $rows->montoajuste);
                    $ejecucion->increment('monto_por_comprometer', $rows->montoajuste);
                    $ejecucion->increment('monto_precomprometido', $rows->montoajuste);

                    //Obtener el detalle compromiso para incrementarle el valor que viene obteniendo
                    $detallescompromisos = Detallescompromiso::where('compromiso_id',$compromiso->id)->where('ejecucion_id',$rows->ejecucion_id)->first();
                    $detallescompromisos->decrement('montocompromiso', $rows->montoajuste);
                 }
                 $totalajustar = $detallesajustes->sum('montoajuste');
                 //restarle el valor al monto del compromiso primero obtener el compromiso
                 
                 $compromiso->decrement('montocompromiso', $totalajustar);

                 //y actualizar el  valor de la tabla ajuste compromiso
                 $ajustescompromiso->montoajuste =  $totalajustar;
                 $ajustescompromiso->status =  'PR';
                 $ajustescompromiso->save();

        }





        if($aprobado == 1){
            return redirect()->route('ajustescompromisos.index')
            ->with('success', 'Compromiso Aprobado Exitosamente. ');
        }else{
            return redirect()->route('ajustescompromisos.index')
            ->with('success', 'No Aprobado. No hay Disponibilidad o ha ocurrido un error en el registro');
        }

    }
}
