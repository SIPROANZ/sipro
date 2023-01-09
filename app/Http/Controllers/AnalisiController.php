<?php

namespace App\Http\Controllers;

use App\Analisi;
use App\Unidadadministrativa;
use App\Requisicione;
use App\Criterio;
use App\Detallesanalisi;
use App\Detallesrequisicione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

/**
 * Class AnalisiController
 * @package App\Http\Controllers
 */
class AnalisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $analisis = Analisi::where('estatus', 'EP')->paginate();

        return view('analisi.index', compact('analisis'))
            ->with('i', (request()->input('page', 1) - 1) * $analisis->perPage());
    }

    /**
     * Display requisiciones procesadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprocesadas()
    {
        $analisis = Analisi::where('estatus', 'PR')->paginate();

        return view('analisi.procesadas', compact('analisis'))
            ->with('i', (request()->input('page', 1) - 1) * $analisis->perPage());
    }

    /**
     * Display requisiciones anuladas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
        $analisis = Analisi::where('estatus', 'AN')->paginate();

        return view('analisi.anuladas', compact('analisis'))
            ->with('i', (request()->input('page', 1) - 1) * $analisis->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $analisi = new Analisi();

        $unidadesadministrativas = Unidadadministrativa::pluck('denominacion', 'id');

        $unidades = Unidadadministrativa::all();

        $requisiciones = Requisicione::where('estatus','PR')->pluck('concepto', 'id');
        $criterios = Criterio::pluck('nombre', 'id');

        return view('analisi.create', compact('analisi', 'unidadesadministrativas', 'requisiciones', 'criterios', 'unidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Analisi::$rules);

        //Cambiar el estatus de la requisicion a aprobado, para que no vuelva a aparecer en el listado
        $requisicion = Requisicione::find($request->requisicion_id);
        $requisicion->estatus = 'AP';
        $requisicion->save();

        $analisi = Analisi::create($request->all());

        return redirect()->route('analisis.index')
            ->with('success', 'Analisi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $analisi = Analisi::find($id);

        return view('analisi.show', compact('analisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $analisi = Analisi::find($id);

        $unidadesadministrativas = Unidadadministrativa::pluck('denominacion', 'id');
        $requisiciones = Requisicione::pluck('concepto', 'id');
        $criterios = Criterio::pluck('nombre', 'id');

        return view('analisi.edit', compact('analisi', 'unidadesadministrativas', 'requisiciones', 'criterios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Analisi $analisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Analisi $analisi)
    {
        request()->validate(Analisi::$rules);

        $analisi->update($request->all());

        return redirect()->route('analisis.index')
            ->with('success', 'Analisi updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $analisi = Analisi::find($id)->delete();

        return redirect()->route('analisis.index')
            ->with('success', 'Analisi deleted successfully');
    }

    /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function anular($id)
    {
        $analisi = Analisi::find($id);
        $analisi->estatus = 'AN';
        $analisi->save();

        return redirect()->route('analisis.index')
            ->with('success', 'Analisis de Cotizacion Anulada exitosamente.');
    }

    //Metodo para aprobar un analisis de cotizacion
    /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada la requisicion
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function aprobar($id)
    {
        $analisi = Analisi::find($id);
        $analisi->estatus = 'PR';
        $analisi->save();

        return redirect()->route('analisis.index')
            ->with('success', 'Analisis de Cotizacion Procesada exitosamente.');
    }

    /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregar($id)
    {
        $analisi = Analisi::find($id);

        $requisicion_id = $analisi->requisicion_id;


        //Creare una variable de sesion para guardar el id de esta requisicion
        session(['analisis_var' => $id]);

        $detallesrequisiciones = Detallesrequisicione::where('requisicion_id','=',$requisicion_id)->paginate();

        //Consulto los datos especificos para la requisicion seleccionada
        $detallesanalisis = Detallesanalisi::where('analisis_id','=',$id)->paginate();

        return view('analisi.agregar', compact('analisi', 'detallesanalisis', 'detallesrequisiciones'))
        ->with('i', (request()->input('page', 1) - 1) * $detallesanalisis->perPage());
    }

     /**
     * Crear pdf de la requisicion seleccionada
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        
        $analisi = Analisi::find($id);

        $detallesanalisis = Detallesanalisi::where('analisis_id','=',$id)->paginate();
        // $detallesrequisiciones = Detallesrequisicione::where('requisicion_id','=',$id)->paginate();

        //Obtener las unidades de medidas de los productos, tenemos bos, producto, unidad medida
        /* $detallesrequisiciones = DB::table('detallesrequisiciones')
            ->where('requisicion_id', $id)
            ->join('bos', 'bos.id', '=', 'detallesrequisiciones.bos_id') 
            ->join('unidadmedidas', 'unidadmedidas.id', '=', 'bos.unidadmedida_id')
            ->select('detallesrequisiciones.cantidad', 'bos.descripcion', 'unidadmedidas.nombre')
            ->get(); 

        // Obtener las partidas que tienen que ver con esta requisicion a traves del bos y productos
        //declaro mi arrray partidas
        $partidas = DB::table('requidetclaspres')->where('requisicion_id', $id)->select('meta_id', 'claspres')->get();
           */ 

        $pdf = PDF::loadView('analisi.pdf', ['analisi'=>$analisi, 'detallesanalisis'=>$detallesanalisis]);
        return $pdf->stream();

        
    }

    
    

     //para llenar un select dinamico
     public function requisicion(Request $request){
        if(isset($request->texto)){
            $requisiciones = Requisicione::where('unidadadministrativa_id', $request->texto)->get();
            return response()->json(
                [
                    'lista' => $requisiciones,
                    'success' => true
                ]
                );
        }else{
            return response()->json(
                [
                    'success' => false
                ]
                );

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $analisi = new Analisi();

        $unidadesadministrativas = Unidadadministrativa::pluck('denominacion', 'id');

        $unidades = Unidadadministrativa::all();

        $requisiciones = Requisicione::where('estatus','PR')->pluck('concepto', 'id');
        $criterios = Criterio::pluck('nombre', 'id');

        return view('welcome', compact('analisi', 'unidadesadministrativas', 'requisiciones', 'criterios', 'unidades'));
    }

}
