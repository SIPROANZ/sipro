<?php

namespace App\Http\Controllers;

use App\Compromiso;
use App\Detallescompromiso;
use App\Compra;
use App\Comprascp;
use App\Tipodecompromiso;
use App\Detallesanalisi;
use App\Ejecucione;
use Illuminate\Http\Request;
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

       
        return view('compromiso.compras', compact('compras'))
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

        return view('compromiso.show', compact('compromiso'));
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

        return view('compromiso.edit', compact('compromiso'));
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
        $compra->status = 'PR';
        $compra->save();

        $detallesanalisi = Detallesanalisi::find($compra->analisis_id);
        $proveedor = $detallesanalisi->proveedor_id;

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
        $compra->estatus = 'EP';
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

        $detallescompromisos = Detallescompromiso::where('compromiso_id','=',$id)->paginate();
        

        $pdf = PDF::loadView('compromiso.pdf', ['compromiso'=>$compromiso, 'detallescompromisos'=>$detallescompromisos]);
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

}
