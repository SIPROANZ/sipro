<?php

namespace App\Http\Controllers;

use App\Requisicione;
use App\Ejercicio;
use App\Institucione;
use App\Unidadadministrativa;
use App\Tipossgp;
use App\Detallesrequisicione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

/**
 * Class RequisicioneController
 * @package App\Http\Controllers
 */
class RequisicioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisiciones = Requisicione::where('estatus', 'EP')->paginate();

        return view('requisicione.index', compact('requisiciones'))
            ->with('i', (request()->input('page', 1) - 1) * $requisiciones->perPage());
    }

    /**
     * Display requisiciones procesadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprocesadas()
    {
        $requisiciones = Requisicione::where('estatus', 'PR')->paginate();

        return view('requisicione.procesadas', compact('requisiciones'))
            ->with('i', (request()->input('page', 1) - 1) * $requisiciones->perPage());
    }

    /**
     * Display requisiciones anuladas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
        $requisiciones = Requisicione::where('estatus', 'AN')->paginate();

        return view('requisicione.anuladas', compact('requisiciones'))
            ->with('i', (request()->input('page', 1) - 1) * $requisiciones->perPage());
    }

    /**
     * Display requisiciones anuladas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexaprobadas()
    {
        $requisiciones = Requisicione::where('estatus', 'AP')->paginate();

        return view('requisicione.aprobadas', compact('requisiciones'))
            ->with('i', (request()->input('page', 1) - 1) * $requisiciones->perPage());
    }

     /**
     * Crear pdf de la requisicion seleccionada
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        $requisicione = Requisicione::find($id);
        // $detallesrequisiciones = Detallesrequisicione::where('requisicion_id','=',$id)->paginate();

        //Obtener las unidades de medidas de los productos, tenemos bos, producto, unidad medida
         $detallesrequisiciones = DB::table('detallesrequisiciones')
            ->where('requisicion_id', $id)
            ->join('bos', 'bos.id', '=', 'detallesrequisiciones.bos_id') 
            ->join('unidadmedidas', 'unidadmedidas.id', '=', 'bos.unidadmedida_id')
            ->select('detallesrequisiciones.cantidad', 'bos.descripcion', 'unidadmedidas.nombre')
            ->get(); 

        // Obtener las partidas que tienen que ver con esta requisicion a traves del bos y productos
        //declaro mi arrray partidas
        $partidas = DB::table('requidetclaspres')->where('requisicion_id', $id)->select('meta_id', 'claspres')->get();
            

        $pdf = PDF::loadView('requisicione.pdf', ['requisicione'=>$requisicione, 'detallesrequisiciones'=>$detallesrequisiciones, 'partidas'=>$partidas]);
        return $pdf->stream();
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $requisicione = new Requisicione();

        $ejercicios = Ejercicio::pluck('nombreejercicio' , 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        $unidadadministrativas = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $tipossgps = Tipossgp::pluck('denominacion' , 'id');

       return view('requisicione.create', compact('requisicione' , 'ejercicios' , 'instituciones' , 'unidadadministrativas', 'tipossgps'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Requisicione::$rules);

        //Obtener ultimo numero de requisicion dependiendo si es compra, servicio o suministro
        $tipo_requisicion = $request->tiposgp_id;

        $max_correlativo = DB::table('requisiciones')->where('tiposgp_id', $tipo_requisicion)->max('correlativo');
        $numero_correlativo = $max_correlativo + 1;

       // $request->correlativo = $numero_correlativo //18;
         $request->merge(['correlativo'  => $numero_correlativo]);
         $request->merge(['estatus'  => 'EP']);


        $requisicione = Requisicione::create($request->all());

        return redirect()->route('requisiciones.index')
            ->with('success', 'Requisicion creado exitosamente.' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requisicione = Requisicione::find($id);

        return view('requisicione.show', compact('requisicione'));
    }

    /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregar($id)
    {
        $requisicione = Requisicione::find($id);


        //Creare una variable de sesion para guardar el id de esta requisicion
        session(['requisicion' => $id]);

        //Consulto los datos especificos para la requisicion seleccionada
        $detallesrequisiciones = Detallesrequisicione::where('requisicion_id','=',$id)->paginate();

        return view('requisicione.agregar', compact('requisicione', 'detallesrequisiciones'))
        ->with('i', (request()->input('page', 1) - 1) * $detallesrequisiciones->perPage());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requisicione = Requisicione::find($id);

        $ejercicios = Ejercicio::pluck('nombreejercicio' , 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        $unidadadministrativas = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $tipossgps = Tipossgp::pluck('denominacion' , 'id');

       return view('requisicione.edit', compact('requisicione' , 'ejercicios' , 'instituciones' , 'unidadadministrativas', 'tipossgps'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Requisicione $requisicione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requisicione $requisicione)
    {
        request()->validate(Requisicione::$rules);

        $requisicione->update($request->all());

        return redirect()->route('requisiciones.index')
            ->with('success', 'Requisicione actualizado exitosamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $requisicione = Requisicione::find($id)->delete();

        return redirect()->route('requisiciones.index')
            ->with('success', 'Requisicione eliminado exitosamente.');
    }

    /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function anular($id)
    {
        $requisicione = Requisicione::find($id);
        $requisicione->estatus = 'AN';
        $requisicione->save();

        return redirect()->route('requisiciones.index')
            ->with('success', 'Requisicion Anulada exitosamente.');
    }

    /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada la requisicion
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function aprobar($id)
    {
        $requisicione = Requisicione::find($id);
        $requisicione->estatus = 'PR';
        $requisicione->save();

        return redirect()->route('requisiciones.index')
            ->with('success', 'Requisicion Procesada exitosamente.');
    }
}
